@extends('adminlte::page')

@section('title', 'Create Item')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Item</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/admin/items" method="POST" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="box-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" class="form-control" id="price" placeholder="Price" required>
        </div>
        <div class="form-group">
            <label for="image">Image input</label>
            <input name="image" type="file" id="image">
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add Item</button>
        </div>
    </form>
</div>
@endsection
