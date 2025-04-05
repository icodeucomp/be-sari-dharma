<?php

namespace App\Http\Controllers;

use App\Models\KontenSocialMedia;
use Illuminate\Http\Request;

class KontenSocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1); // baru
        $query = KontenSocialMedia::query();
        if ($search) {
            $query->where('type', 'like', '%' . $search . '%');
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
        $konten = KontenSocialMedia::create($validated);

        return response()->json([
            'success' => true,
            'data' => $konten
        ], 201);
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
        $konten = KontenSocialMedia::find($id);

        if (!$konten) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $validated = $request->validate(KontenSocialMedia::updateValidationRules());
        $konten->update($validated);

        return response()->json([
            'success' => true,
            'data' => $konten
        ], 200);
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
