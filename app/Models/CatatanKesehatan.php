<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CatatanKesehatan extends Model
{
    protected $table = 'catatan_kesehatan';

    protected $fillable = [
        'user_id',
        'umur',
        'tinggi',
        'berat',
        'sistolik',
        'diastolik',
        'gula',
        'kategori',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
