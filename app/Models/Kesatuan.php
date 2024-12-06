<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesatuan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kesatuan'];

    public function skcks()
    {
        return $this->hasMany(Skck::class);
    }
}
