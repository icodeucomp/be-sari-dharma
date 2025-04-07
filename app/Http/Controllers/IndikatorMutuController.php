<?php

namespace App\Http\Controllers;

use App\Models\IndikatorMutu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndikatorMutuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = IndikatorMutu::query();
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
        $validated = $request->validate(IndikatorMutu::storeValidationRules());

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/indikator_mutu', $filename, 'public');
            $validated['file_pdf'] = $path;
        }

        $indikator = IndikatorMutu::create($validated);

        return response()->json([
            'success' => true,
            'data' => $indikator
        ], 201);
    }

    /**
     * Menampilkan data indikator mutu berdasarkan slug dan id.
     *
     * @param  string  $slug
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug, $id)
    {
        $indikator = IndikatorMutu::find($id);

        if (!$indikator) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Verifikasi kecocokan slug dengan judul
        $slugFromData = Str::slug($indikator->judul);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug tidak sesuai dengan data',
                'data' => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $indikator
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $indikator = IndikatorMutu::find($id);

        if (!$indikator) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(IndikatorMutu::updateValidationRules());

        if ($request->hasFile('file_pdf')) {
            if ($indikator->file_pdf && Storage::disk('public')->exists($indikator->file_pdf)) {
                Storage::disk('public')->delete($indikator->file_pdf);
            }

            $file = $request->file('file_pdf');
            $filename = now()->format('Ymd_Hi') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/indikator_mutu', $filename, 'public');
            $validated['file_pdf'] = $path;
        }

        $indikator->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $indikator
        ], 200);
    }

    public function destroy($id)
    {
        $indikator = IndikatorMutu::find($id);

        if (!$indikator) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($indikator->file_pdf && Storage::disk('public')->exists($indikator->file_pdf)) {
            Storage::disk('public')->delete($indikator->file_pdf);
        }

        $indikator->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
