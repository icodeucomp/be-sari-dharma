<?php

namespace App\Http\Controllers;

use App\Models\KontenSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontenSocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type'); // Tambahkan parameter query type
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        $query = KontenSocialMedia::query();

        if ($search) {
            $query->where('type', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan type (youtube atau instagram)
        if ($type) {
            $query->where('type', $type);
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(KontenSocialMedia::storeValidationRules());

        // Cek apakah sudah ada data dengan type yang sama
        $existingContent = KontenSocialMedia::where('type', $validated['type'])->first();

        DB::beginTransaction();
        try {
            // Jika sudah ada data dengan type yang sama, update saja
            if ($existingContent) {
                $existingContent->update($validated);
                $konten = $existingContent;
                $message = 'Data berhasil diperbarui';
                $statusCode = 200;
            } else {
                // Jika belum ada, buat data baru
                $konten = KontenSocialMedia::create($validated);
                $message = 'Data berhasil dibuat';
                $statusCode = 201;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $konten
            ], $statusCode);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function show($id)
    {
        $konten = KontenSocialMedia::find($id);

        if (!$konten) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $konten
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(KontenSocialMedia::updateValidationRules());

        DB::beginTransaction();
        try {
            // hapus semua konten dengan type yang sama sebelum menambahkan yang baru
            KontenSocialMedia::whereType($id)->delete();

            // Validasi dan simpan setiap link
            foreach ($request->links as $link) {
                if (filter_var($link, FILTER_VALIDATE_URL) === false) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Link tidak valid: ' . $link,
                        'data' => null
                    ], 422);
                }

                $konten = KontenSocialMedia::create([
                    'type' => $validated['type'],
                    'links' => $link
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $konten
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function destroy($id)
    {
        $konten = KontenSocialMedia::find($id);

        if (!$konten) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $konten->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
