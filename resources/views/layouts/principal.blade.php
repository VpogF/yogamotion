<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
    <title>
        @yield('title')
    </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" style="font-size: 45px;" href="{{ url('/') }}">yogamotion</a>
            <div class="d-flex" role="search">
                <ul class="navbar-nav" me-auto mb-2 mb.lg-0>
                    @if (Auth::check())
                        @php
                            $usuario = Auth::user(); // Guardar el usuario autenticado en una variable
                        @endphp
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"> Hola,
                                {{ ucfirst(Auth::user()->nom_user) }} !
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->tipo_usuario_id == 3)
                                <a class="dropdown-item" href="{{ url('/usuario/'.Auth::user()->id.'/miseventos')}}"><i class="bi bi-person"
                                    aria-hidden="true"></i>
                                Tu perfil
                            </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right"
                                        aria-hidden="true"></i>
                                    Logout
                                </a>

                                <form
                                    class="dropdown-item
                                    action="{{ action([App\Http\Controllers\UsuarioController::class, 'destroy'], ['usuario' => $usuario->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="all: unset;"><i class="bi bi-trash3 text-danger"></i>
                                        Eliminar cuenta
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('/signin') }}"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i>
                                Signin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i>
                                Login</a>
                        </li> --}}
                </ul>
                @endif
            </div>
        </div>
        </div>
    </nav>
    <!-- Vue se montará aquí -->
    <div id="app" class="container-fluid">
        @yield('contenido')
    </div>

</body>

</html>
