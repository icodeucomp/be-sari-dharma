<?php

namespace App\Http\Controllers;

use App\Models\ArtikelKesehatan;
use App\Helpers\Cryptor;
use App\Models\MasterDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelKesehatanController extends Controller
{
    protected $cryptor;

    public function __construct()
    {
        $this->cryptor = new Cryptor();
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $kategoriId = $request->query('kategori_id');
        $dokterTerkait = $request->query('dokter_terkait');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        $query = ArtikelKesehatan::with(['kategori']);

        // Filter berdasarkan judul
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kategori_id
        if ($kategoriId) {
            $decryptedKategoriId = $this->cryptor->decrypt($kategoriId);
            $query->where('kategori_id', $decryptedKategoriId);
        }

        // Filter berdasarkan dokter_terkait
        if ($dokterTerkait) {
            // Jika dokter_terkait dikirim sebagai string, dekripsi
            if (is_string($dokterTerkait)) {
                $decryptedDokterId = $this->cryptor->decrypt($dokterTerkait);

                // Filter artikel yang memiliki dokter_id spesifik dalam array dokter_terkait
                $query->where(function ($q) use ($decryptedDokterId) {
                    $q->whereJsonContains('dokter_terkait', $decryptedDokterId)
                        ->orWhereJsonContains('dokter_terkait', (string) $decryptedDokterId);
                });
            }

            // Jika dokter_terkait dikirim sebagai array
            else if (is_array($dokterTerkait)) {
                $query->where(function ($q) use ($dokterTerkait) {
                    foreach ($dokterTerkait as $dokterId) {
                        $decryptedDokterId = $this->cryptor->decrypt($dokterId);
                        Log::info('Decrypted Dokter ID: ' . $decryptedDokterId);
                        $q->orWhereJsonContains('dokter_terkait', $decryptedDokterId)
                            ->orWhereJsonContains('dokter_terkait', (string) $decryptedDokterId);
                    }
                });
            }
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(ArtikelKesehatan::storeValidationRules());

        // Dekripsi ID dokter dalam array dokter_terkait
        if (isset($validated['dokter_terkait']) && is_array($validated['dokter_terkait'])) {
            $decryptedDokterIds = [];
            foreach ($validated['dokter_terkait'] as $dokterId) {
                try {
                    // Coba dekripsi ID dokter
                    $decryptedId = $this->cryptor->decrypt($dokterId);
                    $decryptedDokterIds[] = $decryptedId;
                } catch (\Exception $e) {
                    // Jika gagal dekripsi, gunakan nilai asli
                    $decryptedDokterIds[] = $dokterId;
                }
            }
            $validated['dokter_terkait'] = $decryptedDokterIds;
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/artikel_kesehatan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $artikel = ArtikelKesehatan::create($validated);

        return response()->json([
            'success' => true,
            'data' => $artikel
        ], 201);
    }

    /**
     * Menampilkan data artikel kesehatan berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $artikel = ArtikelKesehatan::with('kategori')->find($id); // Tambahkan relasi saat show

        if (!$artikel) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan judul
        $slugFromData = Str::slug($artikel->judul);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug tidak sesuai dengan data',
                'data' => null
            ], 400);
        }

        $dokterTerkait = [];

        foreach ($artikel->dokter_terkait as $dokterId) {
            if ($dokterId === false) {
                continue; // Lewati jika ID dokter tidak valid
            }

            $dokter = MasterDokter::find($dokterId);
            if ($dokter) {
                // Coba dekripsi ID dokter
                $dokterTerkait[] = $dokter;
            }
        }

        $artikel->dokter_terkait = $dokterTerkait;


        return response()->json([
            'success' => true,
            'data' => $artikel
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $artikel = ArtikelKesehatan::find($id);

        if (!$artikel) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(ArtikelKesehatan::updateValidationRules());

        // Dekripsi ID dokter dalam array dokter_terkait
        if (isset($validated['dokter_terkait']) && is_array($validated['dokter_terkait'])) {
            $decryptedDokterIds = [];
            foreach ($validated['dokter_terkait'] as $dokterId) {
                try {
                    // Coba dekripsi ID dokter
                    $decryptedId = $this->cryptor->decrypt($dokterId);
                    $decryptedDokterIds[] = $decryptedId;
                } catch (\Exception $e) {
                    // Jika gagal dekripsi, gunakan nilai asli
                    $decryptedDokterIds[] = $dokterId;
                }
            }
            $validated['dokter_terkait'] = $decryptedDokterIds;
        }

        Log::debug('Validated data for update: ', $validated);

        if ($request->hasFile('foto')) {
            if ($artikel->foto && Storage::disk('public')->exists($artikel->foto)) {
                Storage::disk('public')->delete($artikel->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/artikel_kesehatan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $artikel->update($validated);

        return response()->json([
            'success' => true,
            'data' => $artikel
        ], 200);
    }

    public function destroy($id)
    {
        $artikel = ArtikelKesehatan::find($id);

        if (!$artikel) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($artikel->foto && Storage::disk('public')->exists($artikel->foto)) {
            Storage::disk('public')->delete($artikel->foto);
        }

        $artikel->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
