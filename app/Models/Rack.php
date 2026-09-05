<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rack extends Model
{
    /** @use HasFactory<RackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%");
    }
}
