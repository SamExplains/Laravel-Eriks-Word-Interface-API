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
    public function index(Request $request)
    {
      return response()->json(['A' => 'Hello']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
