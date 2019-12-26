<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('authors', 'authors.pivot.authorType')->get()->mapInto(BookResource::class);
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    public function store(Request $request)
    {
        $book = new Book;
        $book->fill($request->post())->save();

        foreach ($request->post('authors') as $author) {
            $book->authors()->attach($author['pivot']['author_id'], Arr::only($author['pivot'], 'author_type_id'));
        }

        return ['status' => 'ok'];
    }

    public function update(Request $request, Book $book)
    {
        $book->fill($request->post())->save();

        $book->authors()->detach();
        foreach ($request->post('authors') as $author) {
            $book->authors()->attach($author['pivot']['author_id'], Arr::only($author['pivot'], 'author_type_id'));
        }

        return ['status' => 'ok'];
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return ['status' => 'ok'];
    }
}
