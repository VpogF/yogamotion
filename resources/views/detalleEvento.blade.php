@extends('layouts.principal')

@section('contenido')
    <card-detalle :evento-id="{{ request('eventoId') }}" :usuario-id={{ Auth::user()->id }}></card-detalle>
@endsection
