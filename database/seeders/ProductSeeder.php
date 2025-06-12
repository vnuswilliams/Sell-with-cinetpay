<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Course Subscription',
                'description' => 'Get access to all our premium courses for one year',
                'price' => 1000,
                'url' => 'https://example.com/images/premium-course.jpg'
            ],
            [
                'name' => 'Web Development Masterclass',
                'description' => 'Complete guide to modern web development techniques',
                'price' => 1500,
                'url' => 'https://example.com/images/webdev-course.jpg'
            ],
            [
                'name' => 'Mobile App Design Workshop',
                'description' => 'Learn to design beautiful mobile applications',
                'price' => 50000,
                'url' => 'https://example.com/images/mobile-design.jpg'
            ],
            [
                'name' => 'Data Science Fundamentals',
                'description' => 'Introduction to data analysis and machine learning',
                'price' => 85000,
                'url' => 'https://example.com/images/data-science.jpg'
            ],
            [
                'name' => 'DevOps Certification',
                'description' => 'Complete DevOps workflow and certification preparation',
                'price' => 2800,
                'url' => 'https://example.com/images/devops.jpg'
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
