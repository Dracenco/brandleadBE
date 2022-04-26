<?php
namespace App\Http\Requests\Person;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => ['required',
                Rule::unique('people')->where(function ($query) use ($request) {
                return $query->get();
            })->ignore($this->person)],
            'order' => 'required|unique:people'
        ];
    }
}
