<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param Question $question
   * @param \Illuminate\Http\Request $request
   * @return void
   */
  public function store(Question $question, Request $request)
  {
    $request->validate([
      'body' => 'required'
    ]);

    $question->answers()->create([
      'body' => $request->body,
      'user_id' => Auth::id()
    ]);

    return back()->with('success', "Your answer has been submitted successfully");
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Question $question
   * @param \App\Answer $answer
   * @return \Illuminate\Http\Response
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function edit(Question $question, Answer $answer)
  {
    $this->authorize('update', $answer);

    return view('answers.edit', compact('answer', 'question'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param Question $question
   * @param \App\Answer $answer
   * @return void
   */
  public function update(Request $request, Question $question, Answer $answer)
  {
    $this->authorize('update', $answer);

    $request->validate([
      'body' => 'required'
    ]);

    $answer->update($request->only('body'));

    return redirect()
      ->route('questions.show', $question->slug)
      ->with('success', 'Your answer has been updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Question $question
   * @param \App\Answer $answer
   * @return void
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function destroy(Question $question, Answer $answer)
  {
    $this->authorize('delete', $answer);

    $answer->delete();

    return back()->with('success', 'Your answer has been deleted');
  }
}
