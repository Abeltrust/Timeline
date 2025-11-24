<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    

    

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show()
{
    return view('auth.verify-email'); // create a view named verify-email.blade.php
}

public function verify(Request $request)
{
    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/home'); // or wherever you want
    }

    if ($request->user()->markEmailAsVerified()) {
        event(new Verified($request->user()));
    }

    return redirect('/home')->with('verified', true);
}

public function resend(Request $request)
{
    if ($request->user()->hasVerifiedEmail()) {
        return redirect('/home');
    }

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
}

}
