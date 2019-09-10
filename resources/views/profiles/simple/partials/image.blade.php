Posted at {{$post->created_at->format("d.m.Y H:i")}} - {{$post->filename}}<br>

@if($post->description)
    {{$post->description}}<br>
@endif

<img src="{{$post->image_url}}" class="img-fluid" id="post-image-{{$post->id}}">