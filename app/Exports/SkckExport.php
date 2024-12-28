<?php

namespace App\Exports;

use App\Models\Skck;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SkckExport implements FromCollection, WithHeadings, WithStyles
{
    protected $query;
    protected $sisaStok;

    public function __construct($query, $sisaStok)
    {
        $this->query = $query;
        $this->sisaStok = $sisaStok;
    }

    /**
     * Mengambil data untuk diekspor
     */
    public function collection()
    {
        // Data utama dari query
        $data = $this->query->select('kesatuan_id', 'status', 'tanggal', 'no_box', 'no_reg', 'jumlah', 'keterangan')->get();

        // Tambahkan sisa stok sebagai baris terakhir
        $data->push([
            'kesatuan_id' => null,
            'status' => 'Sisa Stok',
            'tanggal' => null,
            'no_box' => null,
            'no_reg' => null,
            'jumlah' => $this->sisaStok,
            'keterangan' => null,
        ]);

        return $data;
    }

    /**
     * Membuat header untuk file Excel
     */
    public function headings(): array
    {
        return [
            'Kesatuan',
            'Status',
            'Tanggal',
            'No Box',
            'No Reg',
            'Jumlah',
            'Keterangan',
        ];
    }

    /**
     * Menambahkan gaya untuk tabel
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow(); // Mengambil baris terakhir

        // Gaya untuk header
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'D9E1F2'], // Warna biru muda
            ],
            'alignment' => ['horizontal' => 'center'],
        ]);

        // Gaya untuk seluruh tabel (border)
        $sheet->getStyle('A1:G' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Format kolom "Jumlah" sebagai angka
        $sheet->getStyle('F2:F' . $lastRow)->getNumberFormat()
            ->setFormatCode('#,##0');

        return $sheet;
    }
}

