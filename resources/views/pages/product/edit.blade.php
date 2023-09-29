@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل  منتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
تعديل منتج
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categorie_id"> Category   : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="categorie_id">
                                <option selected disabled>{{ $product->category->name }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col">
                            <label for="name">Name product</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                        </div>

                    </div>
                    <br>
                    <div class="form-row">

                        <div class="col">
                            <label for="price">price</label>
                            <input type="number" name="price" value="{{ $product->price }}" class="form-control">
                        </div>

                    </div>
                    <br>
                    <div class="form-row">

                        <div class="col">
                            <label for="name">descount_price</label>
                            <input type="number" name="descount_price" value="{{ $product->descount_price }}" class="form-control">
                        </div>

                    </div>
                    <br>
                    <div class="form-row">

                        <div class="col">
                            <label for="name">description</label>
                            <textarea name="description"  id="" cols="30" rows="10">{{ $product->description }}</textarea>
                        </div>

                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <img style="width: 70px; " src="{{URL::asset('attachments/upload_attachments/'.$product->image)}}" alt="">
                                <label for="image">المرفقات : <span class="text-danger">*</span></label>
                                <input type="file" accept="application/image" name="image" required>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">Next</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
