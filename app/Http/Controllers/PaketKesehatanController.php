<?php

namespace App\Http\Controllers;

use App\Models\PaketKesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = PaketKesehatan::query();
        if ($search) {
            $query->where('nama_paket', 'like', '%' . $search . '%');
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'success' => true, // HTTP 200 OK
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

    public function show($id)
    {
        $paket = PaketKesehatan::find($id);

        if (!$paket) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
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
