<?php

namespace Database\Seeders;

use App\Models\Asset\BranchAsset;
use Illuminate\Database\Seeder;

class BranchAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchAsset::truncate();

        $asset = BranchAsset::create([
            'name'=>'Computer',
            'asset_category_id'=>'2',
            'branch_id'=>'1',
            'purchase_price'=> 25000,
            'depreciation_price'=> 5,
            'details'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);
        $asset->shops()->attach([1,2,3]);

        $asset = BranchAsset::create([
            'name'=>'Laptop',
            'asset_category_id'=>'3',
            'branch_id'=>'2',
            'purchase_price'=> 35000,
            'depreciation_price'=> 5,
            'details'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);
        $asset->shops()->attach([1,3]);

        $asset = BranchAsset::create([
            'name'=>'Internet Modem',
            'asset_category_id'=>'1',
            'branch_id'=>'3',
            'purchase_price'=> 5000,
            'depreciation_price'=> 5,
            'details'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);
        $asset->shops()->attach([1,2]);

        $asset = BranchAsset::create([
            'name'=>'Chair',
            'asset_category_id'=>'4',
            'branch_id'=>'3',
            'purchase_price'=> 5000,
            'depreciation_price'=> 5,
            'details'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);
        $asset->shops()->attach([2,3]);

        $asset = BranchAsset::create([
            'name'=>'Stand fan',
            'asset_category_id'=>'5',
            'branch_id'=>'3',
            'purchase_price'=> 5000,
            'depreciation_price'=> 5,
            'details'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);
        
        $asset->shops()->attach([1,3]);
    }
}
