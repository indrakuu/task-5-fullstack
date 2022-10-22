@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Article') }}</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-4 @error('title') has-error @enderror">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Category" value="{{ $article->title }}" aria-describedby="helpId" required>
                            @error('title')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4
                        @error('category_id')
                            has-error
                        @enderror
                        ">
                            <label for="category">Category</label>
                            <select class="form-control" name="category_id" id="category" required>
                                <option value="">--- Select Categories --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4
                        @error('content')
                            has-error
                        @enderror
                        ">
                            <label for="image">Image</label>
                            <input type="hidden" name="old_image" value="{{ $article->image }}">
                            <input type="file" class="form-control form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                            @error('image')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                            <img src="{{ asset('storage/' .$article->image) }}" class="d-block mt-2" alt="{{ $article->title }}" width="128">
                        </div>
                        <div class="form-group mb-4
                        @error('content')
                            has-error
                        @enderror
                        
                        ">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" rows="3" required>{{ $article->content }}</textarea>
                            @error('content')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <a href="{{ route('dashboard.article') }}" class="btn btn-outline-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
