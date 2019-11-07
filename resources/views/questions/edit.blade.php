@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <div class="d-flex align-items-center">
              <h2>Edit Question</h2>
              <div class="ml-auto">
                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">
                  Back to All Questions
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">

            <form action="{{$question->update}}" method="post">
              @method('PUT')

              {{--Edit Question Form--}}
              @include('questions._form', ['submitButtonValue' => 'Update Question'])

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
