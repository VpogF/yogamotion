@extends('layouts.principal')

@section('contenido')
<div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 90%;">
    {{-- @include('partials.mensajes') --}}
    <div class="card align-items-center justify-content-center" style="width: 50%; padding: 25px;">
        <div class="fw-bold" style="font-size: 45px;">
                Registro
        </div>
        <div class="card-body" style="width: 90%">
            <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'store']) }}" method="POST">
                @csrf
                <div>
                    <label for="nom_user" class="col-form-label">Nombre Usuario</label>
                    <div>
                        <input type="text" class="form-control" id="nom_user" name="nom_user" autofocus
                        value="{{ old('nom_user') }}">
                    </div>
                </div>

                <div>
                    <label for="correo" class="col-form-label">Correo</label>
                    <div>
                        <input type="email" class="form-control" id="correo" name="correo" autofocus
                        value="{{ old('correo') }}">
                    </div>
                </div>

                <div>
                    <label for="contrasenya" class="col-sm-2 col-form-label">Contraseña</label>
                    <div>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya"
                        value="{{ old('contrasenya') }}">
                    </div>
                </div>

                <div>
                    <label for="ubicacion" class="col-form-label">Ubicacion</label>
                    <div>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                        value="{{ old('ubicacion') }}">
                    </div>
                </div>
                <div class="btn-group my-4  d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="2" value="2" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="2">Soy Organizador</label>

                    <input type="radio" class="btn-check" name="btnradio" id="3" value="3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="3">Soy Alumno</label>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="standar-botton float-right"><i class="fa fs-check"
                            aria-hidden="true"></i>
                            Aceptar
                        </button>
                        <a href="{{ url('/') }}" class="btn btn-secondary float-right ms-1"><i class="fa fa-times"
                            aria-hidden="true"></i>
                            Cancelar
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
