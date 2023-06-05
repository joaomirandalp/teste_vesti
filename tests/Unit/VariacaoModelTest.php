<?php

namespace Tests\Unit;

use App\Models\VariacaoModel;
use Tests\TestCase;

class VariacaoModelTest extends TestCase
{
    public function testInstanceVariacaoModelWithSuccess(): void
    {
        $variacaoModel = new VariacaoModel(
            "SKU Test",
            "G",
            "PRETO",
            1,
            1,
            "PÇ"
        );
       $this->assertEquals("SKU Test", $variacaoModel->getVariacao()->sku); 
       $this->assertEquals("G", $variacaoModel->getVariacao()->size); 
       $this->assertEquals("PRETO", $variacaoModel->getVariacao()->color); 
       $this->assertEquals(1, $variacaoModel->getVariacao()->quantity); 
       $this->assertEquals(1, $variacaoModel->getVariacao()->order); 
       $this->assertEquals("PÇ", $variacaoModel->getVariacao()->unit_type); 
    }
}