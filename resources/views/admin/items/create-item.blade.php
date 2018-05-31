@extends('adminlte::page')

@section('title', 'Create Item')

@section('content')
@include('partials.message')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create Item</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="/{{App::getLocale()}}/admin/items" method="POST" enctype='multipart/form-data'>
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

        <label for="select">((select Categories)) Mutiple select list (hold shift to select more than one):</label>
        <select multiple name="cats[ ]" class="form-control" id="select">
            @foreach(\App\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <label for="select1">((select family)) :</label>
        <select name="family" class="form-control" id="select1">
            @foreach(\App\Family::all() as $family)
            <option value="{{ $family->id }}">{{ $family->title }}</option>
            @endforeach
        </select>

        <br>
        <hr>
        <h3 class="text-center">Arabic</h3>
        <div class="form-group">
            <label for="title_ar">العنوان</label>
            <input name="title_ar" type="text" class="form-control" id="title_ar" placeholder="العنوان" required>
        </div>
        <div class="form-group">
            <label for="description_ar">الوصف</label>
            <textarea id="description_ar" name="description_ar" class="form-control" cols="30" rows="4" placeholder="الوصف" required></textarea>
        </div>
        <div class="form-group">
            <label for="price_ar">السعر</label>
            <input name="price_ar" type="number" class="form-control" id="price_ar" placeholder="السعر" required>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add Item</button>
        </div>
    </form>
</div>
@endsection
