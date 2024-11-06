@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h1>Welcome to the RSS Aggregator</h1>
            <p class="lead">Stay updated by following your favorite blogs and websites all in one place.</p>

            @auth
                <p>You're logged in! Explore your feeds.</p>
                <a href="{{ route('feeds.index') }}" class="btn btn-primary">View Your Feeds</a>
            @else
                <p>Don't have an account? Create one now and start adding feeds!</p>
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endauth
        </div>
    </div>
@endsection
