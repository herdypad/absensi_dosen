<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable =[
        'user_id',
        'status',
        'tgl_presensi',
        'jam_masuk',
        'jam_pulang',
        'lokasi_masuk',
        'lokasi_pulang',
        'foto_masuk',
        'foto_pulang',
        'ket',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
