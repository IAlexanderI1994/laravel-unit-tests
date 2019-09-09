<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller {

    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'title'  => 'required|string',
            'author' => 'required|string'
        ] );

        if ( $validator->fails() ) {
            return response( [
                'errors' => $validator->errors()
            ], 400 );
        }

        Book::create( $validator->validated() );

    }

    public function update( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'title'  => 'required|string',
            'author' => 'required|string'
        ] );

        $book = Book::find( $request->book );

        $book->update( $validator->validated() );

    }

}
