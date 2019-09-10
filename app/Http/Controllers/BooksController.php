<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller {

    public function store( Request $request ) {

        $validator = $this->validateRequest( $request );

        if ( $validator->fails() ) {
            return response( [
                'errors' => $validator->errors()
            ], 400 );
        }

        Book::create( $this->validateRequest( $request )->validated() );

    }

    public function update( Request $request ) {


        $book = Book::find( $request->book );

        $book->update( $this->validateRequest( $request )->validated() );

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRequest( Request $request ): \Illuminate\Contracts\Validation\Validator {
        return Validator::make( $request->all(), [
            'title'  => 'required|string',
            'author' => 'required|string'
        ] );
    }

}
