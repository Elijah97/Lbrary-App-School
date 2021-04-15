<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\SystemUtils;
use Illuminate\Support\Facades\DB;

class BookContentController extends Controller
{
    public function content()
    {
        $books = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            ->where('book_status', 1)
            ->get();
        return view('/content', ['books' => $books]);
    }

    public function addContent(Request $request)
    {
        $index = 1;
        $book = DB::table('books')
            ->select('books.*')
            ->orderBy('books.id', 'ASC')
            ->where('book_status', 1)
            ->where('book_key', $request->input('bookKey'))
            // ->where('content', '!=', '')
            ->get();

        $contentAvailable = DB::table('books')
            ->join('book_contents', 'books.book_key', '=', 'book_contents.book_key')
            ->select('books.*', 'book_contents.book_chapter', 'book_contents.content')
            ->orderBy('book_contents.book_chapter', 'ASC')
            ->distinct()
            ->where('book_contents.book_key', $request->input('bookKey'))
            ->get();
        // return $contentAvailable;

        return view('/addContent', ['book' => $book, 'contents' => $contentAvailable, 'index' => $index]);
    }

    public function addContentChapter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_chapter' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/addContent')->withErrors($validator)->withInput();
        } else {
            $content_key = SystemUtils::generateKey(255, false, true);
            $addChapter = DB::table('book_contents')->insert([
                'content_key' => $content_key,
                'book_key' => $request->input('book_key'),
                'book_chapter' => $request->input('book_chapter'),
                'content' => $request->input('content'),
                'status' => 1,
            ]);
            return redirect()->back()->with("success", "Book chapter content  successfully added");
        }
    }
}
