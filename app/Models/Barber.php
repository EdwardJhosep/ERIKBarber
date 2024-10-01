<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    // Especifica los campos que se pueden llenar
    protected $fillable = [
        'name',
        'specialty',
        'photo',
    ];
}
