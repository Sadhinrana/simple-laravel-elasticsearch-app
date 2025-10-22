<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use JeroenG\Explorer\Domain\Syntax\Range;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products with optional filters
     */
    public function getAll(array $filters = []): Collection
    {
        $query = Product::query()->where('is_active', true);

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['brand'])) {
            $query->where('brand', $filters['brand']);
        }

        if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
            if (!empty($filters['min_price'])) {
                $query->where('price', '>=', $filters['min_price']);
            }
            if (!empty($filters['max_price'])) {
                $query->where('price', '<=', $filters['max_price']);
            }
        }

        return $query->latest()->get();
    }

    /**
     * Search products using Scout
     */
    public function search(string $query, array $filters = []): Collection
    {
        $isFiltering = (bool) ($filters['category'] || $filters['brand'] || $filters['min_price'] || $filters['max_price']);

        if ($query !== '' || $isFiltering) {
            $builder = Product::search($query);

            if ($filters['category']) {
                $builder->where('category', $filters['category']);
            }
            if ($filters['brand']) {
                $builder->where('brand', $filters['brand']);
            }
            if ($filters['min_price'] || $filters['max_price']) {
                $range = [];
                if ($filters['min_price']) $range['gte'] = $filters['min_price'];
                if ($filters['max_price']) $range['lte'] = $filters['max_price'];
                $builder->filter(new Range('price', $range));
            }
            $products = $builder->take(100)->get();
        } else {
            $products = Product::query()->where('is_active', true)->latest()->take(100)->get();
        }

        return $products;
    }

    /**
     * Get product by ID
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Create a new product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update a product
     */
    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    /**
     * Delete a product
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    /**
     * Get all categories
     */
    public function getCategories(): \Illuminate\Support\Collection
    {
        return Product::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->filter()
            ->values();
    }

    /**
     * Get all brands
     */
    public function getBrands(): \Illuminate\Support\Collection
    {
        return Product::query()
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand')
            ->filter()
            ->values();
    }

    /**
     * Get products with pagination
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Product::query()
            ->where('is_active', true)
            ->latest()
            ->paginate($perPage);
    }
}

