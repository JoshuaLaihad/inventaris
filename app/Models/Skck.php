<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skck extends Model
{
    use HasFactory;
    
    protected $fillable = ['kesatuan_id', 'status_id', 'tanggal', 'no_box', 'no_reg', 'jumlah', 'keterangan'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kesatuan()
    {
        return $this->belongsTo(Kesatuan::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Scope untuk memfilter berdasarkan status
    public function scopeByStatus($query, $statusName)
    {
        return $query->whereHas('status', function ($query) use ($statusName) {
            $query->where('nama_status', $statusName);
        });
    }
    
}
