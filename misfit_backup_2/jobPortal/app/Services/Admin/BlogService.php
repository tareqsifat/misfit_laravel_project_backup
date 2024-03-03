<?php

namespace app\Services\Admin;

use App\Models\Blog;

class BlogService
{
    public function save($data, $blog)
    {
        $blog->title = $data['title'];
        $blog->sub_title = $data['sub_title'];
        $blog->description = $data['description'];

        $blog->save();
    }
}
