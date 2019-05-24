<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{

  public function __construct(){
    $this->middleware('auth')->except(['returnStoredWord']);
  }

  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('word._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

      $request->validate([
        'longdate' => 'required',
        'word' => 'required',
      ]);

      /* Check if word or date already exist and terminate if does */
      $date_taken = Word::where('longdate', '=', filter_var($request->longdate, FILTER_SANITIZE_STRING))->first();
      $word_taken = Word::where('word', '=', filter_var($request->word, FILTER_SANITIZE_STRING))->first();

      if (is_null($date_taken) && is_null($word_taken)) {

        Word::create([
          'longdate' => $request->longdate,
          'word' => $request->word,
        ]);

        return back()->with(['success' => 'Word '. $request->word .' has been created']);
      } else
        return back()->with(['message' => 'Word '. $request->word .' or Date '. $request->longdate .' is already taken.']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        //
      $words = Word::all();
      return view('word._edit', ['word' => $word, 'words' => $words]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        //
      $word->update($request->only('longdate', 'word'));
//      return response()->json(['W' => $word, 'R' => $request->all()]);
      return redirect()->back()->with(['success' => 'Word Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
      Word::destroy($word->id);
      return back();
    }

    public function returnStoredWord(string $id_date) {
//      $request_date = filter_var($request->all());
      $record = Word::where('longdate', '=', filter_var($id_date, FILTER_SANITIZE_STRING))->first();

      if ($record)
        return response()->json(['date' => $record->longdate, 'word' => $record->word ]);
      else
        return response('No record found', 404);
    }
}
