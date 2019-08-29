<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('administrator')->user();

    //dd($users);

    return view('administrator.home');
})->name('home');

