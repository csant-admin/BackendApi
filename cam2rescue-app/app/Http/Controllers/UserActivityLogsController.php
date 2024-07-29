<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivityLog;

class UserActivityLogsController extends Controller
{
    //
    public function store(Request $request) {
        $validatedData = $request->validate([
            'event_type' => 'required|string|max:200',
            'event_data' => 'nullable|json',
        ]);
        $event_type = $validatedData['event_type'];
        $eventData = $validatedData['event_data'];

        UserActivityLog::create(['Title' => $event_type, 'Activity' => $eventData]);

        return response()->json(['message' => 'Log saved successfully'], 200);
    }
}
