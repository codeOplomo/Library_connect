<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
    'title', 'author', 'type', 'description', 'image', 'publication_year', 'available_copies', 'total_copies',
];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

