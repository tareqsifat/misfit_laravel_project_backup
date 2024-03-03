@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product Inventory</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Product Inventory</div>
            </div>
            <div class="card-common-body">
                <div class="row">
                    <div class="col-sm-12 lengthFilterCol">

                      
                    </div>
                </div>
                <div class="row no-margin filter-trigger" style="display: block;">
                    <div class="col-md-12">
                       
                    </div>
                </div>
                <div class="card-table-responsive">
                    <table id="customers" class="table tableCommon table-striped table-single-line">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Sold</th>
                                <th>Action</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_inventory_products as $inventory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventory?->product?->getTranslation('name',default_lang()) }}</td>
                                        <td>{{ $inventory->sku }}</td>
                                        <td>{{ $inventory->stock_count ?? 0 }}</td>
                                        <td>{{ $inventory->sold_count ?? 0 }}</td>
                                        <td>
                                            @can('product-inventory-edit')
                                                <x-table.btn.edit
                                                        :route="route('tenant.admin.product.inventory.edit', $inventory->id)"/>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Sold</th>
                                <th>Action</th>
                              
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete model  -->




@endsection