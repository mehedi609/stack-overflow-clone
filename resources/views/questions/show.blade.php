@extends('layouts.app')

@section('content')
  <div class="container">
    {{--Show Question--}}
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">

              <div class="d-flex align-items-center">
                <h1>{{$question->title}}</h1>
                <div class="ml-auto">
                  <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">
                    Back to All Questions
                  </a>
                </div>
              </div>
            </div>

            <hr>

            <div class="media">

              {{--Votes Controls--}}
              <div class="d-flex flex-column vote-controls">
                <a href="#" class="vote-up" title="This question is useful">
                  <i class="fas fa-caret-up fa-3x"></i>
                </a>
                <span class="votes-count">1230</span>
                <a href="#" class="vote-down off" title="This question is not useful">
                  <i class="fas fa-caret-down fa-3x"></i>
                </a>
                <a href="#" class="favorite mt-2 favorited"
                   title="Click to mark as favorite question (click again to undo)">
                  <i class="fas fa-star fa-2x"></i>
                  <span class="favorites-count">123</span>
                </a>
              </div>

              <div class="media-body">
                {!! $question->body_html !!}

                <div class="float-right">
                        <span class="text-muted">
                          Asked {{$question->created_date}}
                        </span>

                  <div class="media mt-2">
                    <a href="{{$question->user->url}}" class="pr-2">
                      <img src="{{$question->user->avatar}}" alt="user_avatar">
                    </a>

                    <div class="media-body mt-1">
                      <a href="{{$question->user->url}}">
                        {{$question->user->name}}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{--Show Answers related to that question--}}
    <div class="row justify-content-center mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h2>
                {{$question->answers_count . " " . str_plural('answer', $question->answers_count)}}
              </h2>
              <hr>

              @foreach ($question->answers as $answer)

                <div class="media">

                  {{--Votes Controls for Answer--}}
                  <div class="d-flex flex-column vote-controls">
                    <a href="#" class="vote-up" title="This answer is useful">
                      <i class="fas fa-caret-up fa-3x"></i>
                    </a>
                    <span class="votes-count">1230</span>
                    <a href="#" class="vote-down off" title="This answer is not useful">
                      <i class="fas fa-caret-down fa-3x"></i>
                    </a>
                    <a href="#" class="vote-accepted mt-2"
                       title="Mark this answer as best answer">
                      <i class="fas fa-check fa-2x"></i>
                    </a>
                  </div>

                  <div class="media-body">
                    {!! $answer->body_html !!}

                    <div class="float-right">
                      <span class="text-muted">
                        Answered {{$answer->created_date}}
                      </span>

                      <div class="media mt-2">
                        <a href="{{$answer->user->url}}" class="pr-2">
                          <img src="{{$answer->user->avatar}}" alt="user_avatar">
                        </a>

                        <div class="media-body mt-1">
                          <a href="{{$answer->user->url}}">
                            {{$answer->user->name}}
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
