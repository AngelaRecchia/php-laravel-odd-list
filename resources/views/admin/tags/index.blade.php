@extends('layouts.app')
@section('title', 'Tags')
@section('content')
<div class="container">
    <h2>All posts by tag</h2>
    <div class="row row-cols-3">
    @foreach($tags as $tag)
        <div class="col">
            <h4 class="my-3"><a href="{{route('admin.tags.show', $tag->slug)}}" class="cat big">{{ $tag->name }}</a></h4>
                @forelse($tag->posts as $post)
                    <h6><a href="{{ route('admin.posts.show', $post->slug)}} ">{{ $post->title}}</a></h6>
                @empty
                    <p>No posts for this tag.</p>
                @endforelse
        </div>
    @endforeach
    </div>
</div>
@endsection
