@extends('layouts.principal')

@section('contenido')
<div class="offset-lg-3 col-lg-6 mt-5">
    {{-- @include('partials.mensajes') --}}
    <div class="card">
        <div class="card-header bg-secondary text-light">
                SignIn
        </div>
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'store']) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nom_user" class="col-sm-2 col-form-label">Nombre Usuario</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nom_user" name="nom_user" autofocus
                        value="{{ old('nom_user') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correo" name="correo" autofocus
                        value="{{ old('correo') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="contrasenya" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya"
                        value="{{ old('contrasenya') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ubicacion" class="col-sm-2 col-form-label">Ubicacion</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                        value="{{ old('ubicacion') }}">
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="2" value="2" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="2">Soy Organizador</label>

                    <input type="radio" class="btn-check" name="btnradio" id="3" value="3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="3">Soy Alumno</label>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 d-flex flex-row-reverse">
                        <a href="{{ url('/') }}" class="btn btn-secondary float-right ms-1"><i class="fa fa-times"
                            aria-hidden="true"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fs-check"
                            aria-hidden="true"></i>
                            Aceptar
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
