<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Http\Requests\StoreDescriptionRequest;
use App\Http\Requests\UpdateDescriptionRequest;

class DescriptionController extends Controller
{
    public function index()
    {
        // Recuperar registros do banco de dados com paginação
        $descriptions = Description::orderByDesc('id')->paginate(10); 

        // Carregar a view descriptions.index
        return view('descriptions.index', ['descriptions' => $descriptions]);
    }

    public function show(Description $description)
    {
        // Carregar a view description.show
        return view('descriptions.show', ['description' => $description]);
    }

    public function create()
    {
        // Carregar a view description.create
        return view('descriptions.create');
    }

    public function store(StoreDescriptionRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Criar uma nova descrição no banco de dados
        Description::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirecionar para a rota descriptions.index com uma mensagem de sucesso
        return redirect()->route('descriptions.index')->with('success', 'Description created successfully!');
    }

    public function edit(Description $description)
    {
        // Carregar a view description.edit
        return view('descriptions.edit', ['description' => $description]);
    }

    public function update(UpdateDescriptionRequest $request, Description $description)
    {
        // Validar o formulário
        $request->validated();

        // Atualizar a descrição no banco de dados
        $description->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirecionar para a rota description.show com uma mensagem de sucesso
        return redirect()->route('descriptions.show', ['description' => $description->id])->with('success', 'Description updated successfully!');
    }

    public function destroy(Description $description)
    {
        // Deletar a descrição no banco de dados
        $description->delete();

        // Redirecionar para a rota description.index com uma mensagem de sucesso
        return redirect()->route('descriptions.index')->with('success', 'Description deleted successfully!');
    }
}
