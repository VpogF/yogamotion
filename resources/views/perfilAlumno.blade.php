@extends('layouts.principal')

@section('contenido')
    <div class="home-container" style="position: relative">
        <perfil-alumno :usuario-id={{ Auth::user()->id }}></perfil-alumno>
    </div>
@endsection
