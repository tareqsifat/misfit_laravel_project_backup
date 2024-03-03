<form method="POST" action="{{ route('footer_single_update', $item->id) }}" enctype="multipart/form-data" style="padding-right: 10px" id="horizontal-form">
    @csrf
    @method('PUT')
    <div class="preview">
        <div class="form-group p-4 mb-3">
            <label for="horizontal-form-1" class="form-label sm:w-20">{{ $name }}</label>
            <input id="horizontal-form-1" name="{{ $name }}" type="text" class="form-control" value="{{ $item->$name }}">
            @error('{{ $name }}')
                <div class="text-theme-6 mt-2">{{ $message }}<br></div>
            @enderror
        </div>
        <div class="sm:ml-20 sm:pl-5 mt-5" style="text-align: right; margin-right: 20px">
            <button type="button" onclick="document.getElementById('{{ $fname }}').style.display = 'none'" style="margin-bottom: 30px" class="btn btn-primary">
                <i class="fas fa-window-close"></i>
                &nbsp; close
            </button>
            <button type="submit" style="margin-bottom: 30px" class="btn btn-primary">
                <i class="icon-lock"></i>
                &nbsp; update
            </button>
        </div>
    </div>
</form