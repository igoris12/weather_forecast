@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recommendations list</div>
                    <form action="{{ route('recommendation.index') }}" method="get">
                        <fieldset>
                            <legend>Filter</legend>
                            <div class="block">
                                <div class="form-group">
                                    <select name="town_name">
                                        <option value="vilnius">Vilnius</option>
                                        <option value="kaunas">Kaunas</option>
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
                            @foreach ($recommendations as $recommendation)
                                <li class="list-group-item">
                                    <div class="listBlock">
                                        <h4> {{ $town }}</h4>
                                        <details>
                                            <summary>
                                                {{ $recommendation->name }} ID: {{ $recommendation->id }}
                                            </summary>
                                            <div class="listBlock__content">
                                                <h4><b>Sku:</b> {{ $recommendation->sku }}</h4>
                                            </div>
                                            <div class="listBlock__content">
                                                <h4><b>Price:</b> {{ $recommendation->price }},
                                                    <?= rand(0, 9) . rand(0, 9) ?>Eur.</h4>
                                            </div>
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