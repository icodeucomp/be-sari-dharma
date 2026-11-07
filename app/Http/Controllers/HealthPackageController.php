<?php

namespace App\Http\Controllers;

use App\Helpers\Cryptor;
use App\Models\HealthPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HealthPackageController extends Controller
{
    public function index(Request $request)
    {
        $cryptor = new Cryptor;
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $promo = $request->query('promo');
        $validStart = $request->query('valid_start');
        $validEnd = $request->query('valid_end');
        $perPage = $this->perPage($request);
        $page = $this->page($request);

        $query = HealthPackage::query();

        if ($search) {
            $query->where('name', $this->like(), $this->likeTerm((string) $search));
        }

        if ($categoryId) {
            $query->where('category_id', $cryptor->decryptId($categoryId) ?? 0);
        }

        if ($promo !== null && ($promo == '0' || $promo == '1')) {
            $query->where('promo', $promo);
        }

        if ($validStart) {
            $query->whereDate('valid_until', '>=', $validStart);
        }

        if ($validEnd) {
            $query->whereDate('valid_until', '<=', $validEnd);
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(HealthPackage::storeValidationRules());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/health_package', $filename, 'public');
            $validated['photo'] = $path;
        }

        $pkg = HealthPackage::create($validated);

        return response()->json([
            'success' => true,
            'data' => $pkg,
        ], 201);
    }

    public function show($slug, $id)
    {
        $pkg = HealthPackage::with('category')->find($id);

        if (! $pkg) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($pkg->name);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $pkg,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pkg = HealthPackage::find($id);

        if (! $pkg) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(HealthPackage::updateValidationRules());

        if ($request->hasFile('photo')) {
            if ($pkg->photo && Storage::disk('public')->exists($pkg->photo)) {
                Storage::disk('public')->delete($pkg->photo);
            }

            $file = $request->file('photo');
            $filename = now()->format('Ymd_His').'_'.Str::lower(Str::random(6)).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/health_package', $filename, 'public');
            $validated['photo'] = $path;
        }

        $pkg->update($validated);

        return response()->json([
            'success' => true,
            'data' => $pkg,
        ], 200);
    }

    public function destroy($id)
    {
        $pkg = HealthPackage::find($id);

        if (! $pkg) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        if ($pkg->photo && Storage::disk('public')->exists($pkg->photo)) {
            Storage::disk('public')->delete($pkg->photo);
        }

        $pkg->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ], 200);
    }
}
