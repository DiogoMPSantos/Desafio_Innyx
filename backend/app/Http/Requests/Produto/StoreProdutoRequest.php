<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:50'],
            'descricao' => ['required', 'string', 'max:200'],
            'preco' => ['required', 'numeric', 'gt:0'],
            'data_validade' => ['required', 'date', 'after_or_equal:today'],
            'imagem' => ['nullable', 'image', 'max:2048'],
            'categoria_id' => ['required', Rule::exists('categorias', 'id')],
        ];
    }
}
