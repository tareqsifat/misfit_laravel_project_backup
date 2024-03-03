@extends('admin.layout.admin')

@section('content')
@include('admin.part.alart')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                OurWork
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('ourwork.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i>&nbsp;ADD</a>
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
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">body</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">message</th>
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
                                        <i class="{{ $item->icon }}" style="font-size: 3rem"></i>
                                    </td>
                                    <td class="border-b whitespace-nowrap">{{ \Illuminate\Support\Str::limit($item->body, 60, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap" style="width: 100px"> {{ \Illuminate\Support\Str::limit($item->message, 60, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('ourwork.edit',$item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fas fa-pencil-alt"></i> 
                                            <span>&nbsp;edit</span>
                                        </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('ourwork.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
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