<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    protected $fillable = ['name', 'age', 'latitude', 'longitude'];

    use HasFactory;
}
