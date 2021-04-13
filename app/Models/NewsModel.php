<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;
    protected $table='articles';
    protected $fillable = [
        'id',
        'autor_id',
        'title',
        'content',
        'created_at',
        'updated_up'
    ];
}
