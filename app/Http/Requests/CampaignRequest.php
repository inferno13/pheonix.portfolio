<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'first_partners_count_target' => 'numeric|gt:0',
            'second_partners_count_target' => 'numeric|gt:0',
            'first_pull_target' => 'numeric|gt:0',
            'second_pull_target' => 'numeric|gt:0',
            'first_and_second_pull_target' => 'numeric|gt:0',
            'quick_bonus_value_target' => 'numeric|gt:0',
            'quick_bonus_value_time' => 'numeric|gt:0',
        ];

        foreach(range(1, 11) as $index) {
            $rules['level_' . $index] = 'numeric|between:0,1';
        }
        return $rules;
    }
}
