
<div class="time-table-wrap clearfix">
    @foreach ($opening as $item)
        <div class="row time-table">
            <h5 class="col-lg-5">{{ $item->day }}</h5>
            @if($item->isclosed == 0)
                <span class="col-lg-7">{{ date('h:i A',strtotime($item->start_time)) }} - {{ date('h:i A',strtotime($item->end_time)) }}</span>   
            @else
                <span class="col-lg-7 color fw-semibold">Closed</span>
            @endif
        </div>
    @endforeach
    
</div>