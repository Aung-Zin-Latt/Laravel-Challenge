<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Services\EmployeeManagement\Staff;

class StaffController extends Controller
{
    protected $staff;
    
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }
    
    public function payroll(): array
    {
        try {
            $data = $this->staff->salary();
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'error' => 'An error occurred while calculating the payroll'
            ], 500);
        }
    
        return [
            'data' => $data
        ];
    }
}
