<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {   
        // Recuperar registros do banco de dados
        $users = User::orderByDesc('id')->get();

        // Carregar a view users.index
        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        // Carregar a view users.show
        return view('users.show', ['user' => $user]);
    }

    public function create()
    {
        // Carregar a view users.create
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Criar um novo usuário no banco de dados
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Criptografar a senha
        ]);

        // Redirecionar para a rota users.index com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        // Carregar a view users.edit
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {   
        // Validar o formulário
        $request->validated();

        // Editar o usuário no banco de dados
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Atualizar a senha apenas se fornecida
        ]);

        // Redirecionar para a rota users.show com uma mensagem de sucesso
        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Deletar o usuário no banco de dados
        $user->delete();

        // Redirecionar para a rota users.index com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
