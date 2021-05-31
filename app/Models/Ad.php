<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    public function user_uploaded() {
        return $this->belongsTo(User::class, 'uploader', 'id');
    }

    public function user_responded() {
        return $this->belongsToMany(User::class, 'ad_responses', 'ad_id', 'responder');
    }
}
