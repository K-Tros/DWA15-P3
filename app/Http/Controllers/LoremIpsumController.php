<?php

namespace Project3\Http\Controllers;

use Project3\Http\Controllers\Controller;

class LoremIpsumController extends Controller
{
    /**
    * Responds to requests to GET /lorem-ipsum.
    * Returns the default view.
    */
    public function getIndex() {
        return 'Default lorem-ipsum generator page.';
    }

    /**
     * Responds to requests to POST /lorem-ipsum
     */
    public function postGenerate(Request $request) {
        return 'This would respond to the post';
    }
}
