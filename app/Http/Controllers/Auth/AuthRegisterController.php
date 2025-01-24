<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class AuthRegisterController extends Controller
{

    public function redirectToProvider($provider)
    {
        // dd($provider);
        return Socialite::driver($provider)->redirect();
    }
     // Handle callback
     public function handleProviderCallback($provider)
     {
        // dd($provider);
         try {
             $socialUser = Socialite::driver($provider)->user();
            //  dd($socialUser);
             $user = User::where('provider_id', $socialUser->getId())->first();
 
             if (!$user) {
                 $user = User::create([
                     'name' => $socialUser->getName(),
                     'email' => $socialUser->getEmail(),
                     'provider' => $provider,
                     'provider_id' => $socialUser->getId(),
                     $user->usertype = 'user',
                 ]);
             }
 
             Auth::login($user);
 
             return redirect('/dashboard');
         } catch (\Exception $e) {
             return redirect('/login')->withErrors(['message' => 'Unable to login, try again later.']);
         }
     }
     public function AuthRegister(Request $request)
     {
         // Validate the request data
         $validatedData = $request->validate([
             'name' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required|confirmed|min:6',
         ]);
     
         // Create and store the user
         $user = new User;
         $user->name = $validatedData['name'];
         $user->email = $validatedData['email'];
         $user->password = bcrypt($validatedData['password']);
         $user->usertype = 'user'; 
         $user->save();
     
         // Attempt to log the user in
         if (Auth::attempt(['email' => $user->email, 'password' => $validatedData['password']])) {
             $user = auth()->user();
             return response()->json([
                 'user' => $user,
                 'user_type' => $user->usertype 
             ], 200);
         } else {
             return response()->json(['message' => 'Invalid email or password'], 401);
         }
     }
     

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            // dd($user->usertype);
            return response()->json([
                'user' => $user,
                'user_type' => $user->usertype 
            ], 200);
        } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
    }
    

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'Logged out successfully']);
}


public function GetUserInfo() {
    // dd('yes');
    $userInfo = Auth::user();
    if ($userInfo) {
        return response()->json($userInfo);
    } else {
        return response()->json(['status' => 'notlogin'], 401);
    }
}


}
