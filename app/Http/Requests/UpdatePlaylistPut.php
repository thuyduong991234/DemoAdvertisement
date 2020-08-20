<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaylistPut extends FormRequest
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
            'contract_id' => 'required|exists:contracts,id',
            'playlist_name' => 'required',
            'refresh_span_seconds' => 'numeric',
            'slots.*.id' => 'exists:playlist_slots,id',
            'slots.*.seq' => 'required_with:slots.*.id|numeric',
            'slots.*.seconds' => 'required_with:slots.*.id|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'slots.*.id' => 'id',
            'slots.*.seq' => 'seq',
            'slots.*.seconds' => 'seconds',
        ];
    }
}
