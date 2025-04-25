@extends('layouts.principal')

@section('contenido')
    <card-detalle :evento-id="{{ request('eventoId') }}"></card-detalle>
@endsection
