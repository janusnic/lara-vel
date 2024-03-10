{{-- resources/views/components/main/posts/badge.blade.php --}}
@props(['textColor', 'bgColor'])

<a {{ $attributes }} class="text-white bg-{{ \Illuminate\Support\Str::after($bgColor, '#')}} rounded-xl px-3 py-1 text-base">{{ $slot }} </a>
