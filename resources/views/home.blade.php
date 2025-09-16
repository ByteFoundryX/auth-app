@extends('layout.master')

@section('content')
           @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
             @endif
    <div class="col-12 col-md-10">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="mb-4">Authentication || webprog.io</h2>
                <p>
                    Lorem ipsum, dolor sit amet consectetur
                    adipisicing elit. Labore accusamus perferendis
                    commodi, mollitia magnam, nostrum est culpa
                    alias accusantium numquam, eius cumque quam
                    vero? Praesentium magnam sunt quasi eos
                    distinctio?
                </p>
            </div>
        </div>
    </div>
@endsection
