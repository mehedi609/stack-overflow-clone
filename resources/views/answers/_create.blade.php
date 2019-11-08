<div class="row justify-content-center mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3>
            Your Answer
          </h3>
          <hr>

          <form action="{{route('questions.answers.store', $question->id)}}" method="post">
            @csrf

            <div class="form-group">
              <label for="answer-body">Answer Body</label>
              <textarea class="form-control @error ('body') is-invalid @enderror" name="body" id="answer-body"
                        rows="7"></textarea>
            @error ('body')
              <div class="invalid-feedback">
                <strong>{{$message}}</strong>
              </div>
            @enderror
            </div>

            <button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
