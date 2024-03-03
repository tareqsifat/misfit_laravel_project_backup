<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class MetaComposer {
    public function compose(View $view)
    {
        $meta = Category::get('meta_title', 'meta_description');
        $view->with('meta', $meta);
    }
}

?>
