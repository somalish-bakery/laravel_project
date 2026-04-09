<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Fish Amok',
                'khmer_name' => 'អាម៉ុកត្រី',
                'description' => 'Traditional Khmer curry with fresh fish, coconut milk, and kroeung spice paste.',
                'price' => 8.50,
                'category' => 'Rice Dishes',
                'image' => 'images/Amok.jpg',
                'is_popular' => true
            ],
            [
                'name' => 'Beef Lok Lak',
                'khmer_name' => 'ឡុកឡាក់សាច់គោ',
                'description' => 'Stir-fried marinated beef served with fresh lettuce, tomatoes, and lime-pepper dip.',
                'price' => 7.25,
                'category' => 'Rice Dishes',
                'image' => 'images/Lok-lak.jpg',
                'is_popular' => true
            ],

            [
                'name' => 'Pork Rice',
                'khmer_name' => 'បាយសាច់ជ្រូក',
                'description' => 'Pork rice with pickled vegetables and egg.',
                'price' => 3.25,
                'category' => 'Rice Dishes',
                'image' => 'images/Pork-Rice.jpg',
                'is_popular' => false
            ],

            [
                'name' => 'Nom Banh Chok',
                'khmer_name' => 'នំបញ្ចុក',
                'description' => 'Khmer noodles topped with green fish gravy and fresh seasonal vegetables.',
                'price' => 3.50,
                'category' => 'Noodles',
                'image' => 'images/Nom-banh-chok.jpg',
                'is_popular' => true
            ],
            [
                'name' => 'Kuy Teav Phnom Penh',
                'khmer_name' => 'គុយទាវភ្នំពេញ',
                'description' => 'Clear pork broth rice noodle soup with minced pork and seafood.',
                'price' => 4.00,
                'category' => 'Noodles',
                'image' => 'images/Kuy-Teav.jpg',
                'is_popular' => false
            ],

            [
                'name' => 'Machu Kroeung',
                'khmer_name' => 'សម្លរម្ជូរ',
                'description' => 'flavorful and aromatic soup known for its bold combination of spicy, sour, and savory flavors.',
                'price' => 6.00,
                'category' => 'Soups',
                'image' => 'images/Machu-Kroeung.jpg',
                'is_popular' => false
            ],

            [
                'name' => 'Samlor Korko',
                'khmer_name' => 'សម្លកកូរ',
                'description' => 'delicious soup is made with hearty mix of in season-vegetables, unripe fruit.',
                'price' => 6.00,
                'category' => 'Soups',
                'image' => 'images/Samlo-Korko.jpg',
                'is_popular' => false
            ],

            [
                'name' => 'Iced Coffee with Milk',
                'khmer_name' => 'កាហ្វេទឹកដោះគោទឹកកក',
                'description' => 'Strong dark roasted coffee with sweetened condensed milk.',
                'price' => 1.50,
                'category' => 'Drinks',
                'image' => 'images/Ice-Coffee.jpeg',
                'is_popular' => true
            ],

            [
                'name' => 'Orange Juice',
                'khmer_name' => 'ទឹកក្រូច',
                'description' => 'Orange juice is a nutrient-dense beverage rich in vitamin C, potassium, and folate.',
                'price' => 2.50,
                'category' => 'Drinks',
                'image' => 'images/Orange-Juice.png',
                'is_popular' => false
            ],

            [
                'name' => 'Fresh Coconut Water',
                'khmer_name' => 'ទឹកដូង',
                'description' => 'Natural coconut water served fresh.',
                'price' => 1.50,
                'category' => 'Drinks',
                'image' => 'images/Coconut-Water.jpg',
                'is_popular' => false
            ],

            [
                'name' => ' Lort',
                'khmer_name' => 'បង្អែមលត',
                'description' => 'served with a sweet topping of jaggery and coconut milk creating a delightful balance of sweetness and creaminess.',
                'price' => 2.50,
                'category' => 'Desserts',
                'image' => 'images/Lort.jpeg',
                'is_popular' => false
            ],

            [
                'name' => 'Mango Sticky Rice',
                'khmer_name' => 'បាយដំណើបស្វាយ',
                'description' => 'Sticky rice with mango and coconut cream.',
                'price' => 3.50,
                'category' => 'Desserts',
                'image' => 'images/Mango-Sticky-Rice.jpg',
                'is_popular' => false
            ],











        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}