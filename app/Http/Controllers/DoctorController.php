<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);

        $query = Doctor::query();

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
        $validated = $request->validate(Doctor::storeValidationRules());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/doctor', $filename, 'public');
            $validated['photo'] = $path;
        }

        DB::beginTransaction();
        try {
            $doctor = Doctor::create($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $doctor,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($validated['photo']) && Storage::disk('public')->exists($validated['photo'])) {
                Storage::disk('public')->delete($validated['photo']);
            }

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (! $doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $doctor,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (! $doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(Doctor::updateValidationRules());

        if ($request->hasFile('photo')) {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/doctor', $filename, 'public');
            $validated['photo'] = $path;
        }

        DB::beginTransaction();
        try {
            $doctor->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $doctor,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (! $doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        DB::beginTransaction();
        try {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
            }

            $doctor->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
