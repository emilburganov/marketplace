<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'carts', 'product_id', 'id');
    }

}
