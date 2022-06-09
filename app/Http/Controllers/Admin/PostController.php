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
use App\Models\PostUser;

use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Role;

class PostController extends Controller
{

    use WithPagination;

    public function __construct(){
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
        $this->middleware('can:admin.posts.create')->only('create','store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::pluck('name','id');
        $tags = Tag::all();

        

        return view ('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {


        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url'=> $url
            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', compact('post'))->with('info', 'Se agrego Correctamente');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post,Role $role)
    {
        
        //PREGUNTAR : $this->authorize('author',$post);
        $categories = Category::pluck('name','id');
        $tags = Tag::all();

        //$user = auth()->user();

        //$user->posts()->attach($post->id);

        //$favorites->users()->attach($post->id);

        //return $favorites;

        return view ('admin.posts.edit', compact('post','categories','tags'));
    }

    public function editable(Post $post,Role $role)
    {
        
        $categories = Category::pluck('name','id');
        $tags = Tag::all();

        

        return view ('admin.posts.editable', compact('post','categories','tags'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        

        $post->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url'=>$url
                ]);
            }else{
                $post->image()->create([
                    'url'=>$url
                ]);
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index', $post)->with('info','Actualizacion completada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        //$this->authorize('author',$post);

        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('info','Se elimino correctamente');
    }

    public function favorites(Post $post,Role $role)
    {
        $user = auth()->user();

        $posts = $user->favorites('user_id','post_id')->paginate();

        return view ('admin.posts.favorites', compact('posts'));
    }

    public function eliminate(Post $post)
    {
   
        $post->favorites()->delete();

        return redirect()->route('admin.posts.index')->with('info','Se elimino correctamente');
    }
}
