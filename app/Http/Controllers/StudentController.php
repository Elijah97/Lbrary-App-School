<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Models\User;
use App\Helpers\SystemUtils;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $index = 1;
        $students = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->where('type', 0)
            ->get();
        return view('/students', ['students' => $students, 'index' => $index]);
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

    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'email' => 'required|email',
            'studentId' => 'required',
            'address' => 'required',
            'faculty' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/students')->withErrors($validator)->withInput();
        } else {
            $password = $this->generateRandomString();
            $student =  new User;
            $user_key = SystemUtils::generateKey(255, false, true);
            $student->user_key = $user_key;
            $student->names = $request->input('names');
            $student->email = $request->input('email');
            $student->password = bcrypt($password);
            $student->userUUID = $request->input('studentId');
            $student->address = $request->input('address');
            $student->faculty = $request->input('faculty');
            $student->year = $request->input('year');
            $student->type = 0;
            $student->status = 1;

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

            $student->save();
            return redirect('/students')->with('success', 'Success; Student to check her/his account for activation.');
        }
    }


    public function downloadSheet()
    {
        Excel::create('studentsTemplate', function ($excel) {
            $excel->sheet('students', function ($sheet) {
                $sheet->loadView('ExportTemplates.studentExportTemplate');
            });
        })->export('xlsx');
    }
}
