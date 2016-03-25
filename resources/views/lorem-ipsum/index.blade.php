@extends('layouts.master')


@section('title')
    Generate Lorem Ipsum
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific stylesheets.
--}}
@section('head')
@stop


@section('content')
    <h1>Lorem Ipsum Generator</h1>
@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

    <p>How many paragraphs would you like?</p>

    <form method="POST" action="/Project3/public/lorem-ipsum">

        {{ csrf_field() }}

        <label for="numberOfParagraphs">Paragraphs: </label>
        <input type="text" maxlength="2" id="numberOfParagraphs" name="numberOfParagraphs"> (Max: 99)
        <br>
        <input type="submit" value="Submit">
    </form>

@stop
