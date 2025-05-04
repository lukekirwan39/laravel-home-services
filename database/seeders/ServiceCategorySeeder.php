<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ["name" => "AC", "slug" => 'ac', "image" => "1521969345.png"],
            ["name" => "Beauty & Salon", "slug" => 'beauty-salon', "image" => "1521969358.png"],
            ["name" => "Plumbing", "slug" => 'plumbing', "image" => "1521969409.png"],
            ["name" => "Electrical", "slug" => 'electrical', "image" => "1521969419.png"],
            ["name" => "Bathroom & Sanitary", "slug" => 'bathroom-sanitary', "image" => "1521969430.png"],
            ["name" => "Home Cleaning", "slug" => 'cleaning', "image" => "1521969446.png"],
            ["name" => "Carpentry & Handyman", "slug" => 'carpentry-handyman', "image" => "1521969454.png"],
            ["name" => "Pest Control", "slug" => 'pest-control', "image" => "1521969464.png"],
            ["name" => "Chimney Hob", "slug" => 'chimney-hob', "image" => "1521969490.png"],
            ["name" => "Water Purifier", "slug" => 'water-purifier', "image" => "1521972593.png"],
            ["name" => "Computer Repair", "slug" => 'computer-repair', "image" => "1521969512.png"],
            ["name" => "TV", "slug" => 'tv-repair', "image" => "1521969522.png"],
            ["name" => "Refrigerator Services", "slug" => 'refrigerator', "image" => "1521969536.png"],
            ["name" => "Geyser Repair", "slug" => 'geyser-repair', "image" => "1521969558.png"],
            ["name" => "Car", "slug" => 'car-repair', "image" => "1521969576.png"],
            ["name" => "Document Services", "slug" => 'document-services', "image" => "1521974355.png"],
            ["name" => "Moving & Shifting", "slug" => 'moving-services', "image" => "1521969599.png"],
            ["name" => "Security Systems", "slug" => 'security-systems', "image" => "1521969622.png"],
            ["name" => "Laundry Services", "slug" => 'laundry', "image" => "1521972624.png"],
            ["name" => "Washing Machine Repair", "slug" => 'washing-machine-repair', "image" => "1521972663.png"],
            ["name" => "Painting Services", "slug" => 'painting', "image" => "1521972643.png"],
            ["name" => "Microwave Repair", "slug" => 'microwave-repair', "image" => "1521972769.png"],
        ];

        foreach ($categories as $category) {
            DB::table('service_categories')->updateOrInsert(
                ['slug' => $category['slug']], // Match by slug
                $category                       // Update or insert with this data
            );
        }
    }
}
