<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'reservation_date',
        'return_date',
        'is_returned',
        'user_id',
        'book_id',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'return_date' => 'date',
    ];
    
    protected $dates = [
        'reservation_date',
        'return_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
