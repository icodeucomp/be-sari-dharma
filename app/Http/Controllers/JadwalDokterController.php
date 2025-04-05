<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = JadwalDokter::query();
        if ($search) {
            $query->where('nama_dokter', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(JadwalDokter::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jadwal_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        $jadwal = JadwalDokter::create($validated);

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ], 201);
    }

    public function show($id)
    {
        $jadwal = JadwalDokter::find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(JadwalDokter::updateValidationRules());

        if ($request->hasFile('foto')) {
            if ($jadwal->foto && Storage::disk('public')->exists($jadwal->foto)) {
                Storage::disk('public')->delete($jadwal->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jadwal_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        $jadwal->update($validated);

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ], 200);
    }

    public function destroy($id)
    {
        $jadwal = JadwalDokter::find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($jadwal->foto && Storage::disk('public')->exists($jadwal->foto)) {
            Storage::disk('public')->delete($jadwal->foto);
        }

        $jadwal->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
