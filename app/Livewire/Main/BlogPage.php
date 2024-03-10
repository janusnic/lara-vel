<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
// use Livewire\Attributes\Title;
use App\Models\{Post, Tag};
use App\Enums\PostStatus;
use Livewire\WithPagination;
// use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Builder;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;

#[Title('Blog page')]
#[Layout('layouts.main')]
class BlogPage extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $tag = '';

    #[Url()]
    public $popular = false;

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->tag = '';
        $this->resetPage();
    }

    #[Computed()]
    public function posts()
    {
        return Post::published()
            ->with('user', 'tags')
            ->when($this->activeTag, function ($query) {
                $query->withTag($this->tag);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->search($this->search)
            ->orderBy('updated_at', $this->sort)
            ->paginate(3);
    }

    #[Computed()]
    public function activeTag()
    {
        if ($this->tag === null || $this->tag === '') {
            return null;
        }

        return Tag::where('slug', $this->tag)->first();
    }


    public function render()
    {
        return view('livewire.main.blog-page');
    }
}
