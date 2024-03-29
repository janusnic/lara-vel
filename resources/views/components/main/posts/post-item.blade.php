<!-- resources/views/components/main/posts/post-item.blade.php -->
@props(['post'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="grid items-start grid-cols-12 gap-3 mt-5 article-body">
        <div class="flex items-center col-span-4 article-thumbnail">
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                <img class="mx-auto mw-100 rounded-xl" src="{{ $post->getThumbnailUrl() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="flex items-center py-1 text-sm article-meta">
                <x-main.posts.author :author="$post->user" size="xs" />
                <span class="text-xs text-gray-500">. {{ $post->updated_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h2>

            <p class="mt-2 text-base font-light text-gray-700">
                {{ $post->getExcerpt() }}
            </p>
            <div class="flex items-center justify-between mt-6 article-actions-bar">
                <div class="flex gap-x-2">
                    @foreach ($post->tags as $tag)
                        <x-main.posts.tag-badge :tag="$tag" />
                    @endforeach
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ $post->getReadingTime() }}
                             min. read</span>
                    </div>
                </div>
                <div>
                    <livewire:main.like-button :key="'like-' . $post->id" :$post />
                </div>
            </div>
        </div>
    </div>
</article>

