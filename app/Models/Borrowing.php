<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'fine_amount',
    ];

    protected $dates = [
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Automatically compute fine
    public function calculateFine()
    {
        if (!$this->returned_at || $this->returned_at <= $this->due_date) {
            return 0;
        }

        $daysLate = Carbon::parse($this->due_date)
            ->diffInDays(Carbon::parse($this->returned_at));

        return $daysLate * 10; // ₱10 per day late
    }
}