<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'postId' => 'integer',
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'body' => 'string',
    ];

    protected $fillable = [
        'postId',
        'id',
        'name',
        'email',
        'body',
    ];
}
