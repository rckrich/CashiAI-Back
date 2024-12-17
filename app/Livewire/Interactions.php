<?php

namespace App\Livewire;

use App\Models\AiUser;
use Livewire\Component;
use Livewire\WithPagination;

class Interactions extends Component
{
    use WithPagination;

    public function render()
    {
        $users = AiUser::paginate(20);
        return view('livewire.interactions', [
            'users' => $users
        ]);
    }
}
