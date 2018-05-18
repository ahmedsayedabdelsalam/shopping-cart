@extends('adminlte::page')

@section('title', 'Category Details')

@section('content')
@include('partials.message')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $category->title }}</h3>

        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        {{ $category->description }}
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a href="/admin/categories/{{ $category->id }}/edit" class="text-center center-block btn btn-info">Edit Category</a>
        <form action="/admin/categories/{{ $category->id }}" method="POST" >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger center-block form-control">Delete Category</button>
          </form>
    </div>
    <!-- /.box-footer-->
</div>
@endsection
