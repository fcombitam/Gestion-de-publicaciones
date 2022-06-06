<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Livewire\WithPagination;

use Spatie\Permission\Models\Role;

class UsersIndex extends Component
{

    use WithPagination;

    public $search;


    protected $paginationTheme='bootstrap';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $users = User::where('name','LIKE','%' . $this->search . '%')
                    ->orWhere('email','LIKE','%' . $this->search . '%')
                    ->latest('id')
                    ->paginate();
        return view('livewire.admin.users-index', compact('users'));
    }
}
