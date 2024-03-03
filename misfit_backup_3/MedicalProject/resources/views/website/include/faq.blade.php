<div class="accordion accordion-lg clearfix">
    @foreach ($faqs as $item)
        <div class="accordion-header">
        <div class="accordion-icon">
            <i class="accordion-closed icon-ok-circle"></i>
            <i class="accordion-open icon-remove-circle"></i>
        </div>
        <div class="accordion-title">{{ $item->title }}</div>
    </div>
    <div class="accordion-content clearfix">{{ $item->body }}</div>
    @endforeach
</div>