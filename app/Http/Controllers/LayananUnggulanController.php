<?php

namespace App\Http\Controllers;

use App\Models\LayananUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananUnggulanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = LayananUnggulan::query();
        if ($search) {
            $query->where('nama_layanan', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(LayananUnggulan::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_His') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_unggulan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $layanan = LayananUnggulan::create($validated);

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 201);
    }

    public function show($id)
    {
        $layanan = LayananUnggulan::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananUnggulan::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(LayananUnggulan::updateValidationRules());

        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
                Storage::disk('public')->delete($layanan->foto);
            }

            // Simpan file baru dengan nama yang diubah
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_unggulan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $layanan->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function destroy($id)
    {
        $layanan = LayananUnggulan::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        // Hapus file jika ada
        if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
            Storage::disk('public')->delete($layanan->foto);
        }

        $layanan->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
