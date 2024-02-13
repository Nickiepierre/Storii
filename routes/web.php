<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('welcome');
})->name('/');
Route::get('emails-sent', function () {
     return view('emails-sent');
})->name('emails-sent');
Route::get('emails', function () {
     return view('emails');
})->name('emails');
Route::post('emails-get','App\Http\Controllers\EmailsController@emails_get')->name('emails-get');
Route::post('create-emails','App\Http\Controllers\EmailsController@create_emails')->name('create-emails');
Route::post('emails-sent-get','App\Http\Controllers\SendEmailsController@emails_sent_get')->name('emails-sent-get');
Route::post('send-emails','App\Http\Controllers\SendEmailsController@send_emails')->name('send-emails');
Route::get('unsubscribe','App\Http\Controllers\EmailsController@unsubscribe')->name('unsubscribe');