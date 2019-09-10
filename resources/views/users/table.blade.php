<table class="table table-striped mt-3">
    <tr>
        <th>Name</th>
        <th>E-Mail</th>
        <th>Date Joined</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{"/users/" . $user->id}}">{{$user->name}}</a>
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at->format("d.m.Y")}}</td>
        </tr>
    @endforeach
</table>