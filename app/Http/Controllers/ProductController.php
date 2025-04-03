<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Recuperar registros do banco de dados com paginação
        $products = Product::orderByDesc('id')->paginate(10); // 10 items per page

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

    public function store(ProductRequest $request)
    {
        
        // Criar um novo produto no banco de dados
        Product::create($request->only(['name', 'price']));

        // Redirecionar para a rota products.index com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        
        // Carregar a view products.edit
        return view('products.edit', ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product)
    {   
        
        // Editar o produto no banco de dados
        $product->update($request->only(['name', 'price']));

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


