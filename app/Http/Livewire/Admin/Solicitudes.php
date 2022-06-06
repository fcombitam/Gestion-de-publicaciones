<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class Solicitudes extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $posts = Post::where('status', '=','2' )
                            ->where('name','LIKE','%' . $this->search . '%')
                            ->latest('id')
                            ->paginate();



        return view('livewire.admin.solicitudes', compact('posts'));
    }
}
