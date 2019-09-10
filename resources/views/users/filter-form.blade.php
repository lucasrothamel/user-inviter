<form action="{{url("/users")}}" method="get">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                   value="{{ $input["name"] ?? "" }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">E-Mail</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="test@example.com"
                   value="{{ $input["email"] ?? "" }}">
        </div>
    </div>
    <a href="{{"/users"}}" class="btn btn-info">Reset Search</a>
    <button type="submit" class="btn btn-primary">Search!</button>
</form>