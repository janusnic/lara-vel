<!-- resources/views/components/main/posts/post-card.blade.php -->
@props(['post'])

<div {{ $attributes }}>
    <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
        <div>
            <img class="mx-auto mw-100 rounded-xl" src="{{ $post->getThumbnailUrl() }}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2 gap-x-2">
            @if ($tag = $post->tags->first())
                <x-main.posts.tag-badge :tag="$tag" />
            @endif
            <p class="text-sm text-gray-500">{{ $post->published_at }}</p>
        </div>
        <a wire:navigate href="{{ route('posts.show', $post->slug) }}"
            class="text-xl font-bold text-gray-900">{{ $post->title }}</a>
    </div>
</div>
