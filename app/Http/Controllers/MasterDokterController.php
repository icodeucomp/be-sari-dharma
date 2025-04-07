<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MasterDokterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        $query = MasterDokter::query();

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
        $validated = $request->validate(MasterDokter::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/master_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        // Menggunakan transaksi database untuk memastikan konsistensi data
        DB::beginTransaction();
        try {
            $dokter = MasterDokter::create($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $dokter
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file yang sudah diupload jika ada error
            if (isset($validated['foto']) && Storage::disk('public')->exists($validated['foto'])) {
                Storage::disk('public')->delete($validated['foto']);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Menampilkan data dokter berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $dokter = MasterDokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dokter
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $dokter = MasterDokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(MasterDokter::updateValidationRules());

        if ($request->hasFile('foto')) {
            if ($dokter->foto && Storage::disk('public')->exists($dokter->foto)) {
                Storage::disk('public')->delete($dokter->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/master_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        // Menggunakan transaksi database
        DB::beginTransaction();
        try {
            $dokter->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $dokter
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function destroy($id)
    {
        $dokter = MasterDokter::find($id);

        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Menggunakan transaksi database
        DB::beginTransaction();
        try {
            // Hapus foto jika ada
            if ($dokter->foto && Storage::disk('public')->exists($dokter->foto)) {
                Storage::disk('public')->delete($dokter->foto);
            }

            $dokter->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
