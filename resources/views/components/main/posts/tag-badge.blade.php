{{-- resources/views/components/main/posts/tag-badge.blade.php --}}
@props(['tag'])
<a wire:navigate href="{{ route('posts.index', ['tag' => $tag->slug]) }}" class="text-white bg-{{ \Illuminate\Support\Str::after($tag->bg_color ?? 'ef4444', '#')}} rounded-xl px-3 py-1 text-base">{{ $tag->name }}</a>
