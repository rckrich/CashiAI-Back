<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Admins extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::paginate(20);
        return view('livewire.admins', [
            'users' => $users
        ]);
    }
}
