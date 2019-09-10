<form action="{{url("/invite")}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="invites">Email addresses</label>
        <textarea rows=10 class="form-control" aria-describedby="invitesHelp" id="invites">

        </textarea>

        <small id="invitesHelp" class="form-text text-muted">You can enter multiple addresses, on new lines, or
            separated by comma or semicolon.
        </small>
    </div>

    <div class="form-group">
        <label for="invitesText">Personal invitation</label>
        <textarea rows=10 class="form-control" aria-describedby="invitesTextHelp" id="invitesText">
Hello {user},

Check out this really cool new social network i joined, where you can share
images and text news with me, and all your friends!

Regards,
{{auth()->user()->name}}
</textarea>

        <small id="invitesTextHelp" class="form-text text-muted">
            This is the invitation we send on your behalf. Change it, and make it more personal!
        </small>
    </div>

    <button type="submit" class="btn btn-primary">Send invitations</button>
</form>