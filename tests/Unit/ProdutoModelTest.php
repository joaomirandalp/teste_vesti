<?php

namespace Tests\Unit;

use App\Models\ProdutoModel;
use Tests\TestCase;

class ProdutoModelTest extends TestCase
{
    public function testInstanceProdutoModelWithouActive(): void
    {
        $produtoModel = new ProdutoModel(
            "123",
            "123",
            "Name test",
            "Description teste",
            "Composition teste",
            "Brand teste",
            20.0,
            15.0
        );
       $resultadoEsperado = true;
       $this->assertEquals($resultadoEsperado, $produtoModel->getProduto()->active); 
    }

    public function testInstanceProdutoModelWithActive(): void
    {
        $produtoModel = new ProdutoModel(
            "123",
            "123",
            "Name test",
            "Description teste",
            "Composition teste",
            "Brand teste",
            20.0,
            15.0,
            false
        );
       $resultadoEsperado = false;
       $this->assertEquals($resultadoEsperado, $produtoModel->getProduto()->active); 
    }

    public function testInstanceProdutoModelWithPromotionPrice(): void
    {
        $produtoModel = new ProdutoModel(
            "123",
            "123",
            "Name test",
            "Description teste",
            "Composition teste",
            "Brand teste",
            20.0,
            15.0,
            true
        );
       $resultadoEsperado = true;
       $this->assertEquals($resultadoEsperado, $produtoModel->getProduto()->promotion); 
    }

    public function testInstanceProdutoModelWithoutPromotionPrice(): void
    {
        $produtoModel = new ProdutoModel(
            "123",
            "123",
            "Name test",
            "Description teste",
            "Composition teste",
            "Brand teste",
            20.0,
            0,
            true
        );
       $resultadoEsperado = false;
       $this->assertEquals($resultadoEsperado, $produtoModel->getProduto()->promotion); 
    }

    public function testInstanceProdutoWithSuccess(): void
    {
        $produtoModel = new ProdutoModel(
            "123",
            "123",
            "Name test",
            "Description teste",
            "Composition teste",
            "Brand teste",
            20.0,
            15.5
        );
       $this->assertEquals("123", $produtoModel->getProduto()->integration_id); 
       $this->assertEquals("123", $produtoModel->getProduto()->code); 
       $this->assertEquals("Name test", $produtoModel->getProduto()->name); 
       $this->assertEquals("Description teste", $produtoModel->getProduto()->description); 
       $this->assertEquals("Composition teste", $produtoModel->getProduto()->composition); 
       $this->assertEquals("Brand teste", $produtoModel->getProduto()->brand); 
       $this->assertEquals(20.0, $produtoModel->getProduto()->price); 
       $this->assertEquals(15.5, $produtoModel->getProduto()->price_promotional); 
    }

}