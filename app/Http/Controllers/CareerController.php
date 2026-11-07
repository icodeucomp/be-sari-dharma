<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = Career::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('position', $this->like(), $this->likeTerm((string) $search))
                    ->orWhere('division', $this->like(), $this->likeTerm((string) $search));
            });
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Career::storeValidationRules());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/career', $filename, 'public');
            $validated['photo'] = $path;
        }

        $career = Career::create($validated);

        return response()->json([
            'success' => true,
            'data' => $career,
        ], 201);
    }

    public function show($slug, $id)
    {
        $career = Career::find($id);

        if (! $career) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($career->position);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $career,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $career = Career::find($id);

        if (! $career) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(Career::updateValidationRules());

        if ($request->hasFile('photo')) {
            if ($career->photo && Storage::disk('public')->exists($career->photo)) {
                Storage::disk('public')->delete($career->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/career', $filename, 'public');
            $validated['photo'] = $path;
        }

        $career->update($validated);

        return response()->json([
            'success' => true,
            'data' => $career,
        ], 200);
    }

    public function destroy($id)
    {
        $career = Career::find($id);

        if (! $career) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($career->photo && Storage::disk('public')->exists($career->photo)) {
            Storage::disk('public')->delete($career->photo);
        }

        $career->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
