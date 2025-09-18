
@extends('layout.master')

@section('content')
     
@foreach ($posts as $post )

        <div class="col-3 col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="mb-4">{{ $post->title }}</h2>
                <p>
                  {{ $post->body }}
                </p>
            </div>
        </div>
    </div>
@endforeach

@endsection
