@php
    $color="";
@endphp

@if($type == 'info')
    @php $color = 'blue'; @endphp
@elseif($type == 'warning')
    @php $color = 'orange'; @endphp
@elseif($type == 'danger')
    @php $color = 'red'; @endphp
@elseif($type == 'success')
    @php $color = 'green'; @endphp
@endif

<div {{ $attributes->merge(['class' => 'bg-'.$color.'-500 text-sm text-white rounded-md p-4']) }} role="alert">
    {{ $message }}
</div>