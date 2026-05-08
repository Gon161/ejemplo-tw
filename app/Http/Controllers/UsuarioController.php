<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        $usuarios = Usuario::all();

        return response()->json($usuarios);
    }

    public function store(Request $request): JsonResponse
    {
        
        //nombres de formulario 
        $request->validate([
            'nombre'   => 'required|string|max:80',
            'apellido' => 'required|string|max:80',
            'correo'   => 'required|email|max:100|unique:usuarios,correo',
            'password' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:20',
            'avatar'   => 'nullable|string',
            'rol'      => 'nullable|in:cliente,vendedor,admin',
            'estado'   => 'nullable|in:activo,inactivo,suspendido',
        ]);

        $usuario = new Usuario();
        $usuario->nombre   = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->correo   = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->telefono = $request->telefono;
        $usuario->avatar   = $request->avatar;
        $usuario->rol      = $request->rol ?? 'cliente';
        $usuario->estado   = $request->estado ?? 'activo';
        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function show(string $id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);

        return response()->json($usuario);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre'   => 'sometimes|string|max:80',
            'apellido' => 'sometimes|string|max:80',
            'correo'   => ['sometimes', 'email', 'max:100', Rule::unique('usuarios', 'correo')->ignore($usuario->id)],
            'password' => 'sometimes|string|min:8',
            'telefono' => 'nullable|string|max:20',
            'avatar'   => 'nullable|string',
            'rol'      => 'nullable|in:cliente,vendedor,admin',
            'estado'   => 'nullable|in:activo,inactivo,suspendido',
        ]);

        if ($request->has('nombre'))   $usuario->nombre   = $request->nombre;
        if ($request->has('apellido')) $usuario->apellido = $request->apellido;
        if ($request->has('correo'))   $usuario->correo   = $request->correo;
        if ($request->has('password')) $usuario->password = Hash::make($request->password);
        if ($request->has('telefono')) $usuario->telefono = $request->telefono;
        if ($request->has('avatar'))   $usuario->avatar   = $request->avatar;
        if ($request->has('rol'))      $usuario->rol      = $request->rol;
        if ($request->has('estado'))   $usuario->estado   = $request->estado;
        $usuario->save();

        return response()->json($usuario);
    }

    public function destroy(string $id): JsonResponse
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario eliminado correctamente']);
    }
}
