<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLogin extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password, 'usertype' => 'user'];

        if (Auth::attempt($credentials)) {
            return redirect()->route('welcome');
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.user-login')->layout('layouts.app');
    }
}