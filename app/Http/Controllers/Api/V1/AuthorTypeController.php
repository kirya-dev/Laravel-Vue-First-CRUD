<?php

namespace App\Http\Controllers\Api\V1;

use App\AuthorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorTypeController extends Controller
{
    public function index()
    {
        return AuthorType::all();
    }

    public function show(AuthorType $type)
    {
        return $type;
    }

    public function store(Request $request)
    {
        $type = new AuthorType;
        $type->fill($request->post())->save();

        return ['status' => 'ok'];
    }

    public function update(Request $request, AuthorType $type)
    {
        $type->fill($request->post())->save();

        return ['status' => 'ok'];
    }

    public function destroy(AuthorType $type)
    {
        $type->delete();

        return ['status' => 'ok'];
    }
}
