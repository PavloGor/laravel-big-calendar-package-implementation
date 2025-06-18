<?php

namespace OpenHands\BigCalendar\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use OpenHands\BigCalendar\Http\Requests\StoreEventRequest;
use OpenHands\BigCalendar\Http\Requests\UpdateEventRequest;
use OpenHands\BigCalendar\Http\Resources\CalendarEventResource;
use OpenHands\BigCalendar\Models\CalendarEvent;

class CalendarEventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = CalendarEvent::with('user');

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $query->inDateRange($startDate, $endDate);
        }

        // Filter by users
        if ($request->has('user_ids') && ! empty($request->user_ids)) {
            $userIds = is_array($request->user_ids) ? $request->user_ids : explode(',', $request->user_ids);
            $query->whereIn('user_id', $userIds);
        }

        // Filter by color
        if ($request->has('color')) {
            $query->withColor($request->color);
        }

        $events = $query->orderBy('start_date')->get();

        return response()->json([
            'success' => true,
            'data' => CalendarEventResource::collection($events),
        ]);
    }

    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = CalendarEvent::create($request->validated());
        $event->load('user');

        return response()->json([
            'success' => true,
            'data' => new CalendarEventResource($event),
            'message' => 'Event created successfully',
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $calendarEvent = CalendarEvent::findOrFail($id);
        $calendarEvent->load('user');

        return response()->json([
            'success' => true,
            'data' => new CalendarEventResource($calendarEvent),
        ]);
    }

    public function update(UpdateEventRequest $request, $id): JsonResponse
    {
        $calendarEvent = CalendarEvent::findOrFail($id);
        $calendarEvent->update($request->validated());
        $calendarEvent->load('user');

        return response()->json([
            'success' => true,
            'data' => new CalendarEventResource($calendarEvent),
            'message' => 'Event updated successfully',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $calendarEvent = CalendarEvent::findOrFail($id);
        $calendarEvent->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ]);
    }

    public function move(Request $request, $id): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $calendarEvent = CalendarEvent::findOrFail($id);
        $calendarEvent->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $calendarEvent->load('user');

        return response()->json([
            'success' => true,
            'data' => new CalendarEventResource($calendarEvent),
            'message' => 'Event moved successfully',
        ]);
    }

    public function resize(Request $request, $id): JsonResponse
    {
        $request->validate([
            'end_date' => 'required|date|after:start_date',
        ]);

        $calendarEvent = CalendarEvent::findOrFail($id);
        $calendarEvent->update([
            'end_date' => $request->end_date,
        ]);

        $calendarEvent->load('user');

        return response()->json([
            'success' => true,
            'data' => new CalendarEventResource($calendarEvent),
            'message' => 'Event resized successfully',
        ]);
    }
}
