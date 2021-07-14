@extends('admin.layout.layout')

@section('content')
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Serial NO</th>
        <th scope="col">Category Name</th>
        <th scope="col"> Parent Category Name</th>
        <th scope="col">Create Date</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key=> $categorie )
        <tr>
            <th >{{$key+1}}</th>
            <td>{{$categorie->name}}</td>
            <td>
                @if ($categorie->category_id)
                    {{$categorie->parent->name}}
                @else
                    No Parent Category
                @endif
            </td>
            <td>{{$categorie->created_at}}</td>
            <td>
                <a href="{{route('category.edit',$categorie->id)}}" style="font-size:17px;padding:5px"><i class="fa fa-edit"></i></a>
                <a href="{{url('/category/delete/'.$categorie->id)}}" style="font-size:17px;padding:5px" ><i class="fa fa-trash"></i></a>
            </td>

          </tr>

        @endforeach


    </tbody>
  </table>
@endsection



