<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotPut extends FormRequest
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
            //
            'slot_name' => 'required',
            'contents.*.content_id' => 'exists:contents,id',
            'contents.*.seq' => 'required_with:contents.*.content_id|numeric',
            'contents.*.seconds' => 'required_with:contents.*.content_id|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'contents.*.content_id' => 'content id',
            'contents.*.seq' => 'seq',
            'contents.*.seconds' => 'seconds',
        ];
    }
}
