@extends('layouts.master')

@section('title')
    Generate Random Users
@stop

@section('content')
    <h1>Generate Random Users</h1>
@stop

@section('nav')
    <nav class='navbar navbar-default'>
        <ul class='nav navbar-nav'>
            <li><a href='/'>Home</a></li>
            <li><a href='/lorem-ipsum'>Lorem Ipsum Generator</a></li>
            <li class='active'><a href='/user-generator'>User Generator</a></li>
        </ul>
    </nav>
@stop

@section('body')

    <form method='POST' action='/user-generator'>

        {{ csrf_field() }}

        <label for='users'>Number of Users: </label>
        <input type='text' maxlength='2' id='users' name='users' value='{{ old('users')}}'> (Max: 99)
        <br>
        <input type='checkbox' name='birthdate'>
        <label for='birthdate'>Birthdate</label>
        <br>
        <input type='checkbox' name='profile'>
        <label for='profile'>Profile</label>
        <br>

        @if(count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
            </ul>
        @endif

        <input class='btn btn-primary' type='submit' value='Generate Random Users'>
    </form>

    @if(isset($users))
        <section class='user-generator-output'>
            <?php $faker = Faker\Factory::create(); ?>
            @for ($i = 0; $i < $users; $i++)
                <div class='user'>
                    <div class='name'><?php echo $faker->name; ?></div>
                    @if(isset($birthdate))
                        <div class='birthdate'><?php echo $faker->date($format = 'Y-m-d', $max = 'now'); ?></div>
                    @endif
                    @if(isset($profile))
                        <div class='profile'><?php echo $faker->text; ?></div>
                    @endif
                </div>
            @endfor
        </section>
    @endif

@stop
