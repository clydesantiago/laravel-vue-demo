<?php

namespace App\Http\Requests;

use App\Rules\ActiveEmailDomain;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'email', new ActiveEmailDomain()],
            'state' => ['required', 'in:active,unsubscribed,junk,bounced,unconfirmed'],
            'fields.*.id' => ['nullable', 'exists:fields,id'],
            'fields.*.subscriber_id' => ['nullable', 'exists:subscribers,id'],
            'fields.*.title' => ['required', 'string', 'max:255'],
            'fields.*.type' => ['required', 'in:date,number,string,boolean'],
        ];
    }
}
