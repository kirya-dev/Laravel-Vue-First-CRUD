<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.', 'middleware' => 'auth:api'], function () {
    Route::resource('books', 'BookController', ['except' => ['create', 'edit']]);
    Route::resource('authors', 'AuthorController', ['except' => ['create', 'edit']]);
    Route::resource('author-types', 'AuthorTypeController', ['except' => ['create', 'edit']]);
});
