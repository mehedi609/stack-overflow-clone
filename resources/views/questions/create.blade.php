@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <div class="d-flex align-items-center">
              <h2>All Questions</h2>
              <div class="ml-auto">
                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">
                  Back to All Questions
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">

            <form action="{{route('questions.store')}}" method="post">
              @csrf

              <div class="form-group">
                <label for="question-title">Question Title</label>
                <input type="text"
                       class="form-control @error ('title') is-invalid @enderror" name="title" id="question-title"
                       placeholder="Enter Question Title"
                >
                @error ('title')
                <div class="invalid-feedback">
                  <strong>{{$message}}</strong>
                </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="question-body">Explain your Question</label>
                <textarea class="form-control @error ('body') is-invalid @enderror" name="body" id="question-body"
                          rows="10"></textarea>
                @error ('body')
                <div class="invalid-feedback">
                  <strong>{{$message}}</strong>
                </div>
                @enderror
              </div>

              <button type="submit" class="btn btn-outline-primary btn-lg">Ask this Question</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
