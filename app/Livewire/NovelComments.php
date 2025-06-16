<?php

namespace App\Livewire;

use App\Models\Novel;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class NovelComments extends Component
{
    use WithPagination;
    public $novel;
    public $content = '';

    protected $paginationTheme = 'tailwind';

    public function mount(Novel $novel)
    {
        $this->novel = $novel;
    }

    public function postComment()
    {
        $this->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'novel_id' => $this->novel->id,
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

        $this->content = '';
        session()->flash('message', 'Komentar berhasil ditambahkan!');
        $this->resetPage();
    }

    public function render()
    {
        $comments = Comment::where('novel_id', $this->novel->id)
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('livewire.novel-comments', compact('comments'));
    }
}
