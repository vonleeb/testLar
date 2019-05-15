<?php

Route::get('/', function () {
    return view('main', ['feedbacks' => App\Feedback::all()]);
})->name('main');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/feedback/send', 'FeedbackController@store');
Route::post('/feedback/{id}/delete', 'FeedbackController@delete');