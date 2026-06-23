<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UserSearch extends Component
{
    public $search = '';

    public function render()
    {
        // Query hanya untuk pengguna dengan role 0
        $users = User::where('role', 0)
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
            ->map(function ($user) {
                $user->umur = Carbon::parse($user->tanggal_lahir)->age;
                $user->nama_singkat = \Illuminate\Support\Str::limit($user->name, 6, '..');
                $user->alamat_singkat = \Illuminate\Support\Str::limit($user->alamat, 8, '..');
                return $user;
            });

        return view('livewire.user-search', compact('users'));
    }
}