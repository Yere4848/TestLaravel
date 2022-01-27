<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\RoutingModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoutingImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new RoutingModel([
            'routingID' => $row[0],
            'proses1' => $row[1], 
            'proses2' => $row[2], 
        ]);
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
    public function startRow(): int
    {
        return 2;
    }
}