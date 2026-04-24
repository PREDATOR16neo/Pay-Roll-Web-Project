<?php

namespace App\Livewire\Admin;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $name;
    public $email;
    public $password;
    public $editCheck = false;
    public $idEdit;
    public $keyword;
    public function render()
    {
        $users = ModelsUser::all();
        $users = ModelsUser::where('name', 'like', "%{$this->keyword}%")->get();
        return view('livewire.admin.user', compact('users'));
    }

    public function store()
    {
        $validated = $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            ModelsUser::create($validated);
            session()->flash('message', 'User berhasil di tambahkan');
    }

    public function destroy($id)
    {
        $user = ModelsUser::find($id);
        $user->delete();
        session()->flash('message', 'User berhasil di hapus');
    }

    public function edit($id)
    {
        $user = ModelsUser::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->idEdit = $user->id;
        $this->editCheck = true;
    }

    public function update ($id)
    {
        $validate = $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            $user = ModelsUser::find($id);
            $user->update($validate);
            session()->flash('message', 'User berhasil di update');
            $this->clear();
    }

    public function clear()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->idEdit = '';
        $this->editCheck = false;
    }   
}
