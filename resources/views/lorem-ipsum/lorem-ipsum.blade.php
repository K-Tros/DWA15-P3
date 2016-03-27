@extends('layouts.master')

@section('title')
    Generate Lorem Ipsum
@stop

@section('content')
    <h1>Lorem Ipsum Generator</h1>
@stop

@section('nav')
    <nav class='navbar navbar-default'>
        <ul class='nav navbar-nav'>
            <li><a href='/'>Home</a></li>
            <li class='active'><a href='/lorem-ipsum'>Lorem Ipsum Generator</a></li>
            <li><a href='/user-generator'>User Generator</a></li>
            <li><a href='/password-generator'>Password Generator</a></li>
        </ul>
    </nav>
@stop

@section('body')

    <p>How many paragraphs would you like?</p>

    <form method='POST' action='/lorem-ipsum'>

        {{ csrf_field() }}

        <label for='paragraphs'>Paragraphs: </label>
        <input type='text' maxlength='2' id='paragraphs' name='paragraphs' value='{{ old('paragraphs')}}'> (Max: 99)
        <br>

        @if(count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </ul>
        @endif

        <input class='btn btn-primary' type='submit' value='Generate Lorem Ipsum'>
    </form>

    @if(isset($paragraphs))
        <section class='lorem-ipsum-output'>
            <?php
                $generator = new Badcow\LoremIpsum\Generator();
                $generatedParagraphs = $generator->getParagraphs($paragraphs);
                // Extra p tag needed because implode doesn't add the first one
                echo '<p>' . implode('<p>', $generatedParagraphs);
            ?>
        </section>
    @endif

@stop
