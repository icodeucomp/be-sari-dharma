<?php

namespace App\Http\Controllers;

use App\Models\LayananSpesialis;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LayananSpesialisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        $query = LayananSpesialis::query(); // Hapus with('dokter')

        if ($search) {
            $query->where('nama_layanan', 'like', '%' . $search . '%');
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(LayananSpesialis::storeValidationRules());

        // Hapus dokter_ids dari validated karena kita akan proses secara terpisah
        $dokterIds = $request->input('dokter_ids', []);
        if (isset($validated['dokter_ids'])) {
            unset($validated['dokter_ids']);
        }

        // Menggunakan transaksi database untuk memastikan konsistensi data
        DB::beginTransaction();
        try {
            $layanan = LayananSpesialis::create($validated);

            // Tambahkan relasi dokter melalui jadwal dokter
            foreach ($dokterIds as $dokterId) {
                JadwalDokter::create([
                    'dokter_id' => $dokterId,
                    'spesialis_id' => $layanan->id,
                    'background_dokter' => '',
                    'jadwal_dokter' => [
                        ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '16:00']
                    ],
                    'edukasi_karir' => [
                        ['judul' => 'Pendidikan', 'tahun_mulai' => date('Y'), 'tahun_selesai' => null]
                    ]
                ]);
            }

            // Reload model dengan relasi
            $layanan->load(['jadwalDokter.dokter']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $layanan
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Menampilkan data layanan spesialis berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $layanan = LayananSpesialis::with('dokter')->find($id); // Tambahkan relasi saat show

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan nama_layanan
        $slugFromData = Str::slug($layanan->nama_layanan);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug tidak sesuai dengan data',
                'data' => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananSpesialis::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(LayananSpesialis::updateValidationRules());

        // Hapus dokter_ids dari validated karena kita akan proses secara terpisah
        $dokterIds = $request->input('dokter_ids', []);
        if (isset($validated['dokter_ids'])) {
            unset($validated['dokter_ids']);
        }

        // Menggunakan transaksi database
        DB::beginTransaction();
        try {
            $layanan->update($validated);

            // Update relasi dokter melalui jadwal dokter
            if (!empty($dokterIds)) {
                // Ambil dokter_ids yang ada
                $existingDokterIds = $layanan->jadwalDokter->pluck('dokter_id')->toArray();

                // Tambahkan jadwal untuk dokter baru
                foreach ($dokterIds as $dokterId) {
                    if (!in_array($dokterId, $existingDokterIds)) {
                        JadwalDokter::create([
                            'dokter_id' => $dokterId,
                            'spesialis_id' => $layanan->id,
                            'background_dokter' => '',
                            'jadwal_dokter' => [
                                ['hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '16:00']
                            ],
                            'edukasi_karir' => [
                                ['judul' => 'Pendidikan', 'tahun_mulai' => date('Y'), 'tahun_selesai' => null]
                            ]
                        ]);
                    }
                }

                // Hapus jadwal untuk dokter yang tidak ada lagi
                foreach ($existingDokterIds as $existingId) {
                    if (!in_array($existingId, $dokterIds)) {
                        JadwalDokter::where('spesialis_id', $layanan->id)
                            ->where('dokter_id', $existingId)
                            ->delete();
                    }
                }
            } else {
                // Hapus semua jadwal jika dokter_ids kosong
                JadwalDokter::where('spesialis_id', $layanan->id)->delete();
            }

            // Reload model dengan relasi
            $layanan->load(['jadwalDokter.dokter']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $layanan
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
        $layanan = LayananSpesialis::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Menggunakan transaksi database
        DB::beginTransaction();
        try {
            // Relasi akan otomatis dihapus karena kita sudah menambahkan onDelete('cascade')
            $layanan->delete();

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
