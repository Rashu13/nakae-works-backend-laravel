<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\CategoryModel;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'AC Service & Repair',
                'category_name' => 'AC Service & Repair',
                'slug' => 'ac-service-&-repair',
                'category_icon' => '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png',
                'category_image' => '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png',
                'image' => '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Fan',
                'category_name' => 'Fan',
                'slug' => 'fan',
                'category_icon' => '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png',
                'category_image' => '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png',
                'image' => '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Electrician',
                'category_name' => 'Electrician',
                'slug' => 'electrician',
                'category_icon' => '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png',
                'category_image' => '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png',
                'image' => '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'id' => 4,
                'name' => 'CCTV Camera',
                'category_name' => 'CCTV Camera',
                'slug' => 'cctv-camera',
                'category_icon' => '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png',
                'category_image' => '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png',
                'image' => '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Water Purifier',
                'category_name' => 'Water Purifier',
                'slug' => 'water-purifier',
                'category_icon' => '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png',
                'category_image' => '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png',
                'image' => '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Inverter/Stabilizer',
                'category_name' => 'Inverter/Stabilizer',
                'slug' => 'inverter/stabilizer',
                'category_icon' => '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png',
                'category_image' => '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png',
                'image' => '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 6,
            ],
            [
                'id' => 7,
                'name' => 'Geyser',
                'category_name' => 'Geyser',
                'slug' => 'geyser',
                'category_icon' => '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png',
                'category_image' => '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png',
                'image' => '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 7,
            ],
            [
                'id' => 8,
                'name' => 'Washing Machine',
                'category_name' => 'Washing Machine',
                'slug' => 'washing-machine',
                'category_icon' => '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png',
                'category_image' => '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png',
                'image' => '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 8,
            ],
            [
                'id' => 9,
                'name' => 'Switch Board/Socket',
                'category_name' => 'Switch Board/Socket',
                'slug' => 'switch-board/socket',
                'category_icon' => '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png',
                'category_image' => '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png',
                'image' => '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 9,
            ],
            [
                'id' => 10,
                'name' => 'Refrigerator',
                'category_name' => 'Refrigerator',
                'slug' => 'refrigerator',
                'category_icon' => '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png',
                'category_image' => '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png',
                'image' => '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 10,
            ],
            [
                'id' => 13,
                'name' => 'Lights Installation',
                'category_name' => 'Lights Installation',
                'slug' => 'lights-installation',
                'category_icon' => '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png',
                'category_image' => '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png',
                'image' => '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png',
                'in_home' => 1,
                'status' => 1,
                'sort_order' => 11,
            ],
        ];

        $hasSlug = Schema::hasColumn('categories', 'slug');

        foreach ($categories as $cat) {
            $data = [
                'id' => $cat['id'],
                'category_name' => $cat['category_name'],
                'name' => $cat['name'],
                'category_icon' => $cat['category_icon'],
                'category_image' => $cat['category_image'],
                'image' => $cat['image'],
                'in_home' => $cat['in_home'],
                'status' => $cat['status'],
                'sort_order' => $cat['sort_order'],
                'updated_at' => now(),
            ];

            if ($hasSlug) {
                $data['slug'] = $cat['slug'];
            }

            DB::table('categories')->updateOrInsert(
                ['id' => $cat['id']],
                $data
            );
        }
    }
}
