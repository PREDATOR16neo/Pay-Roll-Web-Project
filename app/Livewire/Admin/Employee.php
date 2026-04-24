<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Position;
use App\Models\Employee as ModelsEmployee;

class Employee extends Component
{

    public $user_id;
    public $position_id;
    public $salary;
    public $editCheck = false;
    public $idEdit;

    public function render()
    {
        $users = User::all();
        $positions = Position::all();
        $employees = ModelsEmployee::all();
        return view('livewire.admin.employee', compact('users', 'positions', 'employees'));
    }

    public function store()
    {
        $validate = $this->validate([
            'user_id' => 'required',
            'position_id' => 'required',
            'salary' => 'required'
        ]);

        ModelsEmployee::create($validate);
        session()->flash('message', 'berhasil menambah data');

        $this->clear();

    }

    public function destroy ($id)
    {
        $employee = ModelsEmployee::find($id);
        $employee->delete();
        session()->flash('message', 'berhasil menghapus data');
    }    

    public function edit ($id)
    {
        $employee = ModelsEmployee::find($id);
        $this->user_id = $employee->user_id;
        $this->position_id = $employee->position_id;
        $this->salary = $employee->salary;
        $this->editCheck = true;
        $this->idEdit = $employee->id;
    }  
    
    public function clear ()
    {
        $this->user_id = '';
        $this->position_id = '';
        $this->salary = '';
        $this->editCheck = false;
        $this->idEdit = '';
    }

    public function update ($id)
    {
        $validate = $this->validate([
            'user_id' => 'required',
            'position_id' => 'required',
            'salary' => 'required'
        ]);
        
        $employee = ModelsEmployee::find($id);
        $employee->update($validate);
        $this->clear();
        session()->flash('message', 'berhasil mengupdate data');

        }
}
