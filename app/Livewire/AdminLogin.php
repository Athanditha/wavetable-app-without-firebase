<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = ['email' => $this->email, 'password' => $this->password, 'usertype' => 'admin'];

        if (Auth::attempt($credentials)) {
            // Create a new token for the admin
            $token = Auth::user()->createToken('admin-token')->plainTextToken;
            
            // Store token in session
            session(['token' => $token]);
            
            // Dispatch browser event with token
            $this->dispatch('auth-success', token: $token);
            
            return redirect()->route('admin.dashboard');
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.admin-login')->layout('layouts.app');
    }
}