@extends('admin.layout.admin')

@section('content')
@include('admin.part.alart')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                All Departments
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('departments.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i>&nbsp; ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">icon</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Doctor</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">survice</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">title</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Treatment</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <i class="{{ $item->icon }}" style="font-size: 2rem"></i>
                                    </td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px"> {{ $item->doctor_info->name }}</td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px">
                                        @if ($item->survice) 
                                            <p>Treatment</p>
                                        @else
                                            <p>Therapy</p>
                                        @endif</td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px"> {{ $item->title }}</td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px">{{ \Illuminate\Support\Str::limit($item->description, 40, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px"> {{ $item->treatment->name }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('departments.edit',$item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fa fa-pencil"></i> 
                                            <span>edit</span>
                                        </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('departments.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-center">
                        {!! $collection->links() !!}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END: Responsive Table -->
@endsection