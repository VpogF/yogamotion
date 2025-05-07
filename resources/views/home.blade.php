@extends('layouts.principal')

@section('contenido')
    @if (Auth::user()->tipo_usuario_id == 3)
        <div class="home-container">
            <h3 class="home-title">Busca, reserva y disfruta de las mejores clases en un solo lugar.</h3>
            <card-evento></card-evento>
            <blog></blog>
        </div>

    @elseif (Auth::user()->tipo_usuario_id == 2)
    <div class="home-container" style="position: relative">
        <panel-org :usuario-id={{ Auth::user()->id }}></panel-org>
    </div>
    @endif
@endsection
