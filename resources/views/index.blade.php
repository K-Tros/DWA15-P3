@extends('layouts.master')

@section('nav')
    <nav class='navbar navbar-default'>
        <ul class='nav navbar-nav'>
            <li class='active'><a href='/'>Home</a></li>
            <li><a href='/lorem-ipsum'>Lorem Ipsum Generator</a></li>
            <li><a href='/user-generator'>User Generator</a></li>
        </ul>
    </nav>
@stop

@section('title')
    Welcome to Developer's Best Friend
@stop

@section('content')
    <h1>Welcome to Developer's Best Friend</h1>
    <h2>Lorem Ipsum Generator</h2>
    <blockquote>In publishing and graphic design, lorem ipsum (derived from Latin dolorem ipsum, translated as "pain itself") is a filler text commonly used to demonstrate the graphic elements of a document or visual presentation. Replacing meaningful content with placeholder text allows viewers to focus on graphic aspects such as font, typography, and page layout without being distracted by the content. It also reduces the need for the designer to come up with meaningful text, as they can instead use quickly-generated lorem ipsum.</blockquote>
    <p>Generate some random filler for your application!</p>
    <a href='/lorem-ipsum'>Lorem Ipsum Generator</a>
    <h2>Random User Generator</h2>
    <p>Like lorem ipsum, only with people! Amazing!</p>
    <a href='/user-generator'>User Generator</a>
@stop
