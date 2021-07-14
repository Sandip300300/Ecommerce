@extends('admin.layout.layout')

@section('content')
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">Serial NO</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Extra Details</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if ($product->category_id)
                            {{ $product->category->name }}
                        @endif
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img style="height: 80px; width:80px;" src="{{ asset('/post/' . $product->image) }}">

                    </td>
                    <td><a href="{{route('product.extraDetails',$product->id)}}" type="button" class="button">Add</a></td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" style="font-size:17px;padding:5px"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ url('/products/delete/' . $product->id) }}" style="font-size:17px;padding:5px"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>

            @endforeach


        </tbody>
    </table>
@endsection
