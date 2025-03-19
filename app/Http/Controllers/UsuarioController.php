<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function showLogin()
    {

        // $usuario = new Usuario();

        // $usuario->correo = 'vpoglo@mail.com';
        // $usuario->contrasenya = \bcrypt('pepe');
        // $usuario->id_tipo_usuario = 1;

        // $usuario->save();

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $password = $request->input('password');

        $user = Usuario::where('correo', $correo)->first();

        if ($user != null && Hash::check($password, $user->password)){
            Auth::login($user);
            $response = redirect('/home');
        }else {
            $request->session()->flash('error', 'usuario o contraseña incorrecta');
            $response = redirect('/login')->withInput();
        }

        return $response;
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.signin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();


        $usuario->correo = $request->input('correo');
        $usuario->password = \bcrypt($request->input('contrasenya'));
        $usuario->nom_user = $request->input('nom_user');
        $usuario->ubicacion = $request->input('ubicacion');
        $usuario->tipo_usuario_id = $request->input('btnradio');

        $usuario->save();

        $response = redirect('/login');

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        Auth::logout();

        return redirect('/')->with('success', 'Usuario eliminado correctamente');
    }
}
