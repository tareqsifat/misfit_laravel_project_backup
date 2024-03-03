{{-- <div class="dropdown-submenu">
    <a class="dropdown-item dropdown-toggle" href="#">{{ $subcategory->category_name }}</a>
    @if ($subcategory->subcategory->count() > 0)
        <div class="dropdown-menu">
            @foreach ($subcategory->subcategory as $sub)
                @include('livewire.frontend.components.subcategories', ['subcategory' => $sub])
            @endforeach
        </div>
    @endif --}}
    <ul class="@if(count($category->subcategory) > 0) list-group-item cat-dropdown list-group @endif">
        @foreach ($subcategory->subcategory as $sub)
            <li class="@if(count($category->subcategory) > 0) right-menu list-group-item @endif">
                <a href="">{{ $sub->category_name }}</a>
                @include('livewire.frontend.components.subcategories', ['subcategory' => $sub])
            </li>
        @endforeach
        {{-- <li v-for="subcategory in subcategories" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'right-menu list-group-item' : ''">
            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
            <header-category-list :subcategories="subcategory.subcategory"></header-category-list>
        </li> --}}
    </ul>
{{-- </div> --}}
