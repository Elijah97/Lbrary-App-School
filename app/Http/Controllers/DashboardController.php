<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            ->where('book_status', 1)
            ->get();

        $students = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->where('type', 0)
            ->get();

        $staffs = DB::table('users')
            ->select('users.*')
            ->orderBy('users.id', 'ASC')
            ->where('type', 1)
            ->get();

        return view('/dashboard', ['books' => $books, 'students' => $students, 'staffs' => $staffs]);
    }
}
