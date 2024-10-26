<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|string|lowercase|max:100',
            'phone_number' => 'required|string|max:15|regex:/^[\d+\s-]+$/',
            'started_at' => 'required|date|after:today',
            'total_participant' => 'required|numeric|min:1'
        ];
    }
}
