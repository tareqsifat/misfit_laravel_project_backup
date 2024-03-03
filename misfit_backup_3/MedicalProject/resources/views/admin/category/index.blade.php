@extends('admin.layout.admin')

@section('content')
    @include('admin.part.alart')
    
    {{-- @php
        dd(session()->all())
    @endphp --}}
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Categories
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('category.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i>&nbsp; ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: left" class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th style="text-align: left" class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                <th style="width: 80px;text-align: right" style="text-align: right" class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->name }}</td>
                                    <td style="width: 80px; text-align: left" 
                                        class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('category.edit',$item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fas fa-pencil"></i> 
                                            <span> edit</span>
                                        </a>
                                    </td>
                                    <td style="width: 80px;  text-align: right">
                                        <form method="POST"  action="{{ route('category.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
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