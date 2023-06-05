<?php

namespace App\Http\Controllers;

use \App\Services\ProdutoService;

class ProdutosController extends Controller
{
    public function cadastrarProdutos()
    {
        $produtoService = new ProdutoService();
        return $produtoService->integrateProduto();
    }
}
