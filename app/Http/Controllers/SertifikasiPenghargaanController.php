<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiPenghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertifikasiPenghargaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru: ambil param page
        $query = SertifikasiPenghargaan::query();
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
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
        $validated = $request->validate(SertifikasiPenghargaan::storeValidationRules());

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/sertifikasi_penghargaan', $filename, 'public');
            $validated['file_pdf'] = $path;
        }

        $sertifikasi = SertifikasiPenghargaan::create($validated);

        return response()->json([
            'success' => true,
            'data' => $sertifikasi
        ], 201);
    }

    public function show($id)
    {
        $sertifikasi = SertifikasiPenghargaan::find($id);

        if (!$sertifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $sertifikasi
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $sertifikasi = SertifikasiPenghargaan::find($id);

        if (!$sertifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(SertifikasiPenghargaan::updateValidationRules());

        if ($request->hasFile('file_pdf')) {
            if ($sertifikasi->file_pdf && Storage::disk('public')->exists($sertifikasi->file_pdf)) {
                Storage::disk('public')->delete($sertifikasi->file_pdf);
            }

            $file = $request->file('file_pdf');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/sertifikasi_penghargaan', $filename, 'public');
            $validated['file_pdf'] = $path;
        }

        $sertifikasi->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $sertifikasi
        ], 200);
    }

    public function destroy($id)
    {
        $sertifikasi = SertifikasiPenghargaan::find($id);

        if (!$sertifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($sertifikasi->file_pdf && Storage::disk('public')->exists($sertifikasi->file_pdf)) {
            Storage::disk('public')->delete($sertifikasi->file_pdf);
        }

        $sertifikasi->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
