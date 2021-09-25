@extends('layouts.app')
@section('title', $tag->name)
@section('content')
<div class="container">
    <h2>{{$tag->name}}</h2>
    <div class="posts-cont row row-cols-3 ">
            @foreach ($tag->posts as $post)

                <div class="col mb-4">
                    <a href="{{route('admin.posts.show', $post->slug)}}"></a>
                    <div class="card">  
                        <h4 class="card-header">
                            {{ ucfirst($post->title) }}
                        </h4>   
                        <div class="card-body">
                            <p class="card-text post-text"> {{ substr($post->content, 0, 160) . '...' }}</p>
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
                </div>

            @endforeach
        
    </div>
    
</div>
@endsection
