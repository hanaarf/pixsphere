<?php

namespace App\Exports;

use App\Models\Album;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlbumsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Album::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Album Name',
            'Description',
            'user id',
            'Created At',
        ];
    }
}