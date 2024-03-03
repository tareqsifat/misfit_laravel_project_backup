@foreach ($varients as $varient)
    <div class="mb-3 bg-white filter_card">
        <div onclick="varient{{$varient->id}}.classList.toggle('d-none')" class="card-header filter_header bg-white d-flex justify-content-between">
            <b>
                {{ $varient->title }}
            </b>
            <b>
                <i class="fa filter_toggler fa-angle-down" ></i>
            </b>
        </div>
        <div class="p-2 d-block filter_list" id="varient{{$varient->id}}">
            <ul>
                @foreach($varient->values as $value)
                <li>
                    <label for="varientv{{$value->id}}">
                        <input type="checkbox" onchange="change_varient()"
                            id="varientv{{$value->id}}"
                            value="{{$value->id}}"
                            {{ in_array($value->id,$query_varients)?'checked':''}}
                            class="form-check-input me-2" name="selected_varients" />
                        {{ $value->title }}
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach

