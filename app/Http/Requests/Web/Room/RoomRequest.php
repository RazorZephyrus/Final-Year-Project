<?php

namespace App\Http\Requests\Web\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'title' => 'required',
            'room_type_id' => 'required',
            'asrama_id' => 'required',
            'fasilitas' => 'required',
            'perhari' => 'required',
            'perbulan' => 'required',
            'persemester' => 'required',
            'images' => 'nullable'
        ];
    }
}
