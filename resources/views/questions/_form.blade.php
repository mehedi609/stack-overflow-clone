@csrf

<div class="form-group">
  <label for="question-title">Question Title</label>
  <input type="text"
         class="form-control @error ('title') is-invalid @enderror" name="title" id="question-title"
         placeholder="Enter Question Title" value="{{old('title', $question->title)}}">

  @error ('title')
  <div class="invalid-feedback">
    <strong>{{$message}}</strong>
  </div>
  @enderror
</div>

<div class="form-group">
  <label for="question-body">Explain your Question</label>
  <textarea class="form-control @error ('body') is-invalid @enderror" name="body" id="question-body"
            rows="10" placeholder="Describe your Question">{{old('body', $question->body)}}</textarea>

  @error ('body')
  <div class="invalid-feedback">
    <strong>{{$message}}</strong>
  </div>
  @enderror
</div>

<button type="submit" class="btn btn-outline-primary btn-lg">{{$submitButtonValue}}</button>
