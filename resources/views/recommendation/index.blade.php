@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recommendations list</div>
                    <form action="{{ route('recommendation.index') }}" method="get">
                        <div><i><small>Data source is LHMT</small></i></div>
                        <fieldset>
                            <legend>Select town</legend>
                            <div class="block">
                                <div class="form-group">
                                    <select name="town_name">
                                        <option value="0" disabled selected>Select town</option>
                                        <option value="alytus">Alytus</option>
                                        <option value="kaunas">Kaunas</option>
                                        <option value="klaipeda">Klaipėda</option>
                                        <option value="panevezys">Panevėžys</option>
                                        <option value="siauliai">Šiauliai</option>
                                        <option value="vilnius">Vilnius</option>
                                        <option value="marijampole">Marijampolė</option>
                                        <option value="mazeikiai">Mažeikiai</option>
                                        <option value="zarasai">Zarasai</option>
                                    </select>

                                    <small class="form-text text-muted">Select town</small>
                                </div>
                            </div>
                            <div class="block">
                                <button type="submit" class="btn btn-secondary">Get</button>
                            </div>
                        </fieldset>
                    </form>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($weather_forecast as $forecastItem)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <details>
                                            <summary>
                                                City: {{ $town }}<h6><b>Date:</b>
                                                    {{ substr($forecastItem['forecastTimeUtc'], 0, 10) }}</h6>
                                            </summary>
                                            <div class="listBlock__content">
                                                <h4><b>weather_forecast:</b>
                                                    {{ $forecastItem['conditionCode'] }}
                                                </h4>
                                            </div>
                                            @foreach ($recommendations as $recommendationItem)
                                                @if ($recommendationItem->type == $forecastItem['conditionCode'])
                                                    <div class="item">
                                                        <div class="listBlock__content">
                                                            <h4><b>id:</b> {{ $recommendationItem->id }} </h4>
                                                        </div>
                                                        <div class="listBlock__content">
                                                            <h4><b>Name:</b> {{ $recommendationItem->name }} </h4>
                                                        </div>
                                                        <div class="listBlock__content">
                                                            <h4><b>sku:</b> {{ $recommendationItem->sku }}</h4>
                                                        </div>
                                                        <div class="listBlock__content">
                                                            <h4><b>Price:</b>
                                                                {{ $recommendationItem->price }},<?= rand(0, 9) . rand(0, 9) ?>Eur.
                                                            </h4>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </details>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') Recommendations list @endsection
