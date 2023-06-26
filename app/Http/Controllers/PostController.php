<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->is('post')) {
            abort(404);
        }

        $posts =  Post::where('status',1)->latest()->paginate(4);
        return view('posts.index', ['posts'=>$posts, 'pageTitle' => 'Find & Write Blogs']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create', ['pageTitle' => 'Create Blog']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $formfields = $request->validated();
        $formfields['image'] = $request->file('image')->storeAs('images', uniqid('img_').'.jpg', 'public');
        $formfields['user_id'] = Auth::id();
        $formfields['description'] = Purifier::clean($formfields['description']);

        Post::create($formfields);

        return redirect('/')->with('message','Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show',['post'=>$post, 'pageTitle' => 'Blog']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post =  Post::findOrFail($id);
        
        if(Auth::id() != $post->user_id ) {
            abort(404);
        }

        return view('posts.edit',['post' => $post, 'pageTitle' => 'Edit Blog']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post =  Post::findOrFail($id);

        if(Auth::id() != $post->user_id ) {
            abort(403, 'Unauthorized Action');
        }

        $formfields = $request->validated();
        $formfields['description'] = Purifier::clean($formfields['description']);

        if($request->hasFile('image')) {
            $formfields['image'] = $request->image->storeAs('images',uniqId('img_').'.jpg','public'); 
            File::delete('storage/'.$post->image);                       
        }

        $post->update($formfields);

        return redirect('/')->with('message','Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if(Auth::id() != $post->user_id ) {
            abort(403, 'Unauthorized Action');
        }

        $post->delete();
        //File::delete('storage/'.$post->image);

        return redirect('/')->with('message','Post Deleted Successfully!');
    }

    public function manage() 
    {
        $user = Auth::user();
        $posts = $user->posts()->latest()->get();

        return view('posts.manage',['posts'=>$posts, 'pageTitle' => 'Manage Blogs']);
    }
}
