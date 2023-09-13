<?php

namespace App\Exports;

use App\Models\Derman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DermanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Derman::select(["name", "price", "country", "company", "created_at"])->get();
    }

    public function headings(): array
    {
        return ["Adı", "Qiymət", "Ölkə", "Şirkət", "Data Tarix"];
    }
}
