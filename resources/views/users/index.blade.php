@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Find a user!</div>

                    <div class="card-body">
                        <p>Find your friends, and make new friends!</p>

                        @include('users.filter-form', ["input" => $input])

                        @include('users.table', ["users" => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection