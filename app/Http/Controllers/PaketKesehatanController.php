<?php

namespace App\Http\Controllers;

use App\Helpers\Cryptor;
use App\Models\PaketKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaketKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $cryptor = new Cryptor();
        $search = $request->query('search');
        $kategoriId = $request->query('kategori_id');
        $promo = $request->query('promo');
        $berlakuStart = $request->query('berlaku_start');
        $berlakuEnd = $request->query('berlaku_end');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        $query = PaketKesehatan::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('nama_paket', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kategori_id
        if ($kategoriId) {
            $query->where('kategori_id', $cryptor->decrypt($kategoriId));
        }

        // Filter berdasarkan promo (0 atau 1)
        if ($promo !== null && ($promo == '0' || $promo == '1')) {
            $query->where('promo', $promo);
        }

        // Filter berdasarkan masa berlaku
        if ($berlakuStart) {
            $query->whereDate('berlaku_sampai', '>=', $berlakuStart);
        }

        if ($berlakuEnd) {
            $query->whereDate('berlaku_sampai', '<=', $berlakuEnd);
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(PaketKesehatan::storeValidationRules());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/paket_kesehatan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $paket = PaketKesehatan::create($validated);

        return response()->json([
            'success' => true,
            'data' => $paket
        ], 201);
    }

    /**
     * Menampilkan data paket kesehatan berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $paket = PaketKesehatan::with('kategori')->find($id);

        if (!$paket) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan nama_paket
        $slugFromData = Str::slug($paket->nama_paket);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug tidak sesuai dengan data',
                'data' => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $paket
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $paket = PaketKesehatan::find($id);

        if (!$paket) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(PaketKesehatan::updateValidationRules());

        if ($request->hasFile('foto')) {
            if ($paket->foto && Storage::disk('public')->exists($paket->foto)) {
                Storage::disk('public')->delete($paket->foto);
            }

            $file = $request->file('foto');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/paket_kesehatan', $filename, 'public');
            $validated['foto'] = $path;
        }

        $paket->update($validated);

        return response()->json([
            'success' => true,
            'data' => $paket
        ], 200);
    }

    public function destroy($id)
    {
        $paket = PaketKesehatan::find($id);

        if (!$paket) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($paket->foto && Storage::disk('public')->exists($paket->foto)) {
            Storage::disk('public')->delete($paket->foto);
        }

        $paket->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
