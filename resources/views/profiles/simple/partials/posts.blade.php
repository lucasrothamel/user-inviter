<div class="card mt-5">
    <div class="card-header">
        My Posts
        @if (Gate::allows('write-post'))
            &nbsp;&nbsp;
            <a class="btn btn-info" href="{{"/posts/new"}}">
                Write a post!
            </a>
        @endif
    </div>
    <div class="card-body">
        @forelse($posts as $post)
            <div @if (!$loop->first)class="mt-5"@endif>
                @if ($post->type == "text")
                    @include('profiles.simple.partials.text')
                @else
                    @include('profiles.simple.partials.image')
                @endif
            </div>
        @empty
            No posts uploaded yet - start now!
        @endforelse
    </div>
</div>