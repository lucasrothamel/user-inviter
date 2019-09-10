@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Write a post!</div>

                    <div class="card-body">
                        <p>Share a message and/or an image!</p>
                        @include('posts.create.partials.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection