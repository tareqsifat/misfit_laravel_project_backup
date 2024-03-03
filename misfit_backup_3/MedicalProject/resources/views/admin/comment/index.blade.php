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
                All Comments
            </h2>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                {{-- <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">image</th> --}}
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">name</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">email</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">website</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">body</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Approved</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Creator</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Blog</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    {{-- <td class="border-b whitespace-nowrap"><img src={{ "/uploads/comments/$item->image" }} alt="{{ $item->image }}"></td> --}}
                                    <td class="border-b whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->email }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->website }}</td>
                                    <td class="border-b whitespace-nowrap">{{ \Illuminate\Support\Str::limit($item->body, 40, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        @if ($item->approved)
                                        <form action="{{ route('comments.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="approved" id="" style="display: none">
                                                <option value="0"></option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Approved</button>
                                            {{-- <i type ="submit" class="btn btn-primary">Approved</i> --}}
                                        </form>
                                        @else
                                            <form action="{{ route('comments.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="approved" id="" style="display: none">
                                                    <option value="1"></option>
                                                </select>
                                                <button type="submit" class="btn btn-secondary">Not Approved</button>
                                            </form>
                                            {{-- <i class="btn btn-secondary">Not Approved</i> --}}
                                        @endif
                                    </td>
                                    <td class="border-b whitespace-nowrap">{{ $item->creator }}</td>
                                    {{-- <td class="border-b whitespace-nowrap">{{ $item->blog_id }}</td> --}}
                                    <td class="border-b whitespace-nowrap">{{ $item->blog_id }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <div class="justify-content-between">
                                            <form method="POST" action="{{ route('comments.destroy', $item->id) }}">
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
                </div>
            </div>
        </div>
    </div>
    <!-- END: Responsive Table -->
@endsection