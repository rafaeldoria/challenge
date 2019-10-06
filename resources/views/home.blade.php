@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                <div class="card-body">
                    <form>
                        <div class="col-md-6 mb-3">
                        <label for="validationServer03">Buscar Eventos</label>
                        <input type="text" class="form-control valid" id="strEvent" placeholder="Evento">
                        <div class="invalid-feedback" style="display:none">
                            Por favor, informe um evento válido.
                        </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <button type="button" id="timeline" class="btn btn-info">Timeline</button>
                </div>

                <div class="container mt-5 mb-5 none">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h4>Events news</h4>
                            @foreach ($events as $event)
                                <ul class="timeline">
                                        Timestamp: {{$event["timestamp"]}} </br>
                                        Revenue: {{$event["revenue"]}} </br>
                                        Transaction_id: {{$event["transaction_id"]}}</br>
                                        Store_name: {{$event["store_name"]}}</br>
                                        @foreach ($event["products"] as $product)
                                            Name: {{$product["name"]}}</br>
                                            Price: {{$product["price"]}}</br>
                                        @endforeach
                                        
                                    </ul>
                                @endforeach
                                
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
