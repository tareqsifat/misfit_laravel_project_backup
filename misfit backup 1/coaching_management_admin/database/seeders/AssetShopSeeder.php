<?php

namespace Database\Seeders;

use App\Models\Asset\AssetShop;
use Illuminate\Database\Seeder;

class AssetShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssetShop::truncate();
        $asset_shop = new AssetShop();
        $asset_shop->title = "Farmgate Branch";
        $asset_shop->address = "Green road, Farmgate";
        $asset_shop->contact_number = "0178945448";
        $asset_shop->save();

        $asset_shop = new AssetShop();
        $asset_shop->title = "Uttora Branch";
        $asset_shop->address = "road 11, section 7, uttora";
        $asset_shop->contact_number = "0178945444";
        $asset_shop->save();

        $asset_shop = new AssetShop();
        $asset_shop->title = "Mirpur Branch";
        $asset_shop->address = "road 11, section 1, mipur";
        $asset_shop->contact_number = "0178945446";
        $asset_shop->save();
    }
}
