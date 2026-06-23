<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrolAktivitas extends Model
{
    protected $fillable = [
        'user_id', 'jenis_olahraga', 'waktu_mulai', 'waktu_selesai', 'tanggal', 'kalori_dibakar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
