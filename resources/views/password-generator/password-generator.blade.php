@extends('layouts.master')

@section('title')
    Generate Random Password
@stop

@section('content')
    <h1 class='text-center'>Random Password Generator</h1>
@stop

@section('nav')
    <nav class='navbar navbar-default'>
        <ul class='nav navbar-nav'>
            <li><a href='/'>Home</a></li>
            <li><a href='/lorem-ipsum'>Lorem Ipsum Generator</a></li>
            <li><a href='/user-generator'>User Generator</a></li>
            <li class='active'><a href='/password-generator'>Password Generator</a></li>
        </ul>
    </nav>
@stop

@section('body')

    <div class="container text-center">
        <form method='POST' action="/password-generator" class="block input">
            {{ csrf_field() }}
            <p>
                <label for="number_of_words">Number of Words:</label>
                <input type="text" class="form-inline" name="number_of_words" id="number_of_words" value='{{ old('number_of_words')}}'>
                <br>

                <label for="add_symbol">Add Symbol:</label>
                <input type="checkbox" class="form-inline" name="add_symbol" id="add_symbol" value='{{ old('add_symbol')}}'>
                <br>

                <label for="add_number">Add Number:</label>
                <input type="checkbox" class="form-inline" name="add_number" id="add_number" value='{{ old('add_number')}}'>
                <br>

                <label for="uppercase">All Uppercase:</label>
                <input type="radio" name="case" id="uppercase" value="upper">
                <br>

                <label for="lowercase">All Lowercase:</label>
                <input type="radio" name="case" id="lowercase" value="lower">
                <br>
            </p>

            <input type="submit" class="btn btn-primary btn-lg" value="Get a Password!">
            <br>

        </form>

        <p>
            <div class="block password">
                @if(isset($password))
                    <strong><?php echo $password ?></strong>
                @else
                    <strong>random-password-here</strong>
                @endif
            </div>
            <br>
        </p>

        @if(count($errors) > 0)
            <ul class='block error'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </ul>
        @endif

    </div>

@stop
