<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialMediaContentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');
        $perPage = $this->perPage($request);
        $page = $this->page($request);

        $query = SocialMediaContent::query();

        if ($search) {
            $query->where('type', $this->like(), $this->likeTerm((string) $search));
        }

        if ($type) {
            $query->where('type', $type);
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(SocialMediaContent::storeValidationRules());

        $existingContent = SocialMediaContent::where('type', $validated['type'])->first();

        DB::beginTransaction();
        try {
            if ($existingContent) {
                $existingContent->update($validated);
                $content = $existingContent;
                $message = 'Data updated successfully';
                $statusCode = 200;
            } else {
                $content = SocialMediaContent::create($validated);
                $message = 'Data created successfully';
                $statusCode = 201;
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $content,
            ], $statusCode);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show($id)
    {
        $content = SocialMediaContent::find($id);

        if (! $content) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $content,
        ], 200);
    }

    public function update(Request $request, string $type)
    {
        $validated = $request->merge(['type' => $type])->validate(SocialMediaContent::updateValidationRules());

        DB::beginTransaction();
        try {
            SocialMediaContent::whereType($type)->delete();

            $contents = [];
            foreach ($validated['links'] as $link) {
                $contents[] = SocialMediaContent::create(['type' => $type, 'links' => $link]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
                'data' => $contents,
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        $content = SocialMediaContent::find($id);

        if (! $content) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $content->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
