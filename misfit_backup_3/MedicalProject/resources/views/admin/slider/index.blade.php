@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                All sliders
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('slider.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Image</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Left-title</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Right-title</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap"><img src='{{ asset("uploads/sliders/$item->image") }}' style="height: 100px" alt="{{ $item->image }}"></td>
                                    <td class="border-b whitespace-nowrap">{{ $item->left_title }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->right_title }}</td>
                                    <td class="border-b whitespace-nowrap" style="width:100px">
                                        <a type="button" href="{{ route('slider.edit', $item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fa fa-pencil"></i> 
                                            <span>Edit</span>
                                        </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px"> 
                                        <form method="POST" action="{{ route('slider.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Responsive Table -->
@endsection