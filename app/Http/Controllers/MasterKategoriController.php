<?php

namespace App\Http\Controllers;

use App\Models\MasterKategori;
use Illuminate\Http\Request;

class MasterKategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $flag = $request->query('flag');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = MasterKategori::query();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        if ($flag) {
            $query->where('flag', $flag);
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
        $validated = $request->validate(MasterKategori::storeValidationRules());
        $kategori = MasterKategori::create($validated);

        return response()->json([
            'success' => true,
            'data' => $kategori,
        ], 201);
    }

    public function show($id)
    {
        $kategori = MasterKategori::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $kategori,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $kategori = MasterKategori::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(MasterKategori::updateValidationRules());
        $kategori->update($validated);

        return response()->json([
            'success' => true,
            'success' => true,
            'data' => $kategori,
        ], 200);
    }

    public function destroy($id)
    {
        $kategori = MasterKategori::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'success' => true,
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
