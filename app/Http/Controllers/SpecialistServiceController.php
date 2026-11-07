<?php

namespace App\Http\Controllers;

use App\Helpers\Cryptor;
use App\Models\DoctorSchedule;
use App\Models\SpecialistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpecialistServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $this->perPage($request);
        $page = $this->page($request);
        $query = SpecialistService::query();

        if ($search) {
            $query->where('name', $this->like(), $this->likeTerm((string) $search));
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(SpecialistService::storeValidationRules());

        $encryptedDoctorIds = $request->input('doctor_ids', []);
        if (isset($validated['doctor_ids'])) {
            unset($validated['doctor_ids']);
        }

        $cryptor = new Cryptor;
        $doctorIds = array_values(array_unique(array_filter(array_map(fn ($id) => $cryptor->decryptId($id), (array) $encryptedDoctorIds), fn ($id) => $id !== null)));

        DB::beginTransaction();
        try {
            $service = SpecialistService::create($validated);

            foreach ($doctorIds as $doctorId) {
                DoctorSchedule::create([
                    'doctor_id' => $doctorId,
                    'specialist_id' => $service->id,
                    'doctor_background' => '',
                    'schedule' => [
                        ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '16:00'],
                    ],
                    'education_career' => [
                        ['title' => 'Pendidikan', 'start_year' => date('Y'), 'end_year' => null],
                    ],
                ]);
            }

            $service->load(['doctorSchedules.doctor']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $service,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function show($slug, $id)
    {
        $service = SpecialistService::with('doctors')->find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $slugFromData = Str::slug($service->name);
        if ($slug !== $slugFromData) {
            return response()->json([
                'success' => false,
                'message' => 'Slug does not match the data',
                'data' => null,
            ], 400);
        }

        $serviceArray = $service->toArray();

        $cryptor = new Cryptor;
        if (isset($serviceArray['doctors']) && is_array($serviceArray['doctors'])) {
            foreach ($serviceArray['doctors'] as $key => $doctor) {
                $serviceArray['doctors'][$key]['id'] = $cryptor->encrypt($doctor['id']);

                if (isset($doctor['pivot'])) {
                    $serviceArray['doctors'][$key]['pivot']['doctor_id'] = $cryptor->encrypt($doctor['pivot']['doctor_id']);
                    $serviceArray['doctors'][$key]['pivot']['specialist_id'] = $cryptor->encrypt($doctor['pivot']['specialist_id']);
                }
            }
        }

        return response()->json([
            'success' => true,
            'data' => $serviceArray,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $service = SpecialistService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(SpecialistService::updateValidationRules());

        $encryptedDoctorIds = $request->input('doctor_ids', []);
        if (isset($validated['doctor_ids'])) {
            unset($validated['doctor_ids']);
        }

        $cryptor = new Cryptor;
        $doctorIds = array_values(array_unique(array_filter(array_map(fn ($id) => $cryptor->decryptId($id), (array) $encryptedDoctorIds), fn ($id) => $id !== null)));

        DB::beginTransaction();
        try {
            $service->update($validated);

            if ($request->has('doctor_ids') && ! empty($doctorIds)) {
                $existingDoctorIds = $service->doctorSchedules->pluck('doctor_id')->toArray();

                foreach ($doctorIds as $doctorId) {
                    if (! in_array($doctorId, $existingDoctorIds)) {
                        DoctorSchedule::create([
                            'doctor_id' => $doctorId,
                            'specialist_id' => $service->id,
                            'doctor_background' => '',
                            'schedule' => [
                                ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '16:00'],
                            ],
                            'education_career' => [
                                ['title' => 'Pendidikan', 'start_year' => date('Y'), 'end_year' => null],
                            ],
                        ]);
                    }
                }

                foreach ($existingDoctorIds as $existingId) {
                    if (! in_array($existingId, $doctorIds)) {
                        DoctorSchedule::where('specialist_id', $service->id)
                            ->where('doctor_id', $existingId)
                            ->delete();
                    }
                }
            } elseif ($request->has('doctor_ids')) {
                DoctorSchedule::where('specialist_id', $service->id)->delete();
            }

            $service->load(['doctorSchedules.doctor']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $service,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function destroy($id)
    {
        $service = SpecialistService::find($id);

        if (! $service) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        DB::beginTransaction();
        try {
            $service->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: '.$e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
