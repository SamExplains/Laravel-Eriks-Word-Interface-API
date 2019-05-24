@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! {{ auth()->user()->name }}
                </div>
            </div>
        </div>

        {{-- Word Dashboard --}}
        <div class="col-12 mt-4">
            <div class="card">
              <div class="card-header">Word List

                <a href="{{ route('word.create') }}">
                  <button class="float-right btn btn-success">+ Add New Word</button>
                </a>

              </div>

                <div class="card-body">

                  <table class="table table-striped text-center">
                    <thead class="bg-light">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Date</th>
                      <th scope="col">Word</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($words)
                      @foreach($words as $word)
                        <tr>
                          <th scope="row">{{ $word->id }}</th>
                          <td>{{ $word->longdate }}</td>
                          <td>{{ $word->word }}</td>
                          <td>
                            <a href="{{ route('word.edit', $word) }}">
                              <button class="btn btn-primary">Edit</button>
                            </a>
                          </td>
                          <td>
                            <form action="{{route('word.destroy', [$word->id] )}}" method="post">
                              @method('DELETE')
                              @csrf {{--  Blade directive token--}}
                              <button type="submit" class="btn btn-danger" onclick="confirm('Are you sure?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach

                      @else

                      <div class="alert-danger p-2">
                        No words found!
                      </div>

                    @endisset

                    </tbody>
                  </table>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
