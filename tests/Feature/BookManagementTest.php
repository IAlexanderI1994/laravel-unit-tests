<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase {

    use RefreshDatabase;


    /**
     * @test
     */
    public function a_book_can_be_added_to_the_library() {

        $this->withoutExceptionHandling();

        $response = $this->post( '/books', [
            'title'  => 'Book title',
            'author' => 'Alex'
        ] );
        $response->assertOk();

        $this->assertCount( 1, Book::all() );
    }

    /**
     * @test
     */
    public function a_title_is_required() {

        $this->withoutExceptionHandling();


        $response = $this->post( '/books', [
            'title'  => '',
            'author' => 'Alex'
        ] );


        //var_dump( $response->content() );
        $response->assertJsonValidationErrors( 'title' );
        $response->assertStatus( 400 );


    }

    /**
     * @test
     */
    public function a_author_is_required() {

        $this->withoutExceptionHandling();


        $response = $this->post( '/books', [
            'title'  => 'Best title',
            'author' => ''
        ] );


        //var_dump( $response->content() );
        $response->assertJsonValidationErrors( 'author' );
        $response->assertStatus( 400 );


    }

    /**
     * @test
     */
    public function a_book_can_be_updated() {

        $this->withoutExceptionHandling();

        $this->post( '/books', [
            'title'  => 'Book title',
            'author' => 'Alex'
        ] );

        $book = Book::first();

        $this->patch( "/books/{$book->id}", [
            'title'  => 'New Book title',
            'author' => 'Ivan'
        ] );
        $this->assertEquals( 'New Book title', Book::first()->title );
        $this->assertEquals( 'Ivan', Book::first()->author );


    }

    /**
     * @test
     */
    public function a_book_can_be_deleted() {
        $this->withoutExceptionHandling();

        $this->post( '/books', [
            'title'  => 'Book title',
            'author' => 'Alex'
        ] );

        $this->assertCount( 1, Book::all() );

        $book = Book::first();

        $this->delete( "/books/{$book->id}" );

        $this->assertCount( 0, Book::all() );


    }


}

