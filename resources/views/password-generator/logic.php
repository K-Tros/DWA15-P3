<?php
    # TODO maybe add additional options? Camelcase? Max length?

    error_reporting(0);

    # validates number_of_words, throws exception if it is not valid
    function check_number_of_words($number, $word_list_length) {
        if ( !is_numeric($number) ) {
            throw new Exception('Number of Words must be numeric. Showing default length of 3.');
        }
        elseif ($number > $word_list_length) {
            throw new Exception('Number of Words must be less than ' . $word_list_length . '. Showing default length of 3.');
        }
        elseif ($number < 1) {
            throw new Exception('Number of Words must be greater than 0. Showing default length of 3.');
        }
    }

    # gets number_of_words for display
    function get_number_of_words() {
        if (isset($_GET["number_of_words"])) echo 'value=' . $_GET["number_of_words"];
    }

    # gets add_symbol for display
    function get_add_symbol() {
        if (isset($_GET['add_symbol'])) echo 'checked="checked"';
    }

    # gets add_number for display
    function get_add_number() {
        if (isset($_GET['add_number'])) echo 'checked="checked"';
    }

    # gets uppercase for display
    function get_uppercase() {
        if (isset($_GET['case']) && $_GET['case'] == 'upper' ) echo 'checked="checked"';
    }

    # gets lowercase for display
    function get_lowercase() {
        if (isset($_GET['case']) && $_GET['case'] == 'lower' ) echo 'checked="checked"';
    }

    # populate list of words from external page. DOMDocument logic courtesy of http://stackoverflow.com/questions/17638165/get-ul-li-a-string-values-and-store-them-in-a-variable-or-array-php
    $words = [];
    # there are 15 pages to scrape, where the numbers in the url are i and i + 1, so start at i = 1 and increment by 2
    for ($i=1; $i <= 29; $i = $i + 2) {
        # pad numbers for url with a zero if they are single digit
        $first_number = $i < 10 ? '0' . $i : $i;
        $second_number = $i + 1 < 10 ? '0' . ($i + 1) : ($i + 1);
        $html = file_get_contents('http://www.paulnoll.com/Books/Clear-English/words-' . $first_number . '-' . $second_number . '-hundred.html');
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        foreach ($doc->getElementsByTagName('li') as $li) {
            $words[] = $li->nodeValue;
        }
    }

    $words_count = count($words);
    $symbols = array('~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '\\', '/', '<', '>', '?', '.', ',', ':', ';');
    $symbols_count = count($symbols);
    $password = '';
    $error = '';

    # check if we should use the default number of words (3), generate error if invalid
    try {
        $number_of_words = isset($_GET["number_of_words"]) ? $_GET["number_of_words"] : 3;
        check_number_of_words($number_of_words, $words_count);
    } catch (Exception $e) {
        $number_of_words = 3;
        $error = $e->getMessage();
    }

    # build the password into an array
    $temp_array = array_rand($words, $number_of_words);
    foreach ($temp_array as $value) {
        # strip all special characters and white space
        $clean = trim(preg_replace('/[^A-Za-z0-9]/', '', $words[$value]));
        # Check whether to convert to all uppercase or all lowercase, default lowercase
        $clean = $_GET['case'] == 'upper' ? strtoupper($clean) : strtolower($clean);
        $password = $clean . '-' . $password;
    }

    # remove trailing hyphen
    $password = substr($password, 0, -1);

    # add a number if needed
    if (isset($_GET["add_number"])) {
        $password = $password . rand(0, 9);
    }

    # add a symbol if needed
    if (isset($_GET["add_symbol"])) {
        $password = $password . $symbols[rand(0, $symbols_count - 1)];
    }

 ?>
