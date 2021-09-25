@extends('layouts.app')

@section('content')

    <div class="card">

        <h4 class="card-header">
            {{ ucfirst($post->title) }}
        </h4>

        <div class="card-body">
            <div class="card-title"><a href="{{route('admin.categories.show', $cat->slug)}}" class="cat">{{ $cat->name }}</a></div>
            <p class="card-text"> {{ $post->content }}</p>
            @if(count($post->tags))
            <footer>
                <div class="tags">
                    Tags:
                    @foreach ($post->tags as $tag)
                        <a href="{{route('admin.tags.show', $tag->slug)}}">{{$tag->name}}</a>
                    @endforeach
                </div>
            </footer>
            @endif
        </div>

    </div>

    <div class="text-right">
        <a href="{{ route('admin.posts.index') }} " class="btn btn-primary px-5 my-3">Go back</a>
    </div>
@endsection