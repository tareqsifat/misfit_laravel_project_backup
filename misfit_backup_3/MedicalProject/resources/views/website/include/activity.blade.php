<div class="heading-block border-bottom-0 bottommargin-sm">
    <h3 class="nott ls0">What We do Actually</h3>
</div>

@foreach ($ourwork as $item)
    <p>{{ $item->message }}</p>
    @break
@endforeach

@foreach ($ourwork as $item)
    <div class="feature-box fbox-plain fbox-sm mb-4">
    <div class="fbox-icon mt-2" data-animate="fadeIn">
        <a href="#"><i class="{{ $item->icon }}"></i></a>
    </div>
    <div class="fbox-content">
        <p class="mt-0">{{ $item->body }}</p>
    </div>
</div>

@endforeach
