@extends('layouts.principal')

@section('contenido')
    <div class="d-flex align-items-center justify-content-center vh-100 vw-100">
        {{-- @include('partials.mensajes') --}}
        <div class="card align-items-center justify-content-center" style="width: 30%; padding: 25px;">
            <div class="fw-bold" style="font-size: 45px;">
                Inicio Sesión
            </div>
            <div class="card-body" style="width: 100%">
                <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="correo" class="col-form-label">Correo</label>
                        <div>
                            <input type="text" class="form-control" id="correo" name="correo" autofocus
                                value="{{ old('correo') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Contraseña</label>
                        <div>
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center text-center">
                        <button type="submit" class="standar-botton float-right mt-5 mb-5"><i class="fa fs-check"
                                aria-hidden="true"></i>
                            Acceder
                        </button>
                        <p>¿Eres nuevo aquí?<a href="{{ url('/signin') }}">Crea una cuenta</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
