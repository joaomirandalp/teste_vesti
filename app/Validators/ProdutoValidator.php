<?php

namespace App\Validators;

use App\Validators\CustomValidator;

class ProdutoValidator extends CustomValidator {
    public function validateProdutoData($data){
        $produto = $data['referencia'];

        $rules = [
            'referencia' => 'required|max:255',
            'nome' => 'required|string|max:255',
            'descricao' => 'sometimes|string|max:350',
            'composicao' => 'sometimes|string|max:255',
            'marca' => 'sometimes|string|max:255',
            'preco' => 'required|numeric',
            'promocao' => 'sometimes|numeric',
        ];

        $messages = [
            'required' => 'O campo :attribute do produto: ' . $produto . ' é obrigatório.',
            'string' => 'O campo :attribute do produto: ' . $produto . ' deve ser uma string.',
            'max' => 'O campo :attribute do produto: ' . $produto . ' não pode exceder :max caracteres.',
            'numeric' => 'O campo :attribute do produto: ' . $produto . ' deve ser um valor numérico.'
        ];

        return $this->validate((array)$data, $rules, $messages);
    }
}