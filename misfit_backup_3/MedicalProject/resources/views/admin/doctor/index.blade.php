@extends('admin.layout.admin')

@section('content')

@include('admin.part.alart')
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
               All Doctors
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('doctors.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Photo</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">designation</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Social Links</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap"><img src='{{ asset("/uploads/doctors/$item->photo") }}' style="height: 75px;" alt="{{ $item->title_image }}"></td>
                                    <td class="border-b whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->designation }}</td>
                                    <td class="border-b whitespace-nowrap">{{ \Illuminate\Support\Str::limit($item->description, 40, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap" style="">
                                        <div class="social" style="display: flex; justify-content: space-between; margin: 50px 0px">
                                            <a href="{{ $item->facebook_ac }}">
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="{{ $item->twitter_ac }}">
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="{{ $item->google_ac }}">
                                                <i class="icon-gplus"></i>
                                        </div>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('doctors.edit', $item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fa fa-pencil"></i> 
                                            <span>Edit</span>
                                        </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('doctors.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you want to delete?')" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($collection->links()->paginator->hasPages())
                                <div class="d-flex justify-content-center">
                                    {!! $collection->links() !!}
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- END: Responsive Table -->
@endsection