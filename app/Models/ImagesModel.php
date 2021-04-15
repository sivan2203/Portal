<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesModel extends Model
{
    use HasFactory;
    protected $table='images';
    protected $fillable = [
        'id',
        'article_id',
        'image',
        'created_at',
        'updated_up'
    ];
}
