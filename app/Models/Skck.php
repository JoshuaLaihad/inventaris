<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skck extends Model
{
    use HasFactory;
    
    protected $fillable = ['kesatuan', 'status', 'tanggal', 'no_box', 'no_reg', 'jumlah', 'keterangan'];

    const STATUS_INPUT = 'input';
    const STATUS_OUTPUT = 'output';
    const STATUS_RUSAK = 'rusak';

    protected $casts = [
        'tanggal' => 'date',
    ];

    public static function getStatuses()
    {
        return [
            self::STATUS_INPUT,
            self::STATUS_OUTPUT,
            self::STATUS_RUSAK,
        ];
    }

    // Scope untuk memfilter berdasarkan status
    // public function scopeByStatus($query, $statusName)
    // {
    //     return $query->whereHas('status', function ($query) use ($statusName) {
    //         $query->where('nama_status', $statusName);
    //     });
    // }
    
}
