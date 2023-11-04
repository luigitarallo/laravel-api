<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'cover_image' => ['nullable', 'image'],
            'description' => ['required', 'string'],
            'link' => ['required', 'url'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'You have to insert a project name',
            'name.string' => 'Name must be a string',

            'cover_image.image' => 'The uploaded file must be an image',

            'description.required' => 'You have to insert a project description',
            'description.string' => 'Description must be a string',

            'link.required' => 'You have to insert a project url',
            'link.url' => 'Insert a valid url',

            'type_id.exists' => 'Type is not valid',

            'technologies.exists' => 'Technologies checked are not valid'
        ];
    }

}
