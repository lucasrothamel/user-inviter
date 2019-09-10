@extends('layouts.app')

@section('content')
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('profiles.simple.partials.key_data')

                @include('profiles.simple.partials.posts', ["posts" => $user->posts])
            </div>
        </div>
    </div>
@endsection