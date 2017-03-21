<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'project_id' => 'required',
            'name' => 'required',
            'task_types_id' => 'required',
            'responsible_id' => 'required',
            'status_id' => 'required',
            'priority_id' => 'required',
            'estimated_start_date' => 'before_or_equal:estimated_end_date',
        ];
    }
}
