<?php

namespace App\Services;

use stdClass;
use App\Models\ProdutoModel;
use App\Models\VariacaoModel;
use App\Validators\ProdutoValidator;
use App\Validators\VariacaoValidator;
use Illuminate\Support\Facades\Http;

class ProdutoService extends Service
{
    public function integrateProduto()
    {
        $pathProdutos = storage_path('app/public/json/produtos.json');
        $pathVariacoes = storage_path('app/public/json/variacoes.json');

        if (file_exists($pathProdutos) && file_exists($pathVariacoes)) {
            $jsonDataProdutos = file_get_contents($pathProdutos);
            $jsonDataVariacoes = file_get_contents($pathVariacoes);

            $produtosData = json_decode($jsonDataProdutos, true);
            $variacoesData = json_decode($jsonDataVariacoes, true);

            $produtos = $this->extractProduto($produtosData, $variacoesData);

            if (count($produtos['errorList']) > 0) {
                return $produtos['errorList'];
            }

            return $produtos['produtos'];
        }
        return "Json's inválidos";
    }

    /**
     * Método para consumir a API de produto do ERP
     */
    public function getProdutoErp()
    {
        $response = Http::get('https://api.urlerp.com/api/produtos');

        if ($response->successful()) {
            return $response->json();
        } else {
            $statusCode = $response->status();
            // Lida com o erro de acordo com o código de status retornado
        }
    }

    /**
     * Método para consumir a API de variações do ERP
     */
    public function getVariacoesErp()
    {
        $response = Http::get('https://api.urlerp.com/api/variacoes');

        if ($response->successful()) {
            return $response->json();
        } else {
            $statusCode = $response->status();
            // Lida com o erro de acordo com o código de status retornado
        }
    }

    /**
     * Método para enviar via API (POST) o json formatado para a Vesti
     */
    public function executeApiVesti(int $companyId, array $jsonProduto)
    {
        $apiKey = 'API_KEY_VESTI';

        $response = Http::withHeaders([
            'apikey' => $apiKey,
            'Content-Type' => 'application/json',
        ])->withBody(json_encode($jsonProduto), 'application/json')
            ->post("https://apiurl/v1/products/company/{$companyId}/endpoint");

        //Tratar resposta
        if ($response->successful()) {
            $responseData = $response->json();
        } else {
            $statusCode = $response->status();
        }
    }

    public function extractProduto(array $produtosData, array $variacoesData)
    {
        $produtoList = [];
        $errorList = [];

        $variacoesOutputDTO = $this->extractVariacoesProduto($variacoesData);

        if ($variacoesOutputDTO['errorList']) {
            $errorList = $variacoesOutputDTO['errorList'];
        }

        $variacoes = $variacoesOutputDTO['variacoes'];

        foreach ($produtosData as $produto) {
            if ($produto['descricao'] === null)
                $produto['descricao'] = "";

            $produto['preco'] = $this->getfloat($produto['preco']);

            $produtoValidator = new ProdutoValidator();
            $errors = $produtoValidator->validateProdutoData($produto);

            if ($errors) {
                $errorList[] = $errors;
            }

            if (empty($errorList)) {
                $produtoDetail = $this->mapProdutoModel($produto);
                $produtoDetail->setVariations($variacoes->{$produtoDetail->getIntegrationId()});
                $produtoList[] = $produtoDetail->getProduto();
            }
        }

        return ['produtos' => $produtoList, 'errorList' => $errorList];
    }

    public function mapProdutoModel($produto): ProdutoModel
    {
        return new ProdutoModel(
            $produto['referencia'],
            $produto['referencia'],
            $produto['nome'],
            $produto['descricao'],
            $produto['composicao'],
            $produto['marca'],
            $produto['preco'],
            $produto['promocao']
        );
    }

    public function extractVariacoesProduto(array $variacoesProduto)
    {
        $variacaoList = new stdClass();
        $errorList = [];
        $variacaoValidator = new VariacaoValidator();

        foreach ($variacoesProduto as $variacao) {
            $errors = $variacaoValidator->validateVariacaoData($variacao);

            if ($errors) {
                $errorList[] = $errors;
            }

            if (empty($errorList)) {

                $produtoVariacao = $this->mapVariacaoModel($variacao);

                $sku = $this->extractSkuFormat($produtoVariacao->getSku());

                $variacaoList->$sku[] = $produtoVariacao->getVariacao();
            }
        }

        if (!empty($errorList)) {
            return ['variacoes' => null, 'errorList' => $errorList];
        }

        return ['variacoes' => $variacaoList, 'errorList' => []];
    }

    public function mapVariacaoModel($variacao): VariacaoModel
    {
        return new VariacaoModel(
            $variacao['variacao'],
            $variacao['tamanho'],
            $variacao['cor'],
            $variacao['quantidade'],
            $variacao['ordem'],
            $variacao['unidade']
        );
    }

    public function extractSkuFormat(string $idProduto)
    {
        $parts = explode("_", $idProduto);
        $result = $parts[0];

        return $result;
    }
}