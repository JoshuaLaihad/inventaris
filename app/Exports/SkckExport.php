<?php

namespace App\Exports;

use App\Models\Skck;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SkckExport implements FromCollection, WithHeadings
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Mengambil data untuk diekspor
     */
    public function collection()
    {
        return $this->query->select('kesatuan_id', 'status', 'tanggal', 'no_box', 'no_reg', 'jumlah', 'keterangan')->get();
    }

    /**
     * Membuat header untuk file Excel
     */
    public function headings(): array
    {
        return [
            'Kesatuan_id',
            'Status',
            'Tanggal',
            'No Box',
            'No Reg',
            'Jumlah',
            'Keterangan',
        ];
    }
}
