@extends('adminlte::page')

@section('title', 'Create Category')

@section('content')
@include('partials.message')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Category: {{  $category->title }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/admin/categories/{{ $category->id }}" method="POST" enctype='multipart/form-data'>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" value="{{ $category->title }}" id="title" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Description">{{ $category->description }}</textarea>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit Category</button>
        </div>
    </form>
</div>
@endsection
