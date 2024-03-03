@extends('admin.layout.admin')

@section('content')
@include('admin.part.alart')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Questions On Appointment Page
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('appoint_que.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
            </div>
        </div>
        <p class="p-5">First 6 entries of this list will be shown on the website</p>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Question</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Answer</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->question }}</td>
                                    {{-- <td class="border-b whitespace-nowrap">{{ $item->answer }}</td> --}}
                                    <td>{{ \Illuminate\Support\Str::limit($item->answer, 100, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('appoint_que.edit',$item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fa fa-pencil"></i> 
                                            <span>edit</span>
                                        </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('appoint_que.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{-- {!! $collection->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Responsive Table -->
@endsection