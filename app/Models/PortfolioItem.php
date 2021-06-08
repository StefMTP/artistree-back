<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type',
        'file_url',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
