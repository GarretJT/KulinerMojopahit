@extends('layouts.admin')

@section('title', 'Suvenir')

@section('breadcrumbs', 'Edit Suvenir')

@section('second-breadcrumb')
    <li>Edit</li>
@endsection

@section('css')
    <script src="/templateEditor/ckeditor/ckeditor.js"></script> 
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h3 align="center"></h3>
                    </div>
                    <form action="{{route('suvenirs.update', [$suvenir->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-10">
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" placeholder="Suvenir Name..." class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{$suvenir->name}}" required>
                                <div class="invalid-feedback"> {{$errors->first('name')}}</div>
                            </div>

                            <!-- Short Description Field (Using CKEditor) -->
                            <div class="mb-3">
                                <label for="short_description" class="font-weight-bold">Short Description</label>
                                <textarea id="short_description" class="form-control ckeditor {{$errors->first('short_description') ? "is-invalid" : ""}}" name="short_description" rows="10" cols="50">{{$suvenir->short_description}}</textarea>
                                <div class="invalid-feedback"> {{$errors->first('short_description')}}</div>
                            </div>

                            <!-- Price Field -->
                            <div class="mb-3">
                                <label for="price" class="font-weight-bold">Price</label>
                                <input type="number" name="price" step="0.01" class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" value="{{$suvenir->price}}" required>
                                <div class="invalid-feedback"> {{$errors->first('price')}}</div>
                            </div>

                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="image" class="font-weight-bold d-flex">Image</label>
                                @if($suvenir->image)
                                    <img src="{{asset('suvenirs_image/'.$suvenir->image)}}" alt="Suvenir Image" width="120px">
                                @else   
                                    No Image
                                @endif
                                <input type="file" name="image" class="form-control mt-2" >
                                <small class="text-muted">Leave empty if you don't want to change the image.</small>
                            </div>
                            
                            <!-- Save/Publish Buttons -->
                            <div class="mb-3 mt-4">
                                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
                                <button class="btn btn-success" name="save_action" value="PUBLISH">Publish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- ckeditor --}}
    <script>
        CKEDITOR.replace('short_description', {
            filebrowserUploadUrl: "{{route('articles.upload', ['_token' => csrf_token()])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
