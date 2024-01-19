@extends('layouts.layout')

@section('title')
@parent{{ $title }}
@endsection

@section('header')
@parent
@endsection

@section('content')

<div class="container mt-5">
    <h1>New Post Page</h1>

    <h1>Create Post</h1>

    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->

    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="mb-3">

            <label for="title" class="form-label">Title</label>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
        </div>
        <select class="form-select" aria-label="Default select example" id="rubric_id" name="rubric_id">
            <option selected>Выберите рубрику</option>

            @foreach($rubrics as $key => $value)
            <option value="{{ $key }}"> {{ $value }} </option>
            @endforeach

        </select>
        <button class="btn btn-primary mt-3" type="submit">Отправить</button>
    </form>
</div>

@endsection