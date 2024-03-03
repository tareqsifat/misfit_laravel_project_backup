@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                All Subcategories
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('subcategory.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i>&nbsp; ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Category</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->category_info ? $item->category_info->name : "no category found on this id (id = $item->category_id)"  }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->name }}</td>
                                    <td style="width: 100px" class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('subcategory.edit',$item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fa fa-pencil"></i> 
                                            <span>edit</span>
                                        </a>
                                    </td>
                                    <td style="width: 100px" class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('subcategory.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($collection->links()->paginator->hasPages())
                        <div class="d-flex justify-content-center">
                            {!! $collection->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END: Responsive Table -->
@endsection