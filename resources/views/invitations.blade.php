@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Invitations</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Invited By</th>
                                <th>Name</th>
                                <th>Date</th>
                            </tr>
                            @foreach($invitations as $invitation)
                                <tr>
                                    <td>{{$invitation->userInvited->name}}</td>
                                    <td>{{$invitation->userCreated->name ?? "not yet signed up"}}</td>
                                    <td>{{$invitation->created_at->format("d.m.Y H:i")}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection