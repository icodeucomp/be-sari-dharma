<?php

namespace App\Http\Controllers;

use App\Helpers\Cryptor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorScheduleController extends Controller
{
    protected $cryptor;

    public function __construct()
    {
        $this->cryptor = new Cryptor;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $doctorId = $request->query('doctor_id');
        $specialistId = $request->query('specialist_id');
        $day = $request->query('day');
        $perPage = $this->perPage($request);
        $page = $this->page($request);

        $query = DoctorSchedule::with(['doctor', 'specialist']);

        if ($search) {
            $query->whereHas('doctor', function ($q) use ($search) {
                $q->where('name', $this->like(), $this->likeTerm((string) $search));
            });
        }

        if ($doctorId) {
            $decryptedDoctorId = $this->cryptor->decryptId($doctorId) ?? 0;
            $query->where('doctor_id', $decryptedDoctorId);
        }

        if ($specialistId) {
            $decryptedSpecialistId = $this->cryptor->decryptId($specialistId) ?? 0;
            $query->where('specialist_id', $decryptedSpecialistId);
        }

        if ($day) {
            $query->where(function ($q) use ($day) {
                $q->whereJsonContains('schedule', [['day' => (string) $day]]);
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
        $validated = $request->validate(DoctorSchedule::storeValidationRules());

        $relationErrors = DoctorSchedule::validateRelations($validated);

        if (! empty($relationErrors)) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $relationErrors,
                'data' => null,
            ], 422);
        }

        if (isset($validated['schedule']) && is_string($validated['schedule'])) {
            $validated['schedule'] = json_decode($validated['schedule'], true);

            if (! is_array($validated['schedule'])) {
                $validated['schedule'] = [
                    ['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '16:00'],
                ];
            }
        }

        if (isset($validated['education_career']) && is_string($validated['education_career'])) {
            $validated['education_career'] = json_decode($validated['education_career'], true);

            if (! is_array($validated['education_career'])) {
                $validated['education_career'] = [
                    ['title' => 'Pendidikan', 'start_year' => date('Y'), 'end_year' => null],
                ];
            }
        }

        $exists = DoctorSchedule::where('doctor_id', $validated['doctor_id'])
            ->where('specialist_id', $validated['specialist_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'A schedule for this doctor and specialist already exists',
                'data' => null,
            ], 422);
        }

        DB::beginTransaction();
        try {
            $schedule = DoctorSchedule::create($validated);

            $schedule->load(['doctor', 'specialist']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $schedule,
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

    public function show($id)
    {
        $schedule = DoctorSchedule::with(['doctor', 'specialist'])->find($id);

        if (! $schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $schedule,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $schedule = DoctorSchedule::find($id);

        if (! $schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        $validated = $request->validate(DoctorSchedule::updateValidationRules());

        $relationErrors = DoctorSchedule::validateRelations($validated);

        if (! empty($relationErrors)) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $relationErrors,
                'data' => null,
            ], 422);
        }

        if (isset($validated['schedule']) && is_string($validated['schedule'])) {
            $validated['schedule'] = json_decode($validated['schedule'], true);

            if (! is_array($validated['schedule'])) {
                $validated['schedule'] = $schedule->schedule;
            }
        }

        if (isset($validated['education_career']) && is_string($validated['education_career'])) {
            $validated['education_career'] = json_decode($validated['education_career'], true);

            if (! is_array($validated['education_career'])) {
                $validated['education_career'] = $schedule->education_career;
            }
        }

        if (($request->has('doctor_id') && $schedule->doctor_id != $validated['doctor_id']) ||
            ($request->has('specialist_id') && $schedule->specialist_id != $validated['specialist_id'])
        ) {

            $exists = DoctorSchedule::where('doctor_id', $validated['doctor_id'])
                ->where('specialist_id', $validated['specialist_id'])
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'A schedule for this doctor and specialist already exists',
                    'data' => null,
                ], 422);
            }
        }

        DB::beginTransaction();
        try {
            $schedule->update($validated);

            $schedule->load(['doctor', 'specialist']);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $schedule,
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
        $schedule = DoctorSchedule::find($id);

        if (! $schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            ], 404);
        }

        DB::beginTransaction();
        try {
            $schedule->delete();

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
