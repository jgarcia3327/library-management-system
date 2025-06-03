<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function token()
    {
        return csrf_token();
    }

    public function store(Request $request) 
    {
        $numCopy = empty($request->number_of_copy) && is_numeric($request->number_of_copy)? 1 : $request->number_of_copy;
        while($numCopy > 0) {
            Book::create([
                'admin_id' => $request->admin_id,
                'isbn' => $request->isbn,
                'title' => $request->title
            ]);
            $numCopy--;
        }
        
        if(!empty($request->authors) && is_array($request->authors)) {
            foreach($request->authors AS $v) {
                // Create new author and link book
                if (empty($v['author_id'])){
                    $author = Author::create([
                        'first_name' => $v['first_name'],
                        'last_name' => $v['last_name']
                    ]);
                    BookAuthor::create([
                        'book_isbn' => $request->isbn,
                        'author_id' => $author->id
                    ]);
                }
                else {
                    // link book
                    BookAuthor::create([
                        'book_isbn' => $request->isbn,
                        'author_id' => $v['author_id']
                    ]);
                }
            }
        }
    }
}
