@if($category->subcategory->count() == 0)
    <li class="level d-flex align-items-center" data-id="{{$category->id}}">
        <a onclick="goToCategory(`{{ $category->id }}`, `{{$category->cat_slug}}`)"  data-src="{{ route('category_product', $category->cat_slug) }}" id="category_{{$category->id}}" href="#" class="product_name">
            {{$category->category_name}}
        </a>
    </li>
@else
    <li class="level d-flex align-items-center" data-id="{{$category->id}}">
        <a onclick="goToCategory(`{{ $category->id }}`, `{{$category->cat_slug}}`)" href="#" data-src="{{ route('category_product', $category->cat_slug) }}" class="product_name menu_bar">
            {{$category->category_name}}
        </a>
        <i class="fa fa-angle-right fa-lg" style="padding-right: 10px"></i>
        <ul>
            @foreach ($category->subcategory as $sub_category_item)
                @if($sub_category_item->subcategory->count() == 0)
                    <li class="level d-flex align-items-center" data-id="{{$category->id}}">
                        <a href="#" onclick="goToSubCategory(`{{ $sub_category_item->id }}`, `{{$sub_category_item->cat_slug}}`)" data-src="{{ route('category_product', $sub_category_item->cat_slug) }}" class="product_name">{{$sub_category_item->category_name}}</a>
                    </li>
                @else
                    @include('livewire.frontend.components.sidebar-component',[
                        'category'=> $sub_category_item,
                    ])
                @endif
            @endforeach
        </ul>
    </li>
@endif
