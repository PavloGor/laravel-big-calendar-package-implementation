<?php

namespace OpenHands\BigCalendar\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use OpenHands\BigCalendar\Http\Resources\CalendarUserResource;
use OpenHands\BigCalendar\Models\CalendarUser;

class CalendarUserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = CalendarUser::active()->get();

        return response()->json([
            'success' => true,
            'data' => CalendarUserResource::collection($users),
        ]);
    }

    public function show(CalendarUser $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new CalendarUserResource($user),
        ]);
    }
}
