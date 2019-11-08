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
