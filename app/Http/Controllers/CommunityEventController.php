<?php

namespace App\Http\Controllers;

use App\Models\CommunityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommunityEventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = CommunityEvent::query();
        if ($search) {
            $query->where('title', $this->like(), $this->likeTerm((string) $search));
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(CommunityEvent::storeValidationRules());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/community_event', $filename, 'public');
            $validated['photo'] = $path;
        }

        $event = CommunityEvent::create($validated);

        return response()->json([
            'success' => true,
            'data' => $event,
        ], 201);
    }

    public function show($slug, $id)
    {
        $event = CommunityEvent::with('category')->find($id);

        if (! $event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($event->title);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $event,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $event = CommunityEvent::find($id);

        if (! $event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(CommunityEvent::updateValidationRules());

        if ($request->hasFile('photo')) {
            if ($event->photo && Storage::disk('public')->exists($event->photo)) {
                Storage::disk('public')->delete($event->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/community_event', $filename, 'public');
            $validated['photo'] = $path;
        }

        $event->update($validated);

        return response()->json([
            'success' => true,
            'data' => $event,
        ], 200);
    }

    public function destroy($id)
    {
        $event = CommunityEvent::find($id);

        if (! $event) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($event->photo && Storage::disk('public')->exists($event->photo)) {
            Storage::disk('public')->delete($event->photo);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
