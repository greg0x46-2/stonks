<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'asset_id' => 'required',
            'market_id' => 'required',
            'type' => 'required',
            'executed_at' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'fee_percentage',
            'fee'
        ];
    }
}
