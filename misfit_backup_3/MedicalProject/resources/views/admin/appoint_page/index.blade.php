@extends('admin.layout.admin')

@section('content')

@include('admin.part.alart')
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Blogs
            </h2>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('appoint_page.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
            </div>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Title Image</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Form image</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Title Message</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Question Message</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Published</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap"><img src='{{ asset("/uploads/appoint_pages/$item->title_image") }}' style="height: 100px;" alt="{{ $item->title_image }}"></td>
                                    <td class="border-b whitespace-nowrap"><img src='{{ asset("/uploads/appoint_pages/$item->form_image") }}' style="height: 100px;" alt="{{ $item->form_image }}"></td>
                                    <td class="border-b whitespace-nowrap">{{ \Illuminate\Support\Str::limit($item->title_message, 35, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap">{{ \Illuminate\Support\Str::limit($item->question_message, 35, $end='...') }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        @if ($item->published)
                                            <form action="{{ route('appoint_publish', $item->id) }}" method="POST">
                                                @csrf
                                                @method('GET')
                                                <select name="published" id="" style="display: none">
                                                    <option value="0"></option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Published</button>
                                            </form>
                                        @else
                                            <form action="{{ route('appoint_publish', $item->id) }}" method="POST">
                                                @csrf
                                                @method('GET')
                                                <select name="published" id="" style="display: none">
                                                    <option value="1"></option>
                                                </select>
                                                <button type="submit" class="btn btn-secondary">Not Published</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                            <a type="button" href="{{ route('appoint_page.edit', $item->id) }}" 
                                                class="btn btn-warning waves-effect waves-light m-1">
                                                <i class="fa fa-pencil"></i> 
                                                <span>Edit</span>
                                            </a>
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <form method="POST" action="{{ route('appoint_page.destroy', $item->id) }}">
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