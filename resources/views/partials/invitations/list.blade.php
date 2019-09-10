<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{$title ?? "My Invitations"}}</div>

            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Method
                        </th>
                        <th>Date</th>
                        @if (isset($invitations[0]->user_created_id))
                            <th></th>
                        @endif
                    </tr>
                    @forelse($invitations as $invitation)
                        <tr>
                            <td>
                                @if ($invitation->user_created_id != null)
                                    <a href="{{url("/users/" . $invitation->user_created_id)}}">{{$invitation->name}}</a>
                                @else
                                    {{$invitation->name}}
                                @endif
                            </td>
                            <td>{{$invitation->method->name}}</td>
                            <td>{{$invitation->created_at->format("d.m.Y H:i")}}</td>

                            @if ($invitation->user_created_id != null)
                                <td><a href="{{url("/chat/" . $invitation->user_created_id)}}">Start a chat!</a></td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                You have not invited anybody yet! Invite somebody now!
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>