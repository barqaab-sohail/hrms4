<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class PrConsultancyCostStore extends FormRequest
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
            
            'pr_cost_type_id'=>'required|numeric',
            'man_month_cost'=>'required',
            
        ];
    }
}
