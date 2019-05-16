<?php

Route::get('/', 'FeedbackController@main')->name('main');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/feedback/send', 'FeedbackController@store');
Route::get('/feedback/{id}/delete', 'FeedbackController@delete');