<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/results', function () {
    return view('result');
});

Route::get('/competitions/education', function () {
    return view('competitions.education');
});

Route::get('/competitions/sports', function () {
    return view('competitions.sports');
});

Route::get('/competitions/cultural', function () {
    return view('competitions.cultural');
});

Route::get('/educationlearn', function () {
    return view('learn.education');
});

Route::get('/sportslearn', function () {
    return view('learn.sports');
});

Route::get('/culturallearn', function () {
    return view('learn.cultural');
});

Route::get('/terms', function () {
    return view('terms');
});
