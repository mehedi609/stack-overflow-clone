<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index', 'show']]);
  }
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
    if (Session::has('success'))
      Alert::success('Done', Session::get('success'));

    $question->increment('views');
    return view('questions.show', compact('question'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function edit(Question $question)
  {
    /*if (Gate::denies('update-question', $question))
      abort(403, 'Access Denied');*/
    $this->authorize('update', $question);

    return view('questions.edit', compact('question'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function update(CreateQuestionRequest $request, Question $question)
  {
    /*if (Gate::denies('update-question', $question))
      abort(403, 'Access Denied');*/
    $this->authorize('update', $question);

    $question->update($request->only('title', 'body'));

    return redirect()->route('questions.index')->with('success', 'Your Question has been Updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Question $question
   * @return \Illuminate\Http\Response
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function destroy(Question $question)
  {
    /*if (Gate::denies('delete-question', $question))
      abort(403, 'Access Denied');*/

    $this->authorize('delete', $question);

    $question->delete();

    return redirect()->route('questions.index')->with('success', 'Your question has been deleted');
  }
}
