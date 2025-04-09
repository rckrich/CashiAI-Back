<?php

namespace App\Livewire;

use App\Exports\FirstInteractionsExport;
use App\Models\AiUser;
use App\Models\Analytic;
use App\Models\FirstInteraction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Interactions extends Component
{
    use WithPagination;

    public $start;
    public $end;
    public $interactions;
    public $analytic;

    public function render()
    {
        return view('livewire.interactions');
    }

    public function mount(){
        $this->start = Carbon::now()->subDay()->startOfDay();
        $this->end = Carbon::now()->endOfDay();
        $this->analytic = Analytic::find(1);
}


    public function search()
    {
        $this->interactions = FirstInteraction::whereBetween('interaction_date', [$this->start, $this->end])->get();
    }

    public function generateCsv()
    {
        $date = Carbon::now()->translatedFormat('jFY_H_i');
        return (new FirstInteractionsExport($this->start, $this->end))->download('first_interactions_'.$date.'.xlsx');
    }
}
