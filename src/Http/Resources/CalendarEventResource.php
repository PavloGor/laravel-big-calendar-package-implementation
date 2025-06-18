<?php

namespace OpenHands\BigCalendar\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarEventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'startDate' => $this->start_date?->toISOString(),
            'endDate' => $this->end_date?->toISOString(),
            'color' => $this->color,
            'allDay' => $this->all_day,
            'isMultiDay' => $this->is_multi_day,
            'durationMinutes' => $this->duration_minutes,
            'user' => new CalendarUserResource($this->whenLoaded('user')),
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
