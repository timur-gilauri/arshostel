@php
    $method = $getImageMethod ?? 'getImage';
@endphp
@if(isset($item) && $item->{$method}() && $item->{$method}()->originalFilename())
    <div class="form-group">
        <img src="{{$item->{$method}()->url(isset($url) ? $url : '')}}"
             width="{{isset($width) ? $width : 435}}"
             height="{{isset($height) ? $height : 175}}"/>
    </div>
@endif