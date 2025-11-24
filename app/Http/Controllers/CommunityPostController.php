<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityPostController extends Controller
{
    /**
     * Store a new post inside a community.
     */
    public function store(Request $request, Community $community)
{
    $request->validate([
        'content' => 'nullable|string|max:2000',
        'image'   => 'nullable|image|mimes:jpg,jpeg,png,gif',
        'video'   => 'nullable|mimes:mp4,mov,avi,webm|max:10240',
        'audio'   => 'nullable|mimes:mp3,wav,ogg|max:5120',
    ]);

    $post = new CommunityPost();
    $post->user_id = Auth::id();
    $post->community_id = $community->id;
    $post->content = $request->content;

    // Handle media uploads
    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('posts/images', 'public');
    }
    if ($request->hasFile('video')) {
        $post->video = $request->file('video')->store('posts/videos', 'public');
    }
    if ($request->hasFile('audio')) {
        $post->audio = $request->file('audio')->store('posts/audio', 'public');
    }

    $post->save();

    return redirect()
        ->route('communities.show', $community->id)
        ->with('success', 'Post created successfully!');
}


    /**
     * Delete a community post (only owner or admin).
     */
    public function destroy(Community $community, CommunityPost $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this post.');
        }

        // Delete media files if exist
        foreach (['image', 'video', 'audio'] as $media) {
            if ($post->$media) {
                Storage::disk('public')->delete($post->$media);
            }
        }

        $post->delete();

        return redirect()
            ->route('communities.show', $community->id)
            ->with('success', 'Post deleted.');
    }

    /**
     * Store a new comment on a post (supports replies).
     */
    public function comment(Request $request, CommunityPost $post)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'community_post_id' => $post->id,
            'user_id' => Auth::id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    /**
     * Delete a comment (only owner).
     */
    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'You are not allowed to delete this comment.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
