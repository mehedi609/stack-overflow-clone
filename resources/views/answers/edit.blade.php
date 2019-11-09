@extends('layouts.app')

@section('content')
    <div class="container">

      <div class="row justify-content-center mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h1>
                  Editing answer for question: <strong>{{$question->title}}</strong>
                </h1>
                <hr>

                <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">
                  @csrf

                  @method('PATCH')

                  <div class="form-group">
                    <label for="answer-body">Answer Body</label>
                    <textarea class="form-control @error ('body') is-invalid @enderror" name="body" id="answer-body"
                              rows="7">{{old('body', $answer->body)}}</textarea>
                    @error ('body')
                    <div class="invalid-feedback">
                      <strong>{{$message}}</strong>
                    </div>
                    @enderror
                  </div>

                  <button class="btn btn-lg btn-outline-primary" type="submit">Update</button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
@stop
