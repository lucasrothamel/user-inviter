@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (isset($message))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Invite a new user!</div>

                    <div class="card-body">
                        <p>Add all your friends, family, co-workers, anybody you know!</p>

                        @include('invite.form')
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Coming soon</div>

                    <div class="card-body">
                        <p>
                            Soon, we will add functionality to add users via:
                        </p>
                        <ul>
                            <li>Twitter</li>
                            <li>Facebook</li>
                            <li>Linked In</li>
                            <li>Upload from your contacts from Google Mail</li>
                            <li>and many more></li>
                        </ul>
                        <p>
                            Check back soon
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection