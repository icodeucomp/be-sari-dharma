<?php

namespace App\Http\Controllers;

use App\Helpers\Cryptor;
use App\Models\Doctor;
use App\Models\HealthArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HealthArticleController extends Controller
{
    protected $cryptor;

    public function __construct()
    {
        $this->cryptor = new Cryptor;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $relatedDoctors = $request->query('related_doctors');
        $perPage = $this->perPage($request);
        $page = $this->page($request);

        $query = HealthArticle::with(['category']);

        if ($search) {
            $query->where('title', $this->like(), $this->likeTerm((string) $search));
        }

        if ($categoryId) {
            $query->where('category_id', $this->cryptor->decryptId($categoryId) ?? 0);
        }

        if ($relatedDoctors) {
            $doctorIds = array_values(array_filter(
                array_map(fn ($id) => $this->cryptor->decryptId($id), (array) $relatedDoctors),
                fn ($id) => $id !== null
            ));

            $query->where(function ($q) use ($doctorIds) {
                if (empty($doctorIds)) {
                    $q->whereRaw('1 = 0');

                    return;
                }
                foreach ($doctorIds as $doctorId) {
                    $q->orWhereJsonContains('related_doctors', $doctorId)
                        ->orWhereJsonContains('related_doctors', (string) $doctorId);
                }
            });
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(HealthArticle::storeValidationRules());

        if (array_key_exists('related_doctors', $validated)) {
            $validated['related_doctors'] = array_values(array_filter(
                array_map(fn ($id) => $this->cryptor->decryptId($id), (array) $validated['related_doctors']),
                fn ($id) => $id !== null
            ));
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/health_article', $filename, 'public');
            $validated['photo'] = $path;
        }

        $article = HealthArticle::create($validated);

        return response()->json([
            'success' => true,
            'data' => $article,
        ], 201);
    }

    public function show($slug, $id)
    {
        $article = HealthArticle::with('category')->find($id);

        if (! $article) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($article->title);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        $relatedDoctors = [];

        foreach ($article->related_doctors ?? [] as $doctorId) {
            $doctor = Doctor::find($doctorId);
            if ($doctor) {
                $relatedDoctors[] = $doctor;
            }
        }

        $article->related_doctors = $relatedDoctors;

        return response()->json([
            'success' => true,
            'data' => $article,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $article = HealthArticle::find($id);

        if (! $article) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(HealthArticle::updateValidationRules());

        if (array_key_exists('related_doctors', $validated)) {
            $validated['related_doctors'] = array_values(array_filter(
                array_map(fn ($id) => $this->cryptor->decryptId($id), (array) $validated['related_doctors']),
                fn ($id) => $id !== null
            ));
        }

        if ($request->hasFile('photo')) {
            if ($article->photo && Storage::disk('public')->exists($article->photo)) {
                Storage::disk('public')->delete($article->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/health_article', $filename, 'public');
            $validated['photo'] = $path;
        }

        $article->update($validated);

        return response()->json([
            'success' => true,
            'data' => $article,
        ], 200);
    }

    public function destroy($id)
    {
        $article = HealthArticle::find($id);

        if (! $article) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($article->photo && Storage::disk('public')->exists($article->photo)) {
            Storage::disk('public')->delete($article->photo);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
