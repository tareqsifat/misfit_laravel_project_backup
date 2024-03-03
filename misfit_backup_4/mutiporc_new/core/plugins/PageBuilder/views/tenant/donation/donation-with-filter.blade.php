<div class="donationListing section-padding">
    <div class="container" data-padding-top="{{$data['padding_top']}}" data-padding-bottom="{{$data['padding_bottom']}}">
        <!-- Search Bar -->
        <div class="row justify-content-between mb-24 donation_filter">
            <div class="col-lg-4 col-md-6 ">
                <div class="searchBox-wrapper searchBox-wrapper-sidebar">
                    <!-- Search input Box -->

                    <div class="search-box">
                        <div class="input-form">
                            <div class="alert alert-danger search_bottom_message d-none">{{__('Enter anything to search')}}</div>
                            <input type="text" name="filter_input_search" class="keyup-input filter_input_search" placeholder="Search">
                            <!-- icon -->
                            <button type="button" class="icon filter_search_button">
                                <i class="fa-solid fa-magnifying-glass filter_search_button"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 ">
                <div class="selectItems d-flex justify-content-end">
                    <!-- Select One -->
                    <div class="select-itms mr-20">
                        <select class="niceSelect filter_input_sort" name="filter_sort">
                            <option value="recent" {{ request()->get('filter_sort') == 'recent' ? 'selected' : '' }}>{{__('Recent')}}</option>
                            <option value="old" {{ request()->get('filter_sort') == 'old' ? 'selected' : '' }}>{{__('Old')}}</option>
                            <option value="new" {{ request()->get('filter_sort') == 'new' ? 'selected' : '' }}>{{__('New')}}</option>
                        </select>
                    </div>

                    @php
                        $all_data = $data['donation'];
                    @endphp

                    <!-- Select Two -->
                    <div class="select-itms">
                        <select class="niceSelect filter_input_category" name="category_id">
                            <option selected disabled>{{__('Select Category')}}</option>
                            @foreach($data['all_categories'] as $cat)
                                <option value="{{$cat->id}}" {{ request('filter_category_id') == $cat->id ? 'selected' : '' }}>{{$cat->getTranslation('title',get_user_lang())}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <x-donation::frontend.donation.donation-grid :allDonation="$data['donation']" :searchTerm="$data['search_term']"/>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="pagination">
                    {{ $all_data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $route = route('tenant.dynamic.page',request()->path());
@endphp

<form action="{{$route}}" method="get" class="all_filter_form">
    <input type="hidden" class="filter_receieved_search" name="filter_search">
    <input type="hidden" class="filter_receieved_sort" name="filter_sort">
    <input type="hidden" class="filter_receieved_category_id" name="filter_category_id">
</form>


@section('scripts')
    <script>
       $(document).ready(function(){
           let body_main = $('.donation_filter');

           setTimeout(function (){
               $('.donation_filter_top_message').hide();
           },3000)

           function trigger_form() {
               return $('.all_filter_form').trigger('submit');
           }

           $(document).on('click','.filter_search_button',function(e){
               e.preventDefault();
               let el = $('.filter_input_search').val();

               if(el == ''){
                   $('.search_bottom_message').removeClass('d-none');
                    setTimeout(function (){
                        $('.search_bottom_message').addClass('d-none');
                    },2000)
               }else{
                   $('.filter_receieved_search').val(body_main.find('.filter_input_search').val());
                   trigger_form();
               }
           })

           $(document).on('change','.filter_input_sort',function(e){
               e.preventDefault();
               $('.filter_receieved_sort').val(body_main.find('.filter_input_sort').val());
               trigger_form();
           })

           $(document).on('change','.filter_input_category',function(e){
               e.preventDefault();
               $('.filter_receieved_category_id').val(body_main.find('.filter_input_category').val());
               trigger_form();
           })
       });
    </script>
@endsection


