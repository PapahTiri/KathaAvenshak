<?php

namespace App\Livewire;

use App\Models\Novel;
use Livewire\Component;

class NovelViews extends Component
{
    public $novelId;
    public $views;

    public function mount($novelId)
    {
        $novel = Novel::findOrFail($novelId);
        $novel->increment('views');
        $this->views = $novel->views;
    }
    
    public function render()
    {
        return view('livewire.novel-views');
    }
}
