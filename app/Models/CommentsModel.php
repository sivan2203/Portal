<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable = [
        'id',
        'article_id',
        'autor_id',
        'body',
        'created_at',
        'updated_at'
    ];
}
