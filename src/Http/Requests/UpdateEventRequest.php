<?php

namespace OpenHands\BigCalendar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'color' => 'sometimes|required|in:blue,green,red,yellow,purple,orange,gray',
            'user_id' => 'sometimes|required|exists:calendar_users,id',
            'all_day' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Event title is required',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'end_date.after' => 'End date must be after start date',
            'color.required' => 'Event color is required',
            'color.in' => 'Invalid color selected',
            'user_id.required' => 'User is required',
            'user_id.exists' => 'Selected user does not exist',
        ];
    }
}
