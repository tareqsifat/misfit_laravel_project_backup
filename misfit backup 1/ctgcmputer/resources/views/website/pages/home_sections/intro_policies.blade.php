<div class="product-categories-area">
    <div class="container custom-container" style="overflow-x: hidden;">
        <div class="section_content">
            <div class="px-4 py-5">
                {!! \App\Models\Setting::select('descriptive_about')->first()->descriptive_about !!}
            </div>
        </div>
    </div>
</div>
