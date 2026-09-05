<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRecord extends Model
{
    /** @use HasFactory<ReturnRecordFactory> */
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = [
        'borrowing_id',
        'return_date',
        'condition',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'return_date' => 'date',
        ];
    }

    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('borrowing', function ($q) use ($search) {
            $q->whereHas('member', function ($q2) use ($search) {
                $q2->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q2) use ($search) {
                $q2->where('title', 'like', "%{$search}%");
            });
        })->orWhere('condition', 'like', "%{$search}%");
    }
}
