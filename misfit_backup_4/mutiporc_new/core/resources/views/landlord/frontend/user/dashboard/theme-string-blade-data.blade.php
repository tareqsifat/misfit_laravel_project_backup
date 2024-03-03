
<option value="" selected>{{__('Select Theme')}}</option>
@foreach($themes as $theme)
    @php
         $lang_suffix = '_'.get_user_lang();
         $theme_name = get_static_option_central($theme->slug.'_theme_name'.$lang_suffix) ;
    @endphp
    <option value="{{$theme->slug}}" data-theme_code="{{$theme->slug}}">{{ $theme_name }}</option>
@endforeach
