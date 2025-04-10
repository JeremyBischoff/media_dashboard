<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_title',
        'entry_title',
        'entry_author',
        'entry_url'
    ];
}
