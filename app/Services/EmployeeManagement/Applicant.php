<?php

namespace App\Services\EmployeeManagement;

class Applicant implements Employee
{
    private $experience;
    private $qualifications;

    public function __construct(int $experience, array $qualifications)
    {
        $this->experience = $experience;
        $this->qualifications = $qualifications;
    }

    public function applyJob(): bool
    {
        return true;
    }
    
    public function salary()
    {
        // TODO: Implement salary() method.

        // Basic salary of $2000
        $salary = 2000;
        
        // Add $100 for each year of experience
        $salary += $this->experience * 100;
        
        // Add $500 for each qualification
        $salary += count($this->qualifications) * 500;
        
        return $salary;
    }
}