<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\SystemUtils;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // ========= GET FUNCTION =========
    // Login Function

    public function index()
    {
        return view('auth/login');
    }

    public function forgot()
    {
        return view('auth/forgot');
    }

    public function register()
    {
        return view('auth/register');
    }


    // Register Method
    public function adminRegister(Request $request)
    {
        $rules = array(
            'name' => 'required|min:6|max:255',
            'email' => 'required|min:6|email|unique:users',
            'password' => 'required|min:6|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user_key = SystemUtils::generateKey(255, false, true);
            $user->user_key = $user_key;
            $user->names = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->type = 99;
            $user->status = 1;

            $user->save();
            return redirect('/')->with('success', 'Success; Account Successfully created.');
        }
    }

    // The mighty Login Method
    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|min:6|max:255|email',
            'password' => 'required|min:6|max:255'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect('/dashboard');
            } else {
                return redirect('/')->withErrors("Account doesn't exist, not activated yet or incorrect!");
            }
        }
    }

    public function settings()
    {
        return view('/settings');
    }


    public function updateInfo(Request $request)
    {
        $rules = array(
            'names' => 'required|min:6|max:255',
            'address' => 'required|min:2|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $user_key = $request->input("user_key");
            $names = $request->input("names");
            $address = $request->input("address");
            $faculty = $request->input("faculty");
            $update = DB::update("UPDATE users SET names = '$names', address = '$address', faculty = '$faculty' WHERE user_key = '$user_key' ");
            if ($update) {
                return redirect('/settings')->with('success', 'Info successfully Updated');
            }
        }
    }

    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|min:6|same:new-password-confirm',
        ]);

        if ($validator->fails()) {
            return redirect('/students')->withErrors($validator)->withInput();
        } else {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            }
            if (strcmp($request->get('new-password'), $request->get('new-password-confirm')) !== 0) {
                return redirect()->back()->with("error", "Password confirmation doesn't matcg");
            }
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with("success", "Password changed successfully! Changed applied once logout");
        }
    }

    public function userSuspend($userKey)
    {
        $pend = DB::update("UPDATE users SET status = 0 WHERE user_key = '$userKey'");
        if ($pend) {
            return redirect()->back()->with('success', 'User successfully suspended');
        }
    }

    public function userActivate($userKey)
    {
        $pend = DB::update("UPDATE users SET status = 1 WHERE user_key = '$userKey'");
        if ($pend) {
            return redirect()->back()->with('success', 'User successfully suspended');
        }
    }

    public function userDelete($userKey)
    {
        $delete = DB::delete("DELETE FROM users WHERE user_key = '$userKey'");
        if ($delete) {
            return redirect()->back()->with('success', 'User successfully deleted');
        }
    }


    // Logout Method
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
