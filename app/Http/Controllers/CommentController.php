<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,Blog $blog){
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        comment::create([
            'user_id' => Auth::id(),
            'blog_id'=> $blog->id,
            'body'=> $request->body,
            ]);

         return redirect()->back()->with('success', 'Comment posted.');
    }
    public function update(Request $request, Comment $comment)
{
    // Authorization: Only the owner can update
    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $comment->body = $request->body;
    $comment->save();

    return redirect()->back()->with('success', 'Comment updated.');
}
   public function destroy(Comment $comment)
{
    // Authorization: Only the owner can delete
    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Unauthorized');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted.');
}
}
