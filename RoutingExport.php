<?php

namespace App\Exports;

use App\Models\RoutingModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoutingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return RoutingModel::all();
    }

    public function headings(): array
    {
        return ["Routing ID", "Proses 1", "Proses 2", "CreatedAt", "UpdateAt"];
    }
}
