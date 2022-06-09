<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\PostUser;

class Favorites extends Component
{
     use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $posts = Post::where('user_id', auth()->user()->id)->paginate();



        return view('livewire.admin.favorites', compact('posts'));
    }
}
