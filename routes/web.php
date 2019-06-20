<?php

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

use App\Word;
use Illuminate\Support\Carbon;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/retrieve/{isodate}', 'WordController@returnStoredWord');
//Route::get('/retrieve/{isodate}', function ($date) {
//
//  $word = Word::find(1);
//
//  return response()->json(['entry' => json_decode(unserialize($word->word_meta), true), 'lexical' => json_decode(unserialize($word->lexi_stat_meta), true)]);
//
//});


Route::resources([
  'word' => 'WordController',
]);