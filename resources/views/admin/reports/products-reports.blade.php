@extends('adminlte::page')

@section('title', 'Products Reports')

@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <table class="table table-bordered table-dark">
            <caption class="text-center">top selling products</caption>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">SQ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($SQ as $key => $value)
                <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    @php
                        $product_id = \App\Product::where('title', $key)->limit(1)->value('id');
                        if ($product_id) {
                            $product = \App\Product::find($product_id);
                            echo "<a href='/admin/items/" . $product->id . "'>" .  $key . "</a>";
                        } else {
                            echo $key;
                        }
                    @endphp
                </td>
                <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
