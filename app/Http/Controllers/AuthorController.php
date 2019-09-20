<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller {
    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'name' => 'required|string',
            'dob'  => 'required'
        ] );

        if ( $validator->fails() ) {
            return response( [
                'errors' => $validator->errors()
            ], 400 );
        }

        $newAuthor = Author::create( $validator->validated() );

        return response( $newAuthor );
    }
}
