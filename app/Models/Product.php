<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use JeroenG\Explorer\Application\Explored;

class Product extends Model implements Explored
{
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'brand',
        'stock_quantity',
        'image_url',
        'specifications',
        'is_active'
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function mappableAs(): array
    {
        return [
            'id' => 'keyword',
            'name' => 'text',
            'description' => 'text',
            'price' => 'float',
            'category' => 'keyword',
            'brand' => 'keyword',
            'stock_quantity' => 'integer',
            'image_url' => 'text',
            'specifications' => 'object',
            'is_active' => 'boolean',
            'created_at' => 'date',
        ];
    }
}
