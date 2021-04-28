<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\user_permissions;
use Session;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        // if(explode("@", $user->email)[1] !== 'washk12.org'){
        //     return redirect()->to('/');
        // }

        // only allow users with existing permissions to log in
        $permissions = user_permissions::where('email',$user->email)->get();
        if(!$permissions||sizeof($permissions)==0){
            // do things for users with no explicit permissions
            return redirect()->route('login')->with('logged_out', 'Sorry, you are not authorized to access this application. If you believe this is an error, please contact the Business Department.');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->save();
            auth()->login($newUser);
            auth()->user()->avatar = $user->avatar;
        }
        return redirect()->to('/');
    }

    public function logout()
    {
        session()->flush();
        session()->flash('logged_out', 'You have been logged out successfully.');
        return redirect()->route('login')->with('logged_out', 'You have been logged out of this application successfully. Please note that you are still logged into your Google account. For added security, or if this is not your machine, please sign out of your Google account as well.');
    }
}
