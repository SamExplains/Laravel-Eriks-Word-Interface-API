@extends('layouts.app')
@section('content')

  <div class="container">
    <h4>Edit Word</h4>
    <div class="row">

      @if (session()->has('success'))
          <div class="col-8 mx-auto alert-success p-2 mb-2">
            Success! {{ session()->get('success') }}
          </div>
      @endif

      <div class="col-8 mx-auto">
        <a href="{{ route('home') }}">
          Back
        </a>
      </div>

      <div class="col-8 mx-auto mt-4">
        <div class="dropdown">
          <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Switch to another word
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($words as $w)
              <a class="dropdown-item mb-3 mt-3" href="{{ route('word.edit', $w->id) }}"><span class="alert-primary p-2">{{ $w->longdate }}</span> : <b>{{ $w->word }}</b></a>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-8 mx-auto mt-4">
        <form method="POST" action="{{ route('word.update', $word->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="longdate">Date</label>
            <input type="text" class="form-control bg-white" name="longdate" id="longdate" placeholder="YYYY-MM-DD" value="{{ ($word->longdate) ? $word->longdate : old('longdate') }}">
          </div>
          <div class="form-group">
            <label for="word">Word</label>
            <input type="text" class="form-control" name="word" id="word" aria-describedby="Word" placeholder="{{ $word->word }}" value="{{ ($word->word) ? $word->word : old('word') }}">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    /* Flatpickr Date/Time Selector */
    $('#longdate').flatpickr({dateFormat: "Y-m-d" });
  </script>

@endsection