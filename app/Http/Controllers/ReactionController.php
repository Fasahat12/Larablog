<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reaction' => 'required|in:like,dislike,funny,insightful'
        ]);

        return Reaction::updateOrCreate([
                                    'post_id' => $request->input('post_id'),
                                    'user_id' => $request->input('user_id'),
                                ],$request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $postId, string $userId,)
    {
        $reaction = Reaction::where('post_id',$postId)->where('user_id',$userId)->firstOrFail();

        return $reaction->delete();
    }
}
