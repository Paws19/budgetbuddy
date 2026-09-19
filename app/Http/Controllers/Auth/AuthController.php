<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\UserModel; 
use App\Mail\SMTP\VerificationEmail as VerifyEmail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    //Registration page
    public function registration()
    {
        return view('Auth.registration');
    }

    public function login()
    {
        return view('Auth.login');
    }


    //register user
   public function registerStore(Request $request)
{
    $request->validate([
    'firstName' => 'required|string|max:100',
    'lastName'  => 'required|string|max:100',
    'email'     => 'required|email|unique:account,email',
    'password'  => [
        'required',
        'string',
        'min:8',
        'confirmed',
        'regex:/[a-z]/',      // at least one lowercase
        'regex:/[A-Z]/',      // at least one uppercase
        'regex:/[0-9]/',      // at least one number
        'regex:/[@$!%*#?&]/', // at least one symbol
    ],
    'terms'     => 'accepted',
], [
    'password.regex' => 'Password must contain uppercase, lowercase, a number, and a symbol.',
    'password.min'   => 'Password must be at least 8 characters.',
    'email.unique'   => 'This email is already registered.',
]);

    $verification_code = rand(100000, 999999);
    $expiration = now()->addMinutes(10);

    $user = UserModel::create([
        'first_name'        => $request->firstName,
        'last_name'         => $request->lastName,
        'email'             => $request->email,
        'password'          => bcrypt($request->password),
        'verification_code' => $verification_code,
        'is_verified'       => false,
        'is_active'         => false,
    ]);

    session([
        'user_id'          => $user->id,
        'pending_email'    => $user->email,
        'show_verify_step' => true,
    ]);

    Mail::to($user->email)->send(new VerifyEmail($verification_code, $expiration));

    return redirect()->back();
}

public function verifyCode(Request $request)
{
    $request->validate([
        'code' => 'required|digits:6',
    ]);

    $userId = session('user_id');

    if (!$userId) {
        return redirect()->back()->withErrors([
            'code' => 'Session expired. Please register again.'
        ]);
    }

    $user = UserModel::find($userId);

    // Convert both to string to avoid type mismatch
    if (!$user || (string) $user->verification_code !== (string) $request->code) {
        // Keep the verify step visible
        session(['show_verify_step' => true]);

        return redirect()->back()->withErrors([
            'code' => 'That code doesn’t look right. Please try again.'
        ]);
    }

    // Success - mark as verified
    $user->update([
        'is_verified'       => true,
        'is_active'         => true,
        'verification_code' => null,
    ]);

    // Clear temporary data
    session()->forget(['user_id', 'pending_email', 'show_verify_step']);

    // Show success step
    return redirect()->back()->with('show_success_step', true);
}

//login user
public function loginUser(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    $remember = $request->boolean('remember');

    if (auth()->attempt($credentials, $remember)) {
        $user = auth()->user();

        if (!$user->is_verified) {
            auth()->logout();
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Please verify your email first.']);
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()
        ->withInput($request->only('email'))
        ->withErrors(['email' => 'Invalid email or password.']);
}
}
