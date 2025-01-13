<?php

namespace App\Livewire;

use App\Exports\AiUsersExport;
use App\Models\AiUser;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Interactions extends Component
{
    use WithPagination;

    public $start;
    public $end;

    public function render()
    {
        $this->start = Carbon::now()->subDay()->startOfDay();
        $this->end = Carbon::now()->endOfDay();
        $users = AiUser::whereBetween('interaction_date', [$this->start, $this->end])->paginate(20);
        return view('livewire.interactions', [
            'users' => $users
        ]);
    }

    public function search()
    {
        $users = AiUser::whereBetween('interaction_date', [$this->start, $this->end])->paginate(20);
        return view('livewire.interactions', [
            'users' => $users
        ]);
    }

    public function generateCsv()
    {
        return (new AiUsersExport($this->start, $this->end))->download('interactions.xlsx');
    }
}
