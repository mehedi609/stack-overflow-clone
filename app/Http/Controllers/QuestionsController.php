<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (Session::has('success'))
      Alert::success('Done', Session::get('success'));

    $questions = Question::with('user')->latest()->paginate(5);
    return view('questions.index', compact('questions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $question = new Question();
    return view('questions.create', compact('question'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateQuestionRequest $request)
  {
    $request->user()->questions()->create($request->only('title', 'body'));

    return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   */
  public function show(Question $question)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   */
  public function edit(Question $question)
  {
    return view('questions.edit', compact('question'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   */
  public function update(CreateQuestionRequest $request, Question $question)
  {
    $question->update($request->only('title', 'body'));

    return redirect()->route('questions.index')->with('success', 'Your Question has been Updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   */
  public function destroy(Question $question)
  {
    //
  }
}
