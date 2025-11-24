<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = Auth::user()->conversations()
            ->with(['participants', 'latestMessage.user'])
            ->latest('updated_at')
            ->get();

        $selectedConversation = $conversations->first();

        if ($selectedConversation) {
            $messages = $selectedConversation->messages()
                ->with('user')
                ->latest()
                ->limit(50)
                ->get()
                ->reverse();

            // Mark unread messages as delivered
            $selectedConversation->messages()
                ->where('user_id', '!=', Auth::id())
                ->where('status', 'sent')
                ->update(['status' => 'delivered']);
        } else {
            $messages = collect();
        }

        // 🔹 Build "active users" list (with last message & status)
        $activeUsers = User::where('id', '!=', Auth::id())
            ->with(['messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->get()
            ->map(function($user) {
                $lastMsg = $user->messages->first();

                return (object) [
                    'id'           => $user->id,
                    'name'         => $user->name,
                    'avatar'       => $user->avatar,
                    'status'       => $user->is_online ? 'online' : 'offline',
                    'last_seen'    => $user->last_seen,
                    'last_message' => $lastMsg?->content ?? '',
                    'last_status'  => $lastMsg?->status ?? null,
                ];
            });

        return view('messages.index', [
            'conversations'        => $conversations,
            'selectedConversation' => $selectedConversation,
            'messages'             => $messages,
            'activeUsers'          => $activeUsers,
        ]);
    }

    public function show(Conversation $conversation)
    {
        if (!$conversation->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $conversations = Auth::user()->conversations()
            ->with(['participants', 'latestMessage.user'])
            ->latest('updated_at')
            ->get();

        $messages = $conversation->messages()
            ->with('user')
            ->latest()
            ->limit(50)
            ->get()
            ->reverse();

        // Mark as read
        $conversation->messages()
            ->where('user_id', '!=', Auth::id())
            ->where('status', '!=', 'read')
            ->update(['status' => 'read']);

        // 🔹 Active users same as index
        $activeUsers = User::where('id', '!=', Auth::id())
            ->with(['messages' => function($q) {
                $q->latest()->limit(1);
            }])
            ->get()
            ->map(function($user) {
                $lastMsg = $user->messages->first();

                return (object) [
                    'id'           => $user->id,
                    'name'         => $user->name,
                    'avatar'       => $user->avatar,
                    'status'       => $user->is_online ? 'online' : 'offline',
                    'last_seen'    => $user->last_seen,
                    'last_message' => $lastMsg?->content ?? '',
                    'last_status'  => $lastMsg?->status ?? null,
                ];
            });

        return view('messages.index', [
            'conversations'        => $conversations,
            'selectedConversation' => $conversation,
            'messages'             => $messages,
            'activeUsers'          => $activeUsers,
        ]);
    }

    public function store(Request $request, Conversation $conversation)
    {
        $request->validate([
            'content' => 'nullable|string|max:1000',
            'attachment.*' => 'nullable|file|max:51200',
        ]);

        if (!$conversation->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $message = $conversation->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'status'  => 'sent',
        ]);

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('messages/' . $conversation->id, 'private');

                $message->update([
                    'attachment' => $path,
                    'type' => $file->getClientMimeType(),
                ]);
            }
        }

        $conversation->touch();

        return response()->json([
            'success' => true,
            'message' => $message->load('user'),
        ]);
    }

    public function startConversation(User $user)
    {
        $existingConversation = Auth::user()->conversations()
            ->whereHas('participants', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('type', 'direct')
            ->first();

        if ($existingConversation) {
            return redirect()->route('messages.show', $existingConversation);
        }

        $conversation = Conversation::create(['type' => 'direct']);
        $conversation->participants()->attach([Auth::id(), $user->id]);

        return redirect()->route('messages.show', $conversation);
    }
}
