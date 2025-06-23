<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = ['judul', 'isi', 'likes', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
