<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get all products with optional filters
     */
    public function getAll(array $filters = []): Collection;

    /**
     * Search products using Scout
     */
    public function search(string $query, array $filters = []): Collection;

    /**
     * Get product by ID
     */
    public function findById(int $id): ?Product;

    /**
     * Create a new product
     */
    public function create(array $data): Product;

    /**
     * Update a product
     */
    public function update(Product $product, array $data): bool;

    /**
     * Delete a product
     */
    public function delete(Product $product): bool;

    /**
     * Get all categories
     */
    public function getCategories(): \Illuminate\Support\Collection;

    /**
     * Get all brands
     */
    public function getBrands(): \Illuminate\Support\Collection;

    /**
     * Get products with pagination
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
}

