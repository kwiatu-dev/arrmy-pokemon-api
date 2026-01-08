<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomPokemonRequest extends FormRequest
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
            'name' => 'required|string|min:3|unique:custom_pokemons,name',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'types' => 'required|array',
            'types.*' => 'string'
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                $name = strtolower($this->input('name'));
                $baseUrl = config('services.pokeapi.url');
                $response = Http::withoutVerifying()->get($baseUrl . $name);

                if ($response->successful()) {
                    $validator->errors()->add(
                        'name',
                        "Pokemon '$name' already exists in the official PokeAPI registry!"
                    );
                }
            }
        ];
    }
}
