<?php

namespace App\Http\Controllers;

use App\Models\ArtikelKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        $query = ArtikelKesehatan::query(); // Pastikan tidak ada with()
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
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
