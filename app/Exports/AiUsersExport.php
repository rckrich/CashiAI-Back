<?php

namespace App\Exports;

use App\Models\AiUser;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AiUsersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function query()
    {
        return AiUser::query()->whereBetween('interaction_date', [$this->start, $this->end]);
    }

    public function headings() : array
    {
        return array([
                'Nombre',
                'Correo electrónico',
                'Edad',
                'Fecha de interacción'
        ]);
    }

    public function map($row) : array
    {
        return [
            $row->name,
            $row->email,
            $row->age,
            $row->interaction_date
        ];
    }


}
