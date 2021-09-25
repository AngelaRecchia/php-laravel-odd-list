@extends('layouts.app')

@section('content')

    <div class="container">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-3">

              <input type="text" name="title" class="form-control" id="titolo" value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-3">
                <select class="form-control" name="cat_id" id="category">
                    @foreach($categories as $category)                      
                        <option value="{{ $category->id }}"
                            @if($category->id == old('cat_id', $post->cat_id)) 
                            selected 
                            @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
              <textarea name="content" id="descr" cols="30" rows="15" class="form-control">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">

                        <label for="tag . {{$loop->iteration}}" class="form-check-label">{{$tag->name}}</label>

                        <input type="checkbox" value="{{$tag->id}}" class="form-check-input ms-2" id="tag . {{$loop->iteration}} " name="tags[]"
                        @if(!$errors->any() && $post->tags->contains($tag->id)) 
                        checked
                        @elseif(in_array($tag->id, old('tags', [])))
                        checked
                        @endif>   
                    </div> 
                @endforeach
                
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror         
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary px-5 my-3">Edit</button>
            </div>
            
          </form>
    </div>
@endsection