<?php

namespace App\Http\Controllers;

use App\Models\QualityIndicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QualityIndicatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = QualityIndicator::query();
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
        $validated = $request->validate(QualityIndicator::storeValidationRules());

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/quality_indicator', $filename, 'public');
            $validated['pdf_file'] = $path;
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/quality_indicator/photo', $filename, 'public');
            $validated['photo'] = $path;
        }

        $indicator = QualityIndicator::create($validated);

        return response()->json([
            'success' => true,
            'data' => $indicator,
        ], 201);
    }

    public function show($slug, $id)
    {
        $indicator = QualityIndicator::find($id);

        if (! $indicator) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($indicator->title);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $indicator,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $indicator = QualityIndicator::find($id);

        if (! $indicator) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(QualityIndicator::updateValidationRules());

        if ($request->hasFile('pdf_file')) {
            if ($indicator->pdf_file && Storage::disk('public')->exists($indicator->pdf_file)) {
                Storage::disk('public')->delete($indicator->pdf_file);
            }

            $file = $request->file('pdf_file');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/quality_indicator', $filename, 'public');
            $validated['pdf_file'] = $path;
        }

        if ($request->hasFile('photo')) {
            if ($indicator->photo && Storage::disk('public')->exists($indicator->photo)) {
                Storage::disk('public')->delete($indicator->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/quality_indicator/photo', $filename, 'public');
            $validated['photo'] = $path;
        }

        $indicator->update($validated);

        return response()->json([
            'success' => true,
            'data' => $indicator,
        ], 200);
    }

    public function destroy($id)
    {
        $indicator = QualityIndicator::find($id);

        if (! $indicator) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($indicator->pdf_file && Storage::disk('public')->exists($indicator->pdf_file)) {
            Storage::disk('public')->delete($indicator->pdf_file);
        }

        if ($indicator->photo && Storage::disk('public')->exists($indicator->photo)) {
            Storage::disk('public')->delete($indicator->photo);
        }

        $indicator->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
