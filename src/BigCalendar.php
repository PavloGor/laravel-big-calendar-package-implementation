<?php

namespace OpenHands\BigCalendar;

use OpenHands\BigCalendar\Models\CalendarEvent;
use OpenHands\BigCalendar\Models\CalendarUser;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class BigCalendar
{
    public function getEvents(array $filters = []): Collection
    {
        $query = CalendarEvent::with('user');

        if (isset($filters['start_date'])) {
            $query->where('start_date', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->where('end_date', '<=', $filters['end_date']);
        }

        if (isset($filters['user_ids']) && !empty($filters['user_ids'])) {
            $query->whereIn('user_id', $filters['user_ids']);
        }

        if (isset($filters['color'])) {
            $query->where('color', $filters['color']);
        }

        return $query->orderBy('start_date')->get();
    }

    public function createEvent(array $data): CalendarEvent
    {
        return CalendarEvent::create($data);
    }

    public function updateEvent(int $id, array $data): CalendarEvent
    {
        $event = CalendarEvent::findOrFail($id);
        $event->update($data);
        return $event->fresh();
    }

    public function deleteEvent(int $id): bool
    {
        return CalendarEvent::destroy($id) > 0;
    }

    public function getUsers(): Collection
    {
        return CalendarUser::all();
    }

    public function getEventsForDateRange(Carbon $start, Carbon $end, array $userIds = []): Collection
    {
        return $this->getEvents([
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
            'user_ids' => $userIds,
        ]);
    }
}
