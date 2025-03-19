@extends('layouts.principal')

@section('contenido')
{{ $user->tipo_usuario->nom_tipo_usuario }}
@endsection
