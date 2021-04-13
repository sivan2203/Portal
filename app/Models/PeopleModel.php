<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleModel extends Model
{
    use HasFactory;
    protected $table='people';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'created_at',
        'updated_at'
    ];
}
