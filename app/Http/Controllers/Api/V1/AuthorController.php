<?php

namespace App\Http\Controllers\Api\V1;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function show(Author $author)
    {
        return $author;
    }

    public function store(Request $request)
    {
        $author = new Author;
        $author->fill($request->post())->save();

        return ['status' => 'ok'];
    }

    public function update(Request $request, Author $author)
    {
        $author->fill($request->post())->save();

        return ['status' => 'ok'];
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return ['status' => 'ok'];
    }
}
