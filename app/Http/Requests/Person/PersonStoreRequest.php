<?php
namespace App\Http\Requests\Person;
use Illuminate\Foundation\Http\FormRequest;

class PersonStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:people',
            'order' => 'required|unique:people'
        ];
    }
}
