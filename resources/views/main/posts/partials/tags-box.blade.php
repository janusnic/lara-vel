{{-- resources/views/main/posts/partials/tags-box.blade.php --}}
<div>
    <h3 class="mb-3 text-lg font-semibold text-gray-900">Recommended topics</h3>
    <div class="flex flex-wrap justify-start gap-2 topics">
        @foreach ($tags as $tag)
            <x-main.posts.tag-badge :tag="$tag" />
        @endforeach
    </div>
</div>
