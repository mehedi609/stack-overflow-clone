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
                <a href="#"
                   class="favorite mt-2 {{Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '')}}"
                   title="Click to mark as favorite question (click again to undo)"
                   onclick="event.preventDefault();
                   document.getElementById('favorite-question-{{$question->id}}').submit()"
                >
                  <i class="fas fa-star fa-2x"></i>
                  <span class="favorites-count">{{$question->favorites_count}}</span>
                </a>
                <form
                  action="/questions/{{$question->id}}/favorites"
                  method="post"
                  style="display:none;"
                  id="favorite-question-{{$question->id}}"
                >
                  @csrf
                  @if ($question->is_favorited)
                      @method('DELETE')
                  @endif

                </form>
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
    @include('answers._index', ['answersCount' => $question->answers_count, 'answers' => $question->answers])

    @include('answers._create')
  </div>
@endsection
