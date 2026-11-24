<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'old_price',
        'stock',
        'image',
        'description',
        'tags',
        'featured'
    ];
    // protected $guarded = [];

    #[Override]
    protected function casts(): array
    {
        return [
            'price'     => 'integer',
            'old_price' => 'integer',
            'stock'     => 'integer',
            'tags'      => 'array',
            'featured'  => 'boolean'
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
