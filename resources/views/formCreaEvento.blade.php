@extends('layouts.principal')

@section('contenido')
    <crea-evento :usuario-id="{{ request()->get('usuarioId') }}"></crea-evento>
@endsection
