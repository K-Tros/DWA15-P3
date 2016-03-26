<?php

namespace Project3\Http\Controllers;

use Project3\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserGeneratorController extends Controller
{
    /**
    * Responds to requests to GET /user-generator.
    * Returns the default view.
    */
    public function getIndex() {
        return view('user-generator.user-generator');
    }

    /**
     * Responds to requests to POST /user-generator
     */
    public function postGenerate(Request $request) {
        $this->validate($request, [
            'users' => 'required|numeric|between:1,99'
        ]);

        $users = $request->input('users', '0');
        $birthdate = $request->input('birthdate');
        $profile = $request->input('profile');

        return view('user-generator.user-generator', ['users' => $users, 'birthdate' => $birthdate, 'profile' => $profile]);
    }
}
