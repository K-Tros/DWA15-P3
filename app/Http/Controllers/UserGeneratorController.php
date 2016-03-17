<?php

namespace Project3\Http\Controllers;

use Project3\Http\Controllers\Controller;

class UserGeneratorController extends Controller
{
    /**
    * Responds to requests to GET /user-generator.
    * Returns the default view.
    */
    public function getIndex() {
        return 'Default user generator page.';
    }

    /**
     * Responds to requests to POST /user-generator
     */
    public function postGenerate(Request $request) {
        return 'This would respond to the post';
    }
}
