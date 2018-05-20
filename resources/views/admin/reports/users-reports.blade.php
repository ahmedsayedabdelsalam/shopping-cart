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
                @foreach($SQ as $value)
                <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    {{-- @php // this make lots of queries (wrong)
                        $product_id = \App\Product::where('title', $key)->limit(1)->value('id');
                        if ($product_id) {
                            $product = \App\Product::find($product_id);
                            echo "<a href='/admin/items/" . $product->id . "'>" .  $key . "</a>";
                        } else {
                            echo $key;
                        }
                    @endphp --}}

                    <a href="{{ '/admin/items/' . $value['item']->id }}">
                        {{ $value['item']->title }}
                    </a>

                </td>
                <td>{{ $value['qty'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
