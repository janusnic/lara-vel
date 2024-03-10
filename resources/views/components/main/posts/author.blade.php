{{-- resources/views/components/main/posts/author.blade.php --}}
@props(['author', 'size'])

@php
    
    $imageSize = match ($size ?? null) {
        'xs' => 'w-7 h-7',
        'sm' => 'w-9 h-9',
        'md' => 'w-10 h-10',
        'lg' => 'w-14 h-14',
        default => 'w-10 h-10',
    };
    
    $textSize = match ($size ?? null) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-xl',
        default => 'text-base',
    };
    
@endphp

@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
    <div class="shrink-0 mr-3">
        <img class="h-10 w-10 rounded-full object-cover" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}" />
    </div>
@endif
<span class="mr-1 {{ $textSize }}">{{ $author->name }} </span>
