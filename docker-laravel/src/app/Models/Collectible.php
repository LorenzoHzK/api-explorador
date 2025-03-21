<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collectible extends Model
{
    protected $fillable = ['name', 'value', 'latitude', 'longitude', 'explorer_id'];

    use HasFactory;
}
