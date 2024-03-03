@extends('admin.layout.admin')

@section('content')
{{-- @include('admin.include.top_bar') --}}
    <!-- BEGIN: Responsive Table -->
    @include('admin.part.alart')
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                User Messages
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                {{-- <a href="{{ route('send_email_Store') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a> --}}
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">email</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Phone</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">subject</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">service</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Message</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->email }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->phone }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->subject }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->service }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->message }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <div class="d-inline">
                                            <form method="POST" action="{{ route('send_email_delete', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
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