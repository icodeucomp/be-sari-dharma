<?php

namespace App\Http\Controllers;

use App\Models\Karir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KarirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = Karir::query();
        if ($search) {
            $query->where('posisi', 'like', '%' . $search . '%')
                ->orWhere('divisi', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Karir::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/karir', $filename, 'public');
            $validated['foto'] = $path;
        }

        $karir = Karir::create($validated);

        return response()->json([
            'success' => true,
            'data' => $karir
        ], 201);
    }

    /**
     * Menampilkan data karir berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan posisi
        $slugFromData = Str::slug($karir->posisi);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug tidak sesuai dengan data',
                'data' => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $karir
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(Karir::updateValidationRules());

        if ($request->hasFile('foto')) {
            if ($karir->foto && Storage::disk('public')->exists($karir->foto)) {
                Storage::disk('public')->delete($karir->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/karir', $filename, 'public');
            $validated['foto'] = $path;
        }

        $karir->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $karir
        ], 200);
    }

    public function destroy($id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($karir->foto && Storage::disk('public')->exists($karir->foto)) {
            Storage::disk('public')->delete($karir->foto);
        }

        $karir->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
