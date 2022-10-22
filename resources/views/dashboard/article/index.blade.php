@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Articles') }}  | <a href="{{ route('dashboard.article.create') }}" class="btn btn-primary">Add Article</a></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Created at</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ $article->user->name }}</td>
                                <td>{{ $article->created_at}}</td>
                                <td style="display: flex;">
                                    <a href="{{ route('dashboard.article.show', $article->id) }}" class="btn btn-primary m-1">Detail</a>
                                    <form action="{{ route('dashboard.article.delete', $article->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-1" onclick="return confirm('Sure Want Delete?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
