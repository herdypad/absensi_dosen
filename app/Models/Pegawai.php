<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function task()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
