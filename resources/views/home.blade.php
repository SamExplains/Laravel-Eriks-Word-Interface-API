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
                <div class="card-header">Word List</div>

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
                          <a href="{{ route('word.edit', $word) }}">
                            <button class="btn btn-danger">Delete</button>
                          </a>
                        </td>
                      </tr>
                    @endforeach

                    </tbody>
                  </table>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
