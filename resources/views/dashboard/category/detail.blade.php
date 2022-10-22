@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Category') }}</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4
                        @error('name')
                            has-error
                        @enderror
                        ">
                            <label for="name">Category</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Category"
                                value="{{ old('name', $category->name) }}" aria-describedby="helpId">
                            @error('name')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4
                        @error('name')
                            has-error
                        @enderror
                        ">
                            <label for="name">Author</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Category"
                                value="{{ $category->user->name }}" aria-describedby="helpId" disabled>
                            @error('name')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <a href="{{ route('dashboard.category') }}" class="btn btn-outline-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection