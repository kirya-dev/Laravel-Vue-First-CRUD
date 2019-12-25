<?php

use App\AuthorType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = factory('App\Author', 5)->create()->all();

        $types = collect(['Автор', 'Соавтор', 'Переводчик', 'Другие'])->map(function ($name) {
            return tap(new AuthorType(compact('name')))->save();
        })->all();

        factory('App\Book', 10)->create()->each(function (\App\Book $book) use (&$authors, &$types) {
            $book->authors()->attach($authors[0], ['author_type_id' => $types[0]['id']]);
            $book->authors()->attach($authors[1], ['author_type_id' => $types[1]['id']]);

            shuffle($authors);
            shuffle($types);
        });
    }
}
