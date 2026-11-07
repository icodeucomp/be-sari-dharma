<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $flag = $request->query('flag');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = Category::query();
        if ($search) {
            $query->where('name', $this->like(), $this->likeTerm((string) $search));
        }
        if ($flag) {
            $query->where('flag', $flag);
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Category::storeValidationRules());
        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(Category::updateValidationRules());
        $category->update($validated);

        return response()->json([
            'success' => true,
            'data' => $category,
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
