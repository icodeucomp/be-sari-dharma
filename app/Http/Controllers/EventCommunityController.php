<?php

namespace App\Http\Controllers;

use App\Models\EventCommunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventCommunityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = EventCommunity::query();
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(EventCommunity::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/event_community', $filename, 'public');
            $validated['foto'] = $path;
        }

        $event = EventCommunity::create($validated);

        return response()->json([
            'success' => true,
            'data' => $event
        ], 201);
    }

    public function show($id)
    {
        $event = EventCommunity::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $event
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $event = EventCommunity::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(EventCommunity::updateValidationRules());

        if ($request->hasFile('foto')) {
            if ($event->foto && Storage::disk('public')->exists($event->foto)) {
                Storage::disk('public')->delete($event->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/event_community', $filename, 'public');
            $validated['foto'] = $path;
        }

        $event->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $event
        ], 200);
    }

    public function destroy($id)
    {
        $event = EventCommunity::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($event->foto && Storage::disk('public')->exists($event->foto)) {
            Storage::disk('public')->delete($event->foto);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
