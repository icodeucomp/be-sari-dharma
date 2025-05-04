<?php

namespace App\Http\Controllers;

use App\Models\LayananFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananFasilitasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = LayananFasilitas::query();
        if ($search) {
            $query->where('nama_fasilitas', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(LayananFasilitas::storeValidationRules());

        if ($request->hasFile('foto_header')) {
            $file = $request->file('foto_header');
            $filename = now()->format('Ymd_Hi') . '_header.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_fasilitas', $filename, 'public');
            $validated['foto_header'] = $path;
        }

        if ($request->hasFile('foto_lainnya')) {
            $file = $request->file('foto_lainnya');
            $filename = now()->format('Ymd_Hi') . '_lainnya.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_fasilitas', $filename, 'public');
            $validated['foto_lainnya'] = $path;
        }

        $layanan = LayananFasilitas::create($validated);

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 201);
    }

    /**
     * Menampilkan data layanan fasilitas berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $layanan = LayananFasilitas::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan nama_fasilitas
        $slugFromData = Str::slug($layanan->nama_fasilitas);
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
        $layanan = LayananFasilitas::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(LayananFasilitas::updateValidationRules());

        if ($request->hasFile('foto_header')) {
            if ($layanan->foto_header && Storage::disk('public')->exists($layanan->foto_header)) {
                Storage::disk('public')->delete($layanan->foto_header);
            }

            $file = $request->file('foto_header');
            $filename = now()->format('Ymd_Hi') . '_header.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_fasilitas', $filename, 'public');
            $validated['foto_header'] = $path;
        }

        if ($request->hasFile('foto_lainnya')) {
            if ($layanan->foto_lainnya && Storage::disk('public')->exists($layanan->foto_lainnya)) {
                Storage::disk('public')->delete($layanan->foto_lainnya);
            }

            $file = $request->file('foto_lainnya');
            $filename = now()->format('Ymd_Hi') . '_lainnya.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/layanan_fasilitas', $filename, 'public');
            $validated['foto_lainnya'] = $path;
        }

        $layanan->update($validated);

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function destroy($id)
    {
        $layanan = LayananFasilitas::find($id);

        if (!$layanan) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($layanan->foto_header && Storage::disk('public')->exists($layanan->foto_header)) {
            Storage::disk('public')->delete($layanan->foto_header);
        }

        if ($layanan->foto_lainnya && Storage::disk('public')->exists($layanan->foto_lainnya)) {
            Storage::disk('public')->delete($layanan->foto_lainnya);
        }

        $layanan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
