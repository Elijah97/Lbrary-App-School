<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Models\User;
use App\Helpers\SystemUtils;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        $index = 1;
        $staffs = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->where('type', 1)
            ->get();
        return view('/staffs', ['staffs' => $staffs, 'index' => $index]);
    }

    function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'email' => 'required|email',
            'staffId' => 'required',
            'address' => 'required',
            'faculty' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/staffs')->withErrors($validator)->withInput();
        } else {
            $password = $this->generateRandomString();
            $staffs =  new User;
            $user_key = SystemUtils::generateKey(255, false, true);
            $staffs->user_key = $user_key;
            $staffs->names = $request->input('names');
            $staffs->email = $request->input('email');
            $staffs->password = bcrypt($password);
            $staffs->userUUID = $request->input('staffId');
            $staffs->address = $request->input('address');
            $staffs->faculty = $request->input('faculty');
            $staffs->type = 1;
            $staffs->status = 1;

            // return $this->generateRandomString();

            $data = array(
                'name' => $request->input('names'),
                'link' => 'http://127.0.0.1:8000',
                'token' => $user_key,
                'email' => $request->input('email'),
                'password' => $password
            );
            $emailData = array(
                'to'        => $request->input('email'),
                'subject'   => 'Library App  account confirmation',
                'view'      => 'emailTemps/account-activate'
            );
            $email = Mail::send($emailData['view'], $data, function ($message) use ($emailData) {
                $message->from('donotreply@alueducation.com', 'Library App');
                $message->to($emailData['to'])->subject($emailData['subject']);
            });

            $staffs->save();
            return redirect('/staffs')->with('success', 'Success; Staff to check her/his account for activation.');
        }
    }
}
