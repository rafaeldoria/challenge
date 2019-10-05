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
                        <input type="text" class="form-control valid" id="strEvent" placeholder="Evento" required>
                        <div class="invalid-feedback" style="display:none">
                            Por favor, informe uma cidade válida.
                        </div>
                        </div>
                    </form>
                </div>

                <div class = "ui-widget">
         <p>Type "a" or "s"</p>
         <label for = "automplete-1">Tags: </label>
         <input id = "automplete-1">
      </div>

            </div>
        </div>
    </div>
</div>
@endsection
