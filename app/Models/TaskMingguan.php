<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TaskMingguan extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'task_mingguan',
        'status',
        'waktu_mulai',
        'waktu_selesai',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pegawai(){

        return $this->belongsToMany(Pegawai::class);

    }
}
