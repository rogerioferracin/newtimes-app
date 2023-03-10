<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class UserAdminController extends Controller
{
    /**
     * Lista usuários cadastrados no sistema
     */
    public function index()
    {
        //$this->user->hasRole('Administrator');
        $usuarios = User::all();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Abre a view para criação de novo usuário
     */
    public function create(): View
    {
        return view('usuarios.usuario');
    }

    /**
     * Abre a view de atualização de usuario
     */
    public function edit(User $usuario): View
    {
        //$user = User::find($u->id);
        return view('usuarios.usuario', compact('usuario'));
    }

    /**
     * Atualiza usuario no BD
     */
    public function update(Request $request, User $usuario): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cel' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }

    /**
     * Deleta usuário do sistema
     */
    public function destroy(User $usuario): RedirectResponse
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }


    /**
     * Insere um novo usuario no BD
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cel' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cel' => $request->cel,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        return redirect(route('usuarios.index'));
    }
}
