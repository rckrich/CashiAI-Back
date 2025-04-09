<?php

namespace App\Exports;

use App\Models\FirstInteraction;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FirstInteractionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function query()
    {
        return FirstInteraction::query()->whereBetween('interaction_date', [$this->start, $this->end]);
    }

    public function headings() : array
    {
        return array([
                'Fecha de interacción'
        ]);
    }

    public function map($row) : array
    {
        return [
            $row->interaction_date
        ];
    }


}
