<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function ratings(): HasMany
    {
        return $this->hasMany(UserProduct::class);
    }

    public function getAverageRatingAttribute(): int|float|null
    {
        return $this->ratings()->avg('rating');
    }

    public function getRatingsCountAttribute(): int
    {
        return $this->ratings()->count();
    }
}
