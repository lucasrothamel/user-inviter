<div class="card">
    <div class="card-header">User Profile: <b>{{$user->name}}</b></div>

    <div class="card-body">
        <h3 class="mt-3">Invitations Summary:</h3>
        <dl class="row">
            <dt class="col-sm-3">Successful</dt>
            <dd class="col-sm-9">
                {{count($data["successful"])}}
            </dd>

            <dt class="col-sm-3">Pending</dt>
            <dd class="col-sm-9">
                {{count($data["pending"])}}
            </dd>
        </dl>

        <h3 class="mt-3">Key Data:</h3>
        <dl class="row">
            <dt class="col-sm-3">E-Mail</dt>
            <dd class="col-sm-9">
                {{$user->email}}
            </dd>

            <dt class="col-sm-3">Joined</dt>
            <dd class="col-sm-9">
                {{$user->created_at->format("d.m.Y H:i")}}
            </dd>
        </dl>
    </div>
</div>