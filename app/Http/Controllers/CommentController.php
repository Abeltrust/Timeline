<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommunityPost; //
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $post = CommunityPost::findOrFail($postId);

        $comment = new Comment([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        // attach via polymorphic relation
        $post->comments()->save($comment);

        return back()->with('success', 'Comment added!');
    }
}

