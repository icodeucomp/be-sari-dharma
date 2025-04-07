<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use App\Models\MasterDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $dokterId = $request->query('dokter_id');
        $spesialisId = $request->query('spesialis_id');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        $query = JadwalDokter::query(); // Hapus with(['dokter', 'spesialis'])

        if ($search) {
            $query->whereHas('dokter', function ($q) use ($search) {
                $q->where('nama_dokter', 'like', '%' . $search . '%');
            });
        }

        if ($dokterId) {
            $query->where('dokter_id', $dokterId);
        }

        if ($spesialisId) {
            $query->where('spesialis_id', $spesialisId);
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

        // Handle jadwal_dokter jika dikirim sebagai string JSON
        if (isset($validated['jadwal_dokter']) && is_string($validated['jadwal_dokter'])) {
            $validated['jadwal_dokter'] = json_decode($validated['jadwal_dokter'], true);

            // Jika gagal decode atau hasilnya bukan array, set nilai default
            if (!is_array($validated['jadwal_dokter'])) {
                $validated['jadwal_dokter'] = [
                    ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '16:00']
                ];
            }
        }

        // Handle edukasi_karir jika dikirim sebagai string JSON
        if (isset($validated['edukasi_karir']) && is_string($validated['edukasi_karir'])) {
            $validated['edukasi_karir'] = json_decode($validated['edukasi_karir'], true);

            // Jika gagal decode atau hasilnya bukan array, set nilai default
            if (!is_array($validated['edukasi_karir'])) {
                $validated['edukasi_karir'] = [
                    ['judul' => 'Pendidikan', 'tahun_mulai' => date('Y'), 'tahun_selesai' => null]
                ];
            }
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jadwal_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        // Cek apakah kombinasi dokter_id dan spesialis_id sudah ada
        $exists = JadwalDokter::where('dokter_id', $validated['dokter_id'])
            ->where('spesialis_id', $validated['spesialis_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal untuk dokter dan spesialis ini sudah ada',
                'data' => null
            ], 422);
        }

        DB::beginTransaction();
        try {
            $jadwal = JadwalDokter::create($validated);

            // Reload model dengan relasi
            $jadwal->load(['dokter', 'spesialis']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $jadwal
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

    public function show($id)
    {
        $jadwal = JadwalDokter::with(['dokter', 'spesialis'])->find($id); // Tambahkan relasi saat show

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
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
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(JadwalDokter::updateValidationRules());

        // Handle jadwal_dokter jika dikirim sebagai string JSON
        if (isset($validated['jadwal_dokter']) && is_string($validated['jadwal_dokter'])) {
            $validated['jadwal_dokter'] = json_decode($validated['jadwal_dokter'], true);

            // Jika gagal decode atau hasilnya bukan array, gunakan data yang ada
            if (!is_array($validated['jadwal_dokter'])) {
                $validated['jadwal_dokter'] = $jadwal->jadwal_dokter;
            }
        }

        // Handle edukasi_karir jika dikirim sebagai string JSON
        if (isset($validated['edukasi_karir']) && is_string($validated['edukasi_karir'])) {
            $validated['edukasi_karir'] = json_decode($validated['edukasi_karir'], true);

            // Jika gagal decode atau hasilnya bukan array, gunakan data yang ada
            if (!is_array($validated['edukasi_karir'])) {
                $validated['edukasi_karir'] = $jadwal->edukasi_karir;
            }
        }

        // Jika dokter_id atau spesialis_id berubah, cek apakah kombinasi baru sudah ada
        if (($request->has('dokter_id') && $jadwal->dokter_id != $validated['dokter_id']) ||
            ($request->has('spesialis_id') && $jadwal->spesialis_id != $validated['spesialis_id'])
        ) {

            $exists = JadwalDokter::where('dokter_id', $validated['dokter_id'])
                ->where('spesialis_id', $validated['spesialis_id'])
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal untuk dokter dan spesialis ini sudah ada',
                    'data' => null
                ], 422);
            }
        }

        if ($request->hasFile('foto')) {
            if ($jadwal->foto && Storage::disk('public')->exists($jadwal->foto)) {
                Storage::disk('public')->delete($jadwal->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jadwal_dokter', $filename, 'public');
            $validated['foto'] = $path;
        }

        DB::beginTransaction();
        try {
            $jadwal->update($validated);

            // Reload model dengan relasi
            $jadwal->load(['dokter', 'spesialis']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $jadwal
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
        $jadwal = JadwalDokter::find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        DB::beginTransaction();
        try {
            if ($jadwal->foto && Storage::disk('public')->exists($jadwal->foto)) {
                Storage::disk('public')->delete($jadwal->foto);
            }

            $jadwal->delete();

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
