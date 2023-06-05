<?php

namespace App\Validators;

use App\Validators\CustomValidator;

class VariacaoValidator extends CustomValidator {
    public function validateVariacaoData($data){
        $sku = $data['variacao'];

        $rules = [
            'variacao' => 'required|string|max:255',
            'tamanho' => 'required|max:255',
            'cor' => 'required|string|max:255',
            'quantidade' => 'required|numeric',
            'unidade ' => 'sometimes|string|max:255',
            'ordem ' => 'sometimes|numeric'
        ];

        $messages = [
            'required' => 'O campo :attribute do sku: ' . $sku . ' é obrigatório.',
            'string' => 'O campo :attribute do sku: ' . $sku . ' deve ser uma string.',
            'max' => 'O campo :attribute do sku: ' . $sku . ' não pode exceder :max caracteres.',
            'numeric' => 'O campo :attribute do sku: ' . $sku . ' deve ser um valor numérico.'
        ];

        return $this->validate((array)$data, $rules, $messages);
    }
}