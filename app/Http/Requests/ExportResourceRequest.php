<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportResourceRequest extends FormRequest
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
            'extension'=>'required|in:pdf,xls,csv,xml',
            'start'=>'required_if:type,list|date_format:Y-m-d',
            'end'=>'required_if:type,list|date_format:Y-m-d',
        ];
    }
}
