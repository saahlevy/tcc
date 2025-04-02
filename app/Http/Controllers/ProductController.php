<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {   
        // Recuperar registros do banco de dados
        $products = Product::orderByDesc('id')->get();

        // Carregar a view products.index
        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        // Carregar a view products.show
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        // Carregar a view products.create
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validar o formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:products,email',
            'password' => 'required|string|min:6',
        ]);

        // Criar um novo produto no banco de dados
        Product::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Criptografar a senha
        ]);

        // Redirecionar para a rota products.index com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        // Carregar a view products.edit
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {   
        // Validar o formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:products,email,' . $product->id,
            'password' => 'nullable|string|min:6',
        ]);

        // Editar o produto no banco de dados
        $product->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $product->password, // Atualizar a senha apenas se fornecida
        ]);

        // Redirecionar para a rota products.show com uma mensagem de sucesso
        return redirect()->route('products.show', ['product' => $product->id])->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Deletar o produto no banco de dados
        $product->delete();

        // Redirecionar para a rota products.index com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}


