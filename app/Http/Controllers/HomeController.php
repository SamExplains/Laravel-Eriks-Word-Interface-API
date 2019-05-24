<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      /* Grab all words */
      $words = Word::all()->values();

        return view('home', compact('words'));
    }

    public function welcome(){
      return view('welcome');
    }
}
