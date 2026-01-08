<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPokemonInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'names' => 'required|array|min:1',
            'names.*' => 'string|distinct|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $names = $this->query('names');

        if (is_string($names)) {
            $this->merge([
                'names' => explode(',', $names)
            ]);
        }
    }
}
