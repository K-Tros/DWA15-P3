<?php

namespace Project3\Http\Controllers;

use Project3\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordGeneratorController extends Controller
{
    /**
    * Responds to requests to GET /password-generator.
    * Returns the default view.
    */
    public function getIndex() {
        return view('password-generator.password-generator');
    }

    /**
     * Responds to requests to POST /password-generator
     */
    public function postGenerate(Request $request) {
        $this->validate($request, [
            'number_of_words' => 'required|numeric|between:1,20'
        ]);

        $number_of_words = $request->input('number_of_words', '3');
        $add_number = $request->input('add_number');
        $add_symbol = $request->input('add_symbol');
        $case = $request->input('case');

        # populate list of words from external page. DOMDocument logic courtesy of http://stackoverflow.com/questions/17638165/get-ul-li-a-string-values-and-store-them-in-a-variable-or-array-php
        $words = [];
        # there are 15 pages to scrape, where the numbers in the url are i and i + 1, so start at i = 1 and increment by 2
        for ($i=1; $i <= 17; $i = $i + 2) {
            # pad numbers for url with a zero if they are single digit
            $first_number = $i < 10 ? '0' . $i : $i;
            $second_number = $i + 1 < 10 ? '0' . ($i + 1) : ($i + 1);
            $html = file_get_contents('http://www.paulnoll.com/Books/Clear-English/words-' . $first_number . '-' . $second_number . '-hundred.html');
            $doc = new \DOMDocument();
            @$doc->loadHTML($html);
            foreach ($doc->getElementsByTagName('li') as $li) {
                $words[] = $li->nodeValue;
            }
        }

        $words_count = count($words);
        $symbols = array('~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '\\', '/', '<', '>', '?', '.', ',', ':', ';');
        $symbols_count = count($symbols);
        $password = '';
        $error = '';

        # build the password into an array
        $temp_array = array_rand($words, $number_of_words);
        foreach ($temp_array as $value) {
            # strip all special characters and white space
            $clean = trim(preg_replace('/[^A-Za-z0-9]/', '', $words[$value]));
            # Check whether to convert to all uppercase or all lowercase, default lowercase
            $clean = $case == 'upper' ? strtoupper($clean) : strtolower($clean);
            $password = $clean . '-' . $password;
        }

        # remove trailing hyphen
        $password = substr($password, 0, -1);

        # add a number if needed
        if (isset($add_number)) {
            $password = $password . rand(0, 9);
        }

        # add a symbol if needed
        if (isset($add_symbol)) {
            $password = $password . $symbols[rand(0, $symbols_count - 1)];
        }

        return view('password-generator.password-generator')->with('password',$password);
    }
}
