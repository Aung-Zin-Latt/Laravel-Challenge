<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\EmployeeManagement\Applicant;

class JobController extends Controller
{
    protected $applicant;

    public function apply(Request $request)
    {
        try {
            $experience = (int) $request->input('experience');
            $qualifications = $request->input('qualifications');

            if (!is_array($qualifications)) {
                throw new \InvalidArgumentException('Invalid qualifications value provided');
            }

            $this->applicant = new Applicant($experience, $qualifications);
            $salary = $this->applicant->salary();

            return response()->json(['salary' => $salary]);

        } catch (\InvalidArgumentException $e) {
            Log::error($e);
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Throwable $e) {
            Log::error($e);
            return response()->json(['error' => 'An error occurred while processing the request'], 500);
        }        
    }
}
