<?php

namespace Database\Seeders;

use App\Models\Asset\AssetCategory;
use Illuminate\Database\Seeder;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     
     */

    
    public function run()
    {

        $category = [
            [
                'id' => 1,
                'title' => 'Connectivity',
                'parent' => 0,
                'childrens' => [
                    [
                        'title' => 'Internet & modem',
                        'parent' => 1,
                        'children' => [

                        ],
                    ],
                    [
                        'title' => 'Router',
                        'parent' => 1,
                        'children' => [

                        ],
                    ],
                ]
            ],

            [
                'id' => 2,
                'title' => 'Computer & Accessories',
                'parent' => 0,
                'childrens' => [
                    [
                        'title' => 'PC',
                        'parent' => 2,
                        'children' => [

                        ],
                    ],
                    [
                        'title' => 'Motherboard',
                        'parent' => 2,
                        'children' => [

                        ],
                    ],
                    [
                        'title' => 'Processor',
                        'parent' => 2,
                        'children' => [
                            
                        ],
                    ],
                ]
            ],

            [
                'id' => 3,
                'title' => 'Funriture',
                'parent' => 0,
                'childrens' => [
                    [
                        'title' => 'Chair',
                        'parent' => 3,
                        'children' => [

                        ],
                    ],
                    [
                        'title' => 'Table',
                        'parent' => 3,
                        'children' => [

                        ],
                    ],
                    [
                        'title' => 'Bench',
                        'parent' => 3,
                        'children' => [
                            
                        ],
                    ],
                ]
            ],
        ];

        AssetCategory::truncate();
        foreach ($category as $category_name => $sub_categories) {
            
            $asset_category = new AssetCategory;
            $asset_category->title = $sub_categories['title'];
            $asset_category->parent = 0;
            $asset_category->save();
            if(count($sub_categories['childrens']) > 1) {
                foreach ($sub_categories['childrens'] as $sub_category_name) {
                    $asset_sub_category = new AssetCategory;
                    $asset_sub_category->title = $sub_category_name['title'];
                    $asset_sub_category->parent = $asset_category['id'];
                    $asset_sub_category->save();
                }
            }
        }
    }
}
