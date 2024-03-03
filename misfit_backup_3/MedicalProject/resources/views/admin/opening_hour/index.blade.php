@extends('admin.layout.admin')

@section('content')
@include('admin.part.alart')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Opening_hours
            </h2>
            {{-- <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('opening_hour.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i> ADD</a>
            </div> --}}
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Day</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Start Time</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">End Time</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Is Closed?</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ $key+1 }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->day }}</td>
                                    @if(!($item->isclosed))
                                        <td class="border-b whitespace-nowrap">{{ $item->start_time->format('h:i:s a') }}</td>
                                        <td class="border-b whitespace-nowrap">{{ $item->end_time->format('h:i:s a') }}</td>
                                    @else    
                                        <td class="border-b whitespace-nowrap"></td>
                                        <td class="border-b whitespace-nowrap"></td>
                                    @endif
                                    <td class="border-b whitespace-nowrap">
                                        @if ($item->isclosed)
                                            <span class="text-danger"><b>Closed</b></span>
                                        @else
                                            <span class="text-success"><b>Open</b></span>
                                        @endif
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        <div class="d-inline">
                                            <a type="button" href="{{ route('opening_hour.edit', $item->id) }}" 
                                                class="btn btn-warning waves-effect waves-light m-1">
                                                <i class="fa fa-pencil"></i> 
                                                <span>edit</span>
                                            </a>
                                        </div>
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