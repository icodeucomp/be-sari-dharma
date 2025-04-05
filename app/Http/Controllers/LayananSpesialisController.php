<?php

namespace App\Http\Controllers;

use App\Models\LayananSpesialis;
use Illuminate\Http\Request;

class LayananSpesialisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = LayananSpesialis::query();
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
        $layanan = LayananSpesialis::create($validated);

        return response()->json([
            'success' => true,
            'data' => $layanan
        ], 201);
    }

    public function show($id)
    {
        $layanan = LayananSpesialis::find($id);

        if (!$layanan) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananSpesialis::find($id);

        if (!$layanan) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(LayananSpesialis::updateValidationRules());
        $layanan->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $layanan
        ], 200);
    }

    public function destroy($id)
    {
        $layanan = LayananSpesialis::find($id);

        if (!$layanan) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $layanan->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
