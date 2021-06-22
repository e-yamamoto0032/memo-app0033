<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SheetRequest extends FormRequest
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
            'title' => ['required', 'max:10', 'regex:/^[ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・’＠]+$/u'],
            'body' => ['required', 'max:20', 'regex:/^[ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・’＠]+$/u'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'シート名は必須です。',
            'title.max' => 'シート名は１０文字以内で入力して下さい。',
            'title.regex' => 'シート名は全角で入力して下さい。',
            'body.required'  => '内容は必須です。',
            'body.max'  => '内容は２０文字以内で入力して下さい。',
            'body.regex'  => '内容は全角で入力して下さい。',
        ];
    }
}
