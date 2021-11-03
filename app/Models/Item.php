<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'details', 'foto', 'isDone']; 
    protected $attributes = [
        'isDone' => false,
        'foto' => '',
        'details' => 'Add a more detailed description'
    ];
}
