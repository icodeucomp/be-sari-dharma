<?php

namespace App\Http\Controllers;

use App\Models\CertificationAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificationAwardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = CertificationAward::query();
        if ($search) {
            $query->where('title', $this->like(), $this->likeTerm((string) $search));
        }
        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(CertificationAward::storeValidationRules());

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/certification_award', $filename, 'public');
            $validated['pdf_file'] = $path;
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/certification_award/photo', $filename, 'public');
            $validated['photo'] = $path;
        }

        $certification = CertificationAward::create($validated);

        return response()->json([
            'success' => true,
            'data' => $certification,
        ], 201);
    }

    public function show($slug, $id)
    {
        $certification = CertificationAward::find($id);

        if (! $certification) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($certification->title);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $certification,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $certification = CertificationAward::find($id);

        if (! $certification) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(CertificationAward::updateValidationRules());

        if ($request->hasFile('pdf_file')) {
            if ($certification->pdf_file && Storage::disk('public')->exists($certification->pdf_file)) {
                Storage::disk('public')->delete($certification->pdf_file);
            }

            $file = $request->file('pdf_file');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/certification_award', $filename, 'public');
            $validated['pdf_file'] = $path;
        }

        if ($request->hasFile('photo')) {
            if ($certification->photo && Storage::disk('public')->exists($certification->photo)) {
                Storage::disk('public')->delete($certification->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/certification_award/photo', $filename, 'public');
            $validated['photo'] = $path;
        }

        $certification->update($validated);

        return response()->json([
            'success' => true,
            'data' => $certification,
        ], 200);
    }

    public function destroy($id)
    {
        $certification = CertificationAward::find($id);

        if (! $certification) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($certification->pdf_file && Storage::disk('public')->exists($certification->pdf_file)) {
            Storage::disk('public')->delete($certification->pdf_file);
        }

        if ($certification->photo && Storage::disk('public')->exists($certification->photo)) {
            Storage::disk('public')->delete($certification->photo);
        }

        $certification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
