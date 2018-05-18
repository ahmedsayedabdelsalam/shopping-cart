@extends('adminlte::page')

@section('title', 'Create Category')

@section('content')
@include('partials.message')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Category</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/admin/categories" method="POST" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="box-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Description"></textarea>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
    </form>
</div>
@endsection
