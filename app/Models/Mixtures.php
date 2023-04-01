<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mixtures extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inci_name',
        'cas_number',
    ];

    
}
