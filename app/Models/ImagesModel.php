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
        'created_at',
        'updated_up',
        'image'
    ];
}
