<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'published_year',
        'copies_available',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}