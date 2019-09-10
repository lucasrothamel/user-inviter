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

                        You are logged in!

                        <h3 class="mt-3">Your Invitations Summary:</h3>
                        <dl class="row">
                            <dt class="col-sm-3">Successful</dt>
                            <dd class="col-sm-9">
                                {{count($successful)}}
                            </dd>

                            <dt class="col-sm-3">Pending</dt>
                            <dd class="col-sm-9">
                                {{count($pending)}}
                            </dd>
                        </dl>

                        <a href="{{url("/invite")}}" class="btn btn-dark">
                            Invite somebody!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @include('partials.invitations.list', ["invitations" => $successful, "title" => "My recent successful invitations"])
        @include('partials.invitations.list', ["invitations" => $pending, "title" => "My pending invitations"])
    </div>
@endsection
