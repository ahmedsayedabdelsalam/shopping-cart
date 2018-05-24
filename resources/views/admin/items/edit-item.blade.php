@extends('adminlte::page')

@section('title', 'Edit Item')

@section('content')
@include('partials.message')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Item: <strong>{{ $product->title }}</strong></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/admin/items/{{ $product->id }}" method="POST" enctype='multipart/form-data'>
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <div class="box-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" value="{{ $product->title }}" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Description" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" class="form-control" id="price"  value="{{ $product->price }}" placeholder="Price" required>
        </div>
        <div class="form-group">
            <label for="image">Image input</label>
            <input name="image" type="file" id="image">
        </div>

        <label for="select">((select Categories)) Mutiple select list (hold shift to select more than one):</label>
        <select multiple name="cats[ ]" class="form-control" id="select">
            @foreach(\App\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Edit Item</button>
        </div>
    </form>
</div>
@endsection
