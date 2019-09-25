<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    //
    protected $guarded = [];

    public function path() {
        return "/books/{$this->id}";
    }


    public function setAuthorAttribute( $author ) {

        $this->attributes['author_id'] = Author::firstOrCreate( [ 'name' => $author ] )->id;
    }
}
