<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => ['required','max:10', 'regex:/^[ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・’＠]+$/u']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タスク名は必須です。',
            'title.max' => 'タスク名は１０文字以内で入力して下さい。',
            'title.regex' => 'タスク名は全角で入力して下さい。',
        ];
    }
}
