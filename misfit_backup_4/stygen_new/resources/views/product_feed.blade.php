<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title/>
        <link>https://www.stygen.gift/</link>
        <description>Stygen Product Feed</description>
        @foreach($products as $product)
            @php
                $category = \App\Models\ProductCategory::join('categories','categories.id','=','product_categories.category_id')
                        ->where('product_categories.product_id', $product->id)
                        ->where('categories.status', 1)
                        ->select('categories.category_name')->first();
                if(isset($category)){
                    $category_name = $category->category_name;
                }else{
                    $category_name = 'Uncategorized';
                }
                $product_sku = Str::slug($product->product_sku);
                $product_description = strip_tags($product->short_description);
                $product_desc = html_entity_decode($product_description);
            @endphp
            <item>
                <g:id>{{ $product->id }}</g:id>
                <g:availability>In stock</g:availability>
                <g:condition>New</g:condition>
                <g:image_link>https://www.stygen.gift/assets/uploads/product/{{ $product->featured_image }}</g:image_link>
                <g:link>https://www.stygen.gift/product/{{ $product->pro_slug }}</g:link>
                <g:title>{{ $product->product_name }}</g:title>
                <g:description>{{ $product_desc }}</g:description>
                <g:brand>stygen</g:brand>
                <g:fb_product_category>{{ $category_name }}</g:fb_product_category>
                <g:google_product_category>{{ $category_name }}</g:google_product_category>
                <g:price>BDT {{ number_format($product->regular_price, 2) }}</g:price>
                <g:sale_price>BDT {{ number_format($product->sales_price, 2) }}</g:sale_price>
                <g:item_group_id>{{ $product_sku.'_'.$product->id }}</g:item_group_id>
                <g:product_type>{{ $category_name }}</g:product_type>
                <g:identifier_exists>no</g:identifier_exists>
            </item>
        @endforeach
    </channel>
</rss>
