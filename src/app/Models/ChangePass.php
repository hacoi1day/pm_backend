<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangePass extends Model
{
    use HasFactory;

    protected $table = 'change_passes';

    protected $fillable = [
        'user_id',
        'token',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
