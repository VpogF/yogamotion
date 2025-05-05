@extends('layouts.principal')

@section('contenido')
    <div class="container">
        <h2>Mis eventos</h2>

        @if ($eventos->isEmpty())
            <p>No estás apuntado a ningún evento.</p>
        @else
            <ul>
                @foreach ($eventos as $evento)
                    <li>
                        <strong>{{ $evento->nom_evento }}</strong><br>
                        Fecha: {{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}<br>
                        Ubicación: {{ $evento->ubicacion }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
