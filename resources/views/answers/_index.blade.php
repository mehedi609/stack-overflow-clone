<div class="row justify-content-center mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>
            {{$answersCount . " " . str_plural('answer', $answersCount)}}
          </h2>
          <hr>

          @foreach ($answers as $answer)

            <div class="media">

              {{--Votes Controls for Answer--}}
              <div class="d-flex flex-column vote-controls">

                {{--Vote Up starts--}}
                <a
                  class="vote-up {{Auth::guest() ? 'off' : ''}}"
                  title="This answer is useful "
                  onclick="
                    event.preventDefault();
                    document.getElementById('vote-up-answer-{{$answer->id}}').submit();
                    "
                >
                  <i class="fas fa-caret-up fa-3x"></i>
                </a>
                <span class="votes-count">{{$answer->votes_count}}</span>
                {{--Vote Up Hiddle form--}}
                <form
                  action="/answers/{{$answer->id}}/vote"
                  method="post"
                  id="vote-up-answer-{{$answer->id}}"
                >
                  @csrf
                  <input type="hidden" name="vote" value="1">
                </form>

                <a
                  class="vote-down {{Auth::guest() ? 'off' : ''}}"
                  title="This answer is not useful"
                  onclick="
                    event.preventDefault();
                    document.getElementById('vote-down-answer-{{$answer->id}}').submit();
                    "
                >
                  <i class="fas fa-caret-down fa-3x"></i>
                </a>
                {{--Vote Down Hiddle form--}}
                <form
                  action="/answers/{{$answer->id}}/vote"
                  method="post"
                  id="vote-down-answer-{{$answer->id}}"
                >
                  @csrf
                  <input type="hidden" name="vote" value="-1">
                </form>

                @can ('accept', $answer)
                  <a href="#" class="{{$answer->status}} mt-2"
                     title="Mark this answer as best answer"
                     onclick="event.preventDefault();
                       document.getElementById('accept-answer-{{$answer->id}}').submit()"
                  >
                    <i class="fas fa-check fa-2x"></i>
                  </a>
                  <form
                    action="{{route('answers.accept', $answer->id)}}"
                    method="post"
                    style="display: none"
                    id="accept-answer-{{$answer->id}}"
                  >
                    @csrf
                  </form>

                  @else
                  @if ($answer->is_best)
                    <a href="#" class="{{$answer->status}} mt-2"
                       title="Question Owner Marked this one as Best Answer"
                    >
                      <i class="fas fa-check fa-2x"></i>
                    </a>
                  @endif
                @endcan
              </div>

              <div class="media-body">
                {!! $answer->body_html !!}

                <div class="row">
                  <div class="col-md-4">

                    {{--Edit and Delete Button & functionality--}}
                    <div class="ml-auto">
                      @can ('update', $answer)
                        <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}"
                           class="btn btn-sm btn-outline-info">
                          Edit
                        </a>
                      @endcan

                      @can ('delete', $answer)
                        <form action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}"
                              style="display: inline"
                              method="post">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                            Delete
                          </button>
                        </form>
                      @endcan
                    </div>
                    {{--EndsEdit and Delete Button & functionality--}}
                  </div>

                  {{--May be filled later--}}
                  <div class="col-md-4"></div>

                  {{--Show avatar and name of user who answered--}}
                  <div class="col-md-4">
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
            </div>
            <hr>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
