@extends('layouts.principal')

@section('contenido')
    @if (Auth::user()->tipo_usuario_id == 3)
        <div class="home-container">
            <h3>Busca, reserva y disfruta de las mejores clases en un solo lugar.</h3>
            <card-evento></card-evento>
        </div>

    @elseif (Auth::user()->tipo_usuario_id == 2)
    <div class="home-container">
        <panel-org :usuario-id={{ Auth::user()->id }}></panel-org>
    </div>
    @endif
@endsection
