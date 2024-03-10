@props(['status'])
@php

switch ($status) {
    case 2:
        $bg = "green";
        $text = "NEW";
        break;
    case 3:
        $bg = "red";
        $text = "SALE";
        break;
    case 4:
        $bg = "gray";
        $text = "SOLD";
        break;
    default:
        $bg = "";
        $text = "";
}

@endphp

<div style="background-color:{{ $bg }}; color:white; padding: .2rem .5rem; border-radius:5%; font-size:.5rem">
    {{ $text }}
</div>