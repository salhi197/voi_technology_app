<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shift;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Worker phone pings this every ~15s while on shift
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $shift = Shift::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (! $shift) {
            return response()->json(['message' => 'No active shift'], 422);
        }

        Location::create([
            'shift_id' => $shift->id,
            'user_id' => auth()->id(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'recorded_at' => now(),
        ]);

        return response()->json(['status' => 'ok']);
    }

    // Manager-facing map page
    public function dashboard()
    {
        return view('location.dashboard');
    }

    // Manager dashboard polls this for current positions
    public function liveData()
    {
        $activeShifts = Shift::where('status', 'active')->with('user')->get();

        $data = $activeShifts->map(function ($shift) {
            $latest = Location::where('shift_id', $shift->id)
                ->latest('recorded_at')
                ->first();

            return [
                'user_name' => $shift->user->name,
                'shift_started' => $shift->clock_in_at->format('H:i'),
                'latitude' => $latest?->latitude,
                'longitude' => $latest?->longitude,
                'last_seen' => $latest?->recorded_at?->diffForHumans(),
            ];
        })->filter(fn ($d) => $d['latitude'] !== null);

        return response()->json($data->values());
    }
}