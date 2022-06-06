<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Role;

class SolicitudesController extends Controller
{
    public function index()
    {
        return view ('admin.posts.solicitudes');
    }
}
