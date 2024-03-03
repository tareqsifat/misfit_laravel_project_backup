@extends('admin.layout.admin')

@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Users Layout
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('user_create') }}" class="btn btn-primary shadow-md mr-2">Add New User</a>
            <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of {{ App\Models\User::count() }} entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($collection as $item)
        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                <div class="box">
                <div class="flex items-start px-5 pt-5">
                    <div class="w-full flex flex-col lg:flex-row items-center">
                        <div class="w-16 h-16 image-fit">
                            <img alt="{{ $item->photo }}" class="rounded-full" src="{{ asset('uploads/users') }}/{{ $item->photo }}">
                        </div>
                        <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $item->username}}</a> 
                            <div class="text-gray-600 text-xs mt-0.5">{{ $item->email }}</div>
                        </div>
                    </div>
                    {{-- @if(Illuminate\Support\Facades\Auth::user()->id == $item->id) --}}
                        <div class="absolute right-0 top-0 mr-5 mt-3 dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                    <a href="{{ route('user_edit', $item->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit </a>
                                    <a href="{{ route('user_delete',$item->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                </div>
                            </div>
                        </div>
                    {{-- @endif --}}
                    
                </div>
                <div class="text-center lg:text-left p-5">
                    <div>{{ $item->description }}</div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5"> <i data-feather="mail" class="w-3 h-3 mr-2"></i> {{ $item->email }} </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1"> <i data-feather="facebook" class="w-3 h-3 mr-2"></i> {{ $item->username }} </div>
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                    <a class="btn btn-primary py-1 px-2 mr-2">Message</a>
                    <a href="{{ route('user_show',$item->id) }}" class="btn btn-outline-secondary py-1 px-2">Profile</a>
                </div>
            </div>
        </div>
        @endforeach
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <ul class="pagination">
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a>
                </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li> <a class="pagination__link" href="">1</a> </li>
                <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
                <li> <a class="pagination__link" href="">3</a> </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                </li>
            </ul>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
@endsection