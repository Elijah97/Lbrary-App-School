<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\User;
use Validator;
use Redirect;

class TransactionController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->orWhere('type', 1)
            ->orWhere('type', 0)
            ->get();

        $books = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            ->where('book_status', 1)
            ->get();
        return view('/transaction', ['users' => $users, 'books' => $books]);
    }

    public function return()
    {

        $books = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            ->where('book_status', 2)
            ->get();
        return view('/return', ['books' => $books]);
    }

    public function borrowing(Request $request)
    {
        $rules = array(
            'user_key' => 'required',
            'date_expected' => 'required',
            'book_key' => 'required',
        );


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $bookAvailable = Book::where(['book_key' => $request->book_key])->first();
            if ($bookAvailable) {
                $checkUser = User::where(['user_key' => $request->user_key])->first();

                if ($checkUser) {

                    $transaction = DB::table('book_transactions')->insert([
                        'book_key' => $request->input('book_key'),
                        'user_key' => $request->input('user_key'),
                        'date_expected' => $request->input('date_expected'),
                        'date_borrowed' => date('Y-m-d'),
                        'status' => 0,
                    ]);

                    $book = Book::find($bookAvailable->id);
                    $book->book_traffic += 1;
                    $book->book_status = 2;
                    $book->save();

                    return redirect()->back()->with('success', 'Book borrowing successfully recorded');
                } else {
                    return redirect()->back()->withErrors(['User not found in database!'])->withInput();
                }
            }
        }
    }

    public function returning(Request $request)
    {
        // return $request;
        $rules = array(
            'book_key' => 'required',
            'book_condition' => 'required|min:1|max:5',
        );


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $date_returned = date('Y-m-d');
            $book_condition = $request->input("book_condition");
            $book_key = $request->input("book_key");
            $returning = DB::update("UPDATE book_transactions SET book_condition = '$book_condition', date_returned = '$date_returned', status = 1 WHERE book_key = '$book_key' AND status = 0");
            // if ($returning) {
            //     return redirect()->back()->with('success', 'Info successfully Updated');
            // }

            // $updateBook = DB::update("UPDATE books SET book_condition = '$book_condition', date_returned = '$date_returned', status = 1 WHERE book_key = '$book_key' ");
            $checkBook = Book::where(['book_key' => $request->book_key])->first();
            $book = Book::find($checkBook->id);
            $book->book_status = 1;
            $book->save();
            return redirect()->back()->with('success', 'Book return successfully recorded!');
        }
    }
}
