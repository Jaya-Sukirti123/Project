<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function redirect;
//use App\Http\Requests\Request;

class CreateCategoryRequest extends FormRequest
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
            'category_name' => 'required|max:50|bail'
        ];
    }
    
    public function response(array $errors)
    {
        return redirect()->back()->withInput()->withErrors($errors);
    }
}
