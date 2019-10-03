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

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="validationServer03">Cidade</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Cidade" required>
                    <div class="invalid-feedback">
                        Por favor, informe uma cidade válida.
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
