<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\MainRequest;

class PostRequest extends MainRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if(Request::ismethod('POST')) {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png',
                'status' => 'required|in:0,1'    
            ];    
        }
        elseif(Request::ismethod('PUT')) {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpg,jpeg,png',
                'status' => 'required|in:0,1'
            ];    
        }
    }
}
