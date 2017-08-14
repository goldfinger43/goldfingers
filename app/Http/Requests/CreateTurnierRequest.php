<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTurnierRequest extends FormRequest
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
            'name' => 'required',
            'untergrund' => 'required',
            'von_datum' => 'required|date',
            'bis_datum' => 'required|date|after:von_datum',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Turnierankündigung ohne Name? Schwach...',
            'untergrund.required'  => 'Auf irgendwas müssen wir spielen.',
            'von_datum.required' => 'Wann solls dann stattfinden?',
            'bis_datum.after' => 'Es hat aufgehört bevor es überhaupt begonnen hat. Schade!',
            'bis_datum.required' => 'Alles Gute hat ein Ende!',
        ];
    }
}
