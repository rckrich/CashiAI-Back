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
    public $users;

    public function render()
    {
        return view('livewire.interactions');
    }

    public function mount(){
        $this->start = Carbon::now()->subDay()->startOfDay();
        $this->end = Carbon::now()->endOfDay();

}


    public function search()
    {
        $this->users = AiUser::whereBetween('interaction_date', [$this->start, $this->end])->get();
    }

    public function generateCsv()
    {
        return (new AiUsersExport($this->start, $this->end))->download('interactions.xlsx');
    }
}
