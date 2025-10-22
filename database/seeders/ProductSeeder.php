<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'The latest iPhone with advanced camera system, A17 Pro chip, and titanium design.',
                'price' => 999.99,
                'category' => 'Smartphones',
                'brand' => 'Apple',
                'stock_quantity' => 50,
                'image_url' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400',
                'specifications' => [
                    'storage' => '256GB',
                    'color' => 'Natural Titanium',
                    'screen_size' => '6.1 inches',
                    'camera' => '48MP Main Camera'
                ],
                'is_active' => true
            ],
            [
                'name' => 'MacBook Pro 16-inch',
                'description' => 'Powerful laptop with M3 Pro chip, stunning Liquid Retina XDR display, and all-day battery life.',
                'price' => 2499.99,
                'category' => 'Laptops',
                'brand' => 'Apple',
                'stock_quantity' => 25,
                'image_url' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400',
                'specifications' => [
                    'processor' => 'M3 Pro',
                    'memory' => '18GB RAM',
                    'storage' => '512GB SSD',
                    'display' => '16.2-inch Liquid Retina XDR'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'Premium Android smartphone with S Pen, advanced AI features, and professional-grade camera.',
                'price' => 1199.99,
                'category' => 'Smartphones',
                'brand' => 'Samsung',
                'stock_quantity' => 40,
                'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400',
                'specifications' => [
                    'storage' => '512GB',
                    'color' => 'Titanium Black',
                    'screen_size' => '6.8 inches',
                    'camera' => '200MP Main Camera',
                    's_pen' => 'Included'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Dell XPS 13',
                'description' => 'Ultra-thin laptop with InfinityEdge display, Intel Core i7 processor, and premium build quality.',
                'price' => 1299.99,
                'category' => 'Laptops',
                'brand' => 'Dell',
                'stock_quantity' => 30,
                'image_url' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400',
                'specifications' => [
                    'processor' => 'Intel Core i7-1360P',
                    'memory' => '16GB RAM',
                    'storage' => '512GB SSD',
                    'display' => '13.4-inch FHD+ InfinityEdge'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Industry-leading noise canceling headphones with exceptional sound quality and comfort.',
                'price' => 399.99,
                'category' => 'Audio',
                'brand' => 'Sony',
                'stock_quantity' => 60,
                'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400',
                'specifications' => [
                    'driver_size' => '30mm',
                    'frequency_response' => '4Hz-40kHz',
                    'battery_life' => '30 hours',
                    'noise_canceling' => 'Industry Leading'
                ],
                'is_active' => true
            ],
            [
                'name' => 'iPad Pro 12.9-inch',
                'description' => 'Most powerful iPad with M2 chip, Liquid Retina XDR display, and Apple Pencil support.',
                'price' => 1099.99,
                'category' => 'Tablets',
                'brand' => 'Apple',
                'stock_quantity' => 35,
                'image_url' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=400',
                'specifications' => [
                    'processor' => 'M2',
                    'storage' => '256GB',
                    'display' => '12.9-inch Liquid Retina XDR',
                    'apple_pencil' => 'Compatible'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'description' => 'Gaming console with vibrant OLED screen, enhanced audio, and versatile play modes.',
                'price' => 349.99,
                'category' => 'Gaming',
                'brand' => 'Nintendo',
                'stock_quantity' => 45,
                'image_url' => 'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=400',
                'specifications' => [
                    'storage' => '64GB',
                    'display' => '7-inch OLED',
                    'battery_life' => '4.5-9 hours',
                    'play_modes' => 'TV, Tabletop, Handheld'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Canon EOS R5',
                'description' => 'Professional mirrorless camera with 45MP full-frame sensor and 8K video recording.',
                'price' => 3899.99,
                'category' => 'Cameras',
                'brand' => 'Canon',
                'stock_quantity' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=400',
                'specifications' => [
                    'sensor' => '45MP Full-Frame CMOS',
                    'video' => '8K RAW Video',
                    'iso_range' => '100-51200',
                    'autofocus' => 'Dual Pixel CMOS AF II'
                ],
                'is_active' => true
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
