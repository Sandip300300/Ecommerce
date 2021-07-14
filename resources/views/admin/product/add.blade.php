@extends('admin.layout.layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                Add Product
                <div class="clearfix">

                </div>
                <div class="x_content">
                    <form id="demo-form2" action="{{route('product.store')}}" class="form-horizontal form-label-left"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                        Category Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select name="category_id" id="" class="control-label col-md-12 col-xs-12">
                                <option value="">Category Name</option>
                                @foreach ($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                Product Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name"  class="control-label text-left col-md-12 col-xs-12" required="">

                                </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                Product Price<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="price" class="control-label col-md-12 col-xs-12" required="">

                                </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                Product Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="image" class="control-label col-md-12 col-xs-12" required="">

                                </div>

                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="submit" class="btn btn-success" value="Submit" >

                                </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
