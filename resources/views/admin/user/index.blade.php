@extends('admin.layout.layout')

@section('content')
    @if (Session::has('delete'))

        {{Session::get('delete')}}


    @endif

    <table class="table ">
        <thead>
            <tr>
                <th scope="col">Serial NO</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created Date</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ url('/admin/users' . $user->id) }}" style="font-size:17px;padding:5px"><i
                            class="fa fa-trash"></i></a>

                    </td>
                    {{-- <td>
                        @if ($product->category_id)
                            {{ $product->category->name }}
                        @endif
                    </td>

                    <td>
                        <img style="height: 80px; width:80px;" src="{{ asset('/post/' . $product->image) }}">

                    </td>
                    <td><a href="{{route('product.extraDetails',$product->id)}}" type="button" class="button">Add</a></td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" style="font-size:17px;padding:5px"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ url('/products/delete/' . $product->id) }}" style="font-size:17px;padding:5px"><i
                                class="fa fa-trash"></i></a>
                    </td> --}}
                </tr>

            @endforeach


        </tbody>
    </table>
@endsection
