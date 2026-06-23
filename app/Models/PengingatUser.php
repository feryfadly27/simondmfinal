<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengingatUser extends Model
{
    use HasFactory;

    protected $table = 'pengingat_user';

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tanggal',
        'dibaca',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
