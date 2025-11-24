<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
        public function photo()
        {
            
        }
         public function show()
        {
            $user = auth()->User()->loadCount([
              //  'stories', 
               // 'lockedIns', 
               // 'taps', 
               // 'lifeChapters'
            ])->load('lifeChapters');

            return view('profile.index', compact('user'));
        }

        public function showUser($user)
        {
            $user = User::withCount([
                    'stories', 
                    'lockedIns', 
                    'taps', 
                    'lifeChapters'
                ])
                ->with('lifeChapters')
                ->where('id', $user)
                ->orWhere('username', $user) // optional if you have usernames
                ->firstOrFail();

            return view('profile.show', compact('user'));
        }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

   public function settings($id)
{
    $user = User::findOrFail($id);

    return view('profile.settings', compact('user'));
}

    public function updateSettings(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Handle POST updates
        if ($request->isMethod('post')) {
            // Update basic info
            if ($request->has('name') || $request->has('email')) {
                $request->validate([
                    'name'  => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                ]);

                $user->update([
                    'name'  => $request->name,
                    'email' => $request->email,
                ]);
            }

            // Handle password change
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);

                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                // Delete old avatar if exists
                if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                    Storage::delete('public/avatars/' . $user->avatar);
                }

                $avatarName = time() . '.' . $request->avatar->extension();
                $request->avatar->storeAs('public/avatars', $avatarName);

                $user->update([
                    'avatar' => $avatarName,
                ]);
            }

            // Handle preferences (e.g., notifications, theme)
            if ($request->has('preferences')) {
                $user->preferences = json_encode($request->preferences);
                $user->save();
            }

            return redirect()->back()->with('success', 'Settings updated successfully.');
        }

        // GET request → show settings page
        return view('profile.settings', compact('user'));
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
