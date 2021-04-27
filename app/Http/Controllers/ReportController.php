<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == 99) {
            $transactions = DB::table('book_transactions')->select('*')->get();
            if (sizeof($transactions)) {
                for ($i = 0; $i < sizeof($transactions); $i++) {
                    $transactions[$i]->book_name = DB::table('books')->where('book_key', $transactions[$i]->book_key)->select('book_name')->first();
                    $user = DB::table('users')->where('user_key', $transactions[$i]->user_key)->select('names', 'email')->first();
                    if ($user) {
                        $transactions[$i]->borrower_name = $user->names;
                        $transactions[$i]->borrower_email = $user->email;
                    } else {
                        $transactions[$i]->borrower_name = "-";
                        $transactions[$i]->borrower_email = "-";
                    }

                    if (isset($transactions[$i]->date_returned)) {
                        $d1 = new Carbon($transactions[$i]->date_returned);
                        $d2 = new Carbon($transactions[$i]->date_borrowed);
                        $d3 = new Carbon($transactions[$i]->date_expected);
                        $days = $d1->diff($d2)->days;
                        $expected = $d2->diff($d3)->days;
                        if ($days >= $expected) {
                            $transactions[$i]->timeline = 'Late';
                        } else {
                            $transactions[$i]->timeline = 'Safe';
                        }
                    } else {
                        $borrowed = new Carbon($transactions[$i]->date_borrowed);
                        $borrowed->addDays(7);
                        $now = Date('Y-m-d h:m:i');
                        if ($now >= $borrowed) {
                            $transactions[$i]->timeline = 'Late';
                        } else {
                            $transactions[$i]->timeline = 'Safe';
                        }
                    }
                }
            }
        } elseif (Auth::user()->type == 0 || Auth::user()->type == 1) {
            $user_id = DB::table('users')->where('user_key', Auth::user()->user_key)->select('user_key')->first();
            $transactions = DB::table('book_transactions')->where('user_key', $user_id->user_key)->select('*')->get();
            if (sizeof($transactions)) {
                for ($i = 0; $i < sizeof($transactions); $i++) {
                    $transactions[$i]->book_name = DB::table('books')->where('book_key', $transactions[$i]->book_key)->select('book_name')->first();
                    $user = DB::table('users')->where('user_key', $transactions[$i]->user_key)->select('names', 'email')->first();
                    if ($user) {
                        $transactions[$i]->borrower_name = $user->names;
                        $transactions[$i]->borrower_email = $user->email;
                    } else {
                        $transactions[$i]->borrower_name = "-";
                        $transactions[$i]->borrower_email = "-";
                    }

                    if (isset($transactions[$i]->date_returned)) {
                        $d1 = new Carbon($transactions[$i]->date_returned);
                        $d2 = new Carbon($transactions[$i]->date_borrowed);
                        $d3 = new Carbon($transactions[$i]->date_expected);
                        $days = $d1->diff($d2)->days;
                        $expected = $d2->diff($d3)->days;
                        if ($days >= $expected) {
                            $transactions[$i]->timeline = 'Late';
                        } else {
                            $transactions[$i]->timeline = 'Safe';
                        }
                    } else {
                        $borrowed = new Carbon($transactions[$i]->date_borrowed);
                        $borrowed->addDays(7);
                        $now = Date('Y-m-d h:m:i');
                        if ($now >= $borrowed) {
                            $transactions[$i]->timeline = 'Late';
                        } else {
                            $transactions[$i]->timeline = 'Safe';
                        }
                    }
                }
            }
        }

        // return $transactions;

        $count = 1;
        return view('report', [
            'transactions' => $transactions,
            'count' => $count
        ]);

        return view('/report');
    }

    public function reportAPI()
    {
        // $transactions = DB::table('book_transactions')->select('*')->get();
        // if (sizeof($transactions)) {
        //     for ($i = 0; $i < sizeof($transactions); $i++) {
        //         $transactions[$i]->book_name = DB::table('books')->where('book_key', $transactions[$i]->book_key)->select('book_name')->first();
        //         $user = DB::table('users')->where('user_key', $transactions[$i]->user_key)->select('names', 'email')->first();
        //         if ($user) {
        //             $transactions[$i]->borrower_name = $user->names;
        //             $transactions[$i]->borrower_email = $user->email;
        //         } else {
        //             $transactions[$i]->borrower_name = "-";
        //             $transactions[$i]->borrower_email = "-";
        //         }

        //         if (isset($transactions[$i]->date_returned)) {
        //             $d1 = new Carbon($transactions[$i]->date_returned);
        //             $d2 = new Carbon($transactions[$i]->date_borrowed);
        //             $d3 = new Carbon($transactions[$i]->date_expected);
        //             $days = $d1->diff($d2)->days;
        //             $expected = $d2->diff($d3)->days;
        //             if ($days >= $expected) {
        //                 $transactions[$i]->timeline = 'Late';
        //             } else {
        //                 $transactions[$i]->timeline = 'Safe';
        //             }
        //         } else {
        //             $borrowed = new Carbon($transactions[$i]->date_borrowed);
        //             $borrowed->addDays(7);
        //             $now = Date('Y-m-d h:m:i');
        //             if ($now >= $borrowed) {
        //                 $transactions[$i]->timeline = 'Late';
        //             } else {
        //                 $transactions[$i]->timeline = 'Safe';
        //             }
        //         }
        //     }
        // }
        $books = DB::table('books')->select('*')->get();
        if (sizeof($books)) {
            for ($i = 0; $i < sizeof($books); $i++) {
                $books[$i]->contents = DB::table('book_contents')->where('book_key', $books[$i]->book_key)->select('book_chapter', 'content')->distinct()->orderBy('book_chapter', 'ASC')->get();
            }
        }
        return response()->json(['books' => $books]);
    }
}
