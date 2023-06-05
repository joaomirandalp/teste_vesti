<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
abstract class CustomValidator {
    protected function validate(array $data, array $rules, array $messages){
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        return [];
    }
}