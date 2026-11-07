<?php

namespace App\Http\Controllers;

use App\Models\FacilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FacilityServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = FacilityService::query();
        if ($search) {
            $query->where('name', $this->like(), $this->likeTerm((string) $search));
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(FacilityService::storeValidationRules());

        if ($request->hasFile('header_photo')) {
            $file = $request->file('header_photo');
            $filename = now()->format('Ymd_Hi').'_header.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/services', $filename, 'public');
            $validated['header_photo'] = $path;
        }

        if ($request->hasFile('other_photo')) {
            $file = $request->file('other_photo');
            $filename = now()->format('Ymd_Hi').'_other.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/services', $filename, 'public');
            $validated['other_photo'] = $path;
        }

        $service = FacilityService::create($validated);

        return response()->json([
            'success' => true,
            'data' => $service,
        ], 201);
    }

    public function show($slug, $id)
    {
        $service = FacilityService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($service->name);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $service,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $service = FacilityService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(FacilityService::updateValidationRules());

        if ($request->hasFile('header_photo')) {
            if ($service->header_photo && Storage::disk('public')->exists($service->header_photo)) {
                Storage::disk('public')->delete($service->header_photo);
            }

            $file = $request->file('header_photo');
            $filename = now()->format('Ymd_Hi').'_header.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/services', $filename, 'public');
            $validated['header_photo'] = $path;
        }

        if ($request->hasFile('other_photo')) {
            if ($service->other_photo && Storage::disk('public')->exists($service->other_photo)) {
                Storage::disk('public')->delete($service->other_photo);
            }

            $file = $request->file('other_photo');
            $filename = now()->format('Ymd_Hi').'_other.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/services', $filename, 'public');
            $validated['other_photo'] = $path;
        }

        $service->update($validated);

        return response()->json([
            'success' => true,
            'data' => $service,
        ], 200);
    }

    public function destroy($id)
    {
        $service = FacilityService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($service->header_photo && Storage::disk('public')->exists($service->header_photo)) {
            Storage::disk('public')->delete($service->header_photo);
        }

        if ($service->other_photo && Storage::disk('public')->exists($service->other_photo)) {
            Storage::disk('public')->delete($service->other_photo);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
