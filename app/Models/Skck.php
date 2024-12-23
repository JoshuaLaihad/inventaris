<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skck extends Model
{
    use HasFactory;
    
    protected $fillable = ['kesatuan_id', 'status', 'tanggal', 'no_box', 'no_reg', 'jumlah', 'keterangan'];

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

    public function kesatuan()
    {
        return $this->belongsTo(User::class, 'kesatuan_id');
    }

    // Fungsi untuk mengambil daftar kesatuan dari tabel users
    public static function getKesatuans()
    {
        return User::pluck('kesatuan', 'id'); // Ambil kesatuan dan id
    }
}
