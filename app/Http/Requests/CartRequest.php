<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpseclib3\Math\PrimeField\Integer;

class CartRequest extends FormRequest
{
//    private array $options;
//    private int $quantity;
//
//    /**
//     * @param array $options
//     * @param int $quantity
//     */
//    public function __construct(array $options, int $quantity)
//    {
//        $this->options = $options;
//        $this->quantity = $quantity;
//    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'options' => 'required|array',
            'quantity' => 'required|integer',
        ];
    }
}
