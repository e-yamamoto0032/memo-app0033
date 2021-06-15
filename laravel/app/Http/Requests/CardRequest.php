<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'body' => ['required','max:10', 'regex:/^[ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・’＠]+$/u']
        ];
    }

    public function messages()
    {
        return [
            'body.required' => '内容は必須です。',
            'body.max' => '内容は１０文字以内で入力して下さい。',
            'body.regex' => '内容は全角で入力して下さい。',
        ];
    }
}
