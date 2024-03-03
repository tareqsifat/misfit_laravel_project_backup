<nav id="navs">
    <div class="container-lg nav_container">
        <div id="cat_navbar">
            <div class="close_nav">
                <i class="fa fa-close" onclick="document.getElementById('navs').classList.toggle('active')"></i>
            </div>
            <?php
                function cat_print($categories){
                    if($categories->count()){
            ?>
                        <ul>
                            <?php
                                foreach ($categories as $category){
                            ?>
                                    <li>
                                        <a href="{{url($category->url)}}">
                                            {{ $category->name }}
                                            <?php
                                                if ($category->parent_id > 0 && $category->childrens()->count())
                                                    echo '<i class="fa fa-caret-right"></i>';
                                            ?>
                                            <?php
                                                if ($category->childrens()->count())
                                                    echo '<i onclick="active_ul()" class="fa fa-plus-square-o expand_icon"></i>';
                                            ?>
                                        </a>
                                        <?php
                                            if($category->childrens->count()){
                                                cat_print($category->childrens);
                                            }
                                        ?>
                                    </li>
                            <?php
                                }
                            ?>
                        </ul>
            <?php

                    }
                }
                cat_print(\App\Models\Category::where('parent_id',0)->with('childrens')->get());
            ?>

            <script>
                function active_ul(){
                    event.preventDefault();
                    let li = event.target.parentNode.parentNode;
                    let ul = event.target.parentNode.nextElementSibling;
                    li.classList.toggle('active');
                    ul.classList.toggle('active');
                    console.log(event.target, li, event);
                }
            </script>
        </div>
    </div>
</nav>
