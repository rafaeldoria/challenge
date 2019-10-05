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
                    <button type="button" class="btn btn-info">Timeline</button>
                </div>

                <div class="container mt-5 mb-5 hidden">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h4>Latest News</h4>
                            <ul class="timeline">
                                <li>
                                    <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                                    <a href="#" class="float-right">21 March, 2014</a>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                                </li>
                                <li>
                                    <a href="#">21 000 Job Seekers</a>
                                    <a href="#" class="float-right">4 March, 2014</a>
                                    <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                                </li>
                                <li>
                                    <a href="#">Awesome Employers</a>
                                    <a href="#" class="float-right">1 April, 2014</a>
                                    <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
