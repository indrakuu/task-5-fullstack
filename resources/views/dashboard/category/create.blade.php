@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Category') }}</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.category.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="name">Category</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                placeholder="category">
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