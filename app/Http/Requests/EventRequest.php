<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeId = $this->route('event');
        return [
            'name' => 'required|min:3|unique:events,name,' . $routeId . ',uuid',
            'description' => 'required|min:3',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
             'photo' => $this->method() === 'POST' ? 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg' : 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}