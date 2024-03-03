<?php

namespace App\Http\Livewire\Components;

use App\Models\Banner as BannerModel;
use Livewire\Component;

class Banner extends Component
{
    public $banner;
    public function render()
    {
        $this->banner = BannerModel::first();
        // $this->banner_title = $banner->title;
        // $this->banner_title_highlight = $banner->title_highlight;
        // $this->banner_text = $banner->paragraph;
        // $this->banner_link = $banner->link;
        return view('livewire.components.banner');
    }
}
