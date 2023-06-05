<?php

namespace Tests\Unit;

use App\Services\ProdutoService;
use Tests\TestCase;

class ProdutoServiceTest extends TestCase
{
    /**
     * Teste do retorno da estrutura 'produtos' do método extractProduto, da camada ProdutoService
     */
    public function testExtractProduto(): void
    {
        $produtoService = new ProdutoService();

        $produtos = '[
            {
              "referencia": 1761095,
              "nome": "SHORT ANTI FIT",
              "descricao": null,
              "preco": "109,90",
              "promocao": 66,
              "composicao": "100% Algodão",
              "marca": "Joana Modas"
            }]';

        $variacoes = '[
            {
                "variacao": "1761095_44_MEDIA",
                "tamanho": 44,
                "cor": "MEDIA",
                "quantidade": 0,
                "unidade": "UN",
                "ordem": 5
              },
              {
                "variacao": "1761095_46_MEDIA",
                "tamanho": 46,
                "cor": "MEDIA",
                "quantidade": 0,
                "unidade": "UN",
                "ordem": 6
              }
        ]';

        $estruturaEsperada = [
            "integration_id",
            "code",
            "name",
            "active",
            "description",
            "composition",
            "brand",
            "price",
            "promotion",
            "price_promotional",
            "variations"
        ];

        $resultado = $produtoService->extractProduto(json_decode($produtos, true), json_decode($variacoes, true));

        $this->assertEmpty(array_diff($estruturaEsperada, array_keys((array) $resultado['produtos'][0])));
    }

    /**
     * Teste do retorno do método extractSkuFormat, da camada ProdutoService
     */
    public function testExtractSkuFormat(): void
    {
        $produtoService = new ProdutoService();

        $sku = "1761095_46_MEDIA";
        $resultadoEsperado = "1761095";
        $resultado = $produtoService->extractSkuFormat($sku);

        $this->assertEquals($resultadoEsperado, $resultado);
    }
}