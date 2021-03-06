<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase {


    use RefreshDatabase;

    /**
     * @test
     */
    public function is_author_id_is_recorded() {

        Book::create( [

            'title'     => 'some title',
            'author_id' => 1

        ] );
        $this->assertCount( 1, Book::all() );
    }
}
