@if($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<form action="{{url("/posts/new")}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="description">Your message</label>
        <textarea rows=10 class="form-control" aria-describedby="descriptionHelp" id="description"
                  name="description">{{old('description')}}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Add an image</label>
        <input type="file" class="form-control" name="image" id="image" aria-describedby="imageHelp">

        <small id="imageHelp" class="form-text text-muted">Upload an image, optional.
        </small>
    </div>

    <button type="submit" class="btn btn-primary">Publish the message</button>
</form>