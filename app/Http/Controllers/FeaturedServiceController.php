<?php

namespace App\Http\Controllers;

use App\Models\FeaturedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FeaturedServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = FeaturedService::query();
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
        $validated = $request->validate(FeaturedService::storeValidationRules());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/featured_service', $filename, 'public');
            $validated['photo'] = $path;
        }

        $service = FeaturedService::create($validated);

        return response()->json([
            'success' => true,
            'data' => $service,
        ], 201);
    }

    public function show($slug, $id)
    {
        $featuredService = FeaturedService::find($id);

        if (! $featuredService) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($featuredService->name);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $featuredService,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $service = FeaturedService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(FeaturedService::updateValidationRules());

        if ($request->hasFile('photo')) {
            if ($service->photo && Storage::disk('public')->exists($service->photo)) {
                Storage::disk('public')->delete($service->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/featured_service', $filename, 'public');
            $validated['photo'] = $path;
        }

        $service->update($validated);

        return response()->json([
            'success' => true,
            'data' => $service,
        ], 200);
    }

    public function destroy($id)
    {
        $service = FeaturedService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($service->photo && Storage::disk('public')->exists($service->photo)) {
            Storage::disk('public')->delete($service->photo);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
