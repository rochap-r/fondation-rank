<?php

namespace App\Livewire\Admin\Ui\Users;

use App\Models\User;
use Livewire\Component;

class ProfileInfos extends Component
{

    public $user;
    public $name,$sname,$lname,$email,$phone,$gender,$description;
    public function mount(){
        $this->user=User::find(auth()->id());
        $this->name=$this->user->name;
        $this->sname=$this->user->sname;
        $this->lname=$this->user->lname;
        $this->email=$this->user->email;
        $this->phone=$this->user->phone;
        $this->gender=$this->user->gender;
        $this->description=$this->user->description;
    }

    public function UpdateInfos(){
        $this->validate([
            'name'=>'required|string',
            'sname'=>'required|string',
            'lname'=>'required|string',
            'phone'=>'required|string',
            'description'=>'required|string',
            'email'=>'required|unique:users,email,'.auth()->id()
        ]);
        User::Where('id',auth()->id())->update([
            'name'=>$this->name,
            'sname'=>$this->sname,
            'lname'=>$this->lname,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'gender'=>$this->gender,
            'description'=>$this->description,
        ]);

        //listener
        $this->dispatch('UpdateHeader');
        $this->dispatch('UpdateProfile');

        //toastr
        $this->showToastr('Vos Informations personnelles ont été mises à jour avec succès.','success');
    }
    public function showToastr($message,$type){
        return $this->dispatch('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function render()
    {
        return view('livewire.admin.ui.users.profile-infos');
    }
}
