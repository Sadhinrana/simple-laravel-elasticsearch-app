<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    /**
     * Get products with search and filters
     */
    public function getProducts(Request $request): array
    {
        $query = $request->get('search', '') ?? '';
        $filters = array_merge([
            'category' => '',
            'brand' => '',
            'min_price' => '',
            'max_price' => ''
        ], $request->only(['category', 'brand', 'min_price', 'max_price']));

        $products = $this->productRepository->search($query, $filters);
        $categories = $this->productRepository->getCategories();
        $brands = $this->productRepository->getBrands();

        return [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'query' => $query,
            'filters' => $filters
        ];
    }

    /**
     * Create a new product
     */
    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    /**
     * Update a product
     */
    public function updateProduct(Product $product, array $data): bool
    {
        return $this->productRepository->update($product, $data);
    }

    /**
     * Delete a product
     */
    public function deleteProduct(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }

    /**
     * Get product by ID
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    /**
     * Get all products
     */
    public function getAllProducts(array $filters = []): Collection
    {
        return $this->productRepository->getAll($filters);
    }

    /**
     * Get categories for filter dropdown
     */
    public function getCategories(): \Illuminate\Support\Collection
    {
        return $this->productRepository->getCategories();
    }

    /**
     * Get brands for filter dropdown
     */
    public function getBrands(): \Illuminate\Support\Collection
    {
        return $this->productRepository->getBrands();
    }
}
