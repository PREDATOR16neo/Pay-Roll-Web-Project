<?php

namespace App\Livewire\Admin;

use App\Models\Employee;
use App\Models\Payroll as ModelsPayroll;
use Livewire\Component;

class Payroll extends Component
{
    public $editCheck = false;
    public function render()
    {
        $employees = Employee::all();
        $payrolls = ModelsPayroll::all();
        return view('livewire.admin.payroll', compact('payrolls', 'employees'));
    }
}
