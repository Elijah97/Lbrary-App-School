<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Models\User;
use App\Models\Book;
use App\Helpers\SystemUtils;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('/books');
    }

    public function shelf()
    {
        $index = 1;
        $books = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            // ->where('book_status', 1)
            ->get();
        return view('/shelf', ['books' => $books, 'index' => $index]);
    }

    public function publicShelf()
    {
        $index = 1;
        $books = DB::table('books')->select('*')->get();
        if (sizeof($books)) {
            for ($i = 0; $i < sizeof($books); $i++) {
                $books[$i]->contents = DB::table('book_contents')->where('book_key', $books[$i]->book_key)->select('book_chapter', 'content')->distinct()->orderBy('book_chapter', 'ASC')->get();
            }
        }
        // return $books;
        return view('/publicShelf', ['books' => $books, 'index' => $index]);
    }

    public function addBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bookName' => 'required',
            'bookId' => 'required',
            'bookAuthor' => 'required',
            'published' => 'required',
            'description' => 'required|max:200',
            'bookShelf' => 'required',
            'bookChapters' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/books')->withErrors($validator)->withInput();
        } else {
            $book =  new Book;
            $book_key = SystemUtils::generateKey(255, false, true);
            $book->book_key = $book_key;
            $book->book_name = $request->input('bookName');
            $book->book_id = $request->input('bookId');
            $book->book_author = $request->input('bookAuthor');
            $book->published = $request->input('published');
            $book->description = $request->input('description');
            $book->book_shelf = $request->input('bookShelf');
            $book->book_chapters = $request->input('bookChapters');
            $book->book_traffic = 0;
            $book->book_status = 1;

            $book->save();
            return redirect('/books')->with('success', 'Book successfully added');
        }
    }
}
