@extends('layouts.admin')

@section('title', 'Create Suvenir')

@section('breadcrumbs', 'Suvenirs' )

@section('second-breadcrumb')
    <li>Create</li>
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
                        <h3 align="center">Create Suvenir</h3>
                    </div>
                    <form action="{{route('suvenirs.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-10">
                            <div class="mb-4">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" placeholder="Suvenir Name..." class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{old('name')}}" required>
                                <div class="invalid-feedback"> {{$errors->first('name')}}</div>
                            </div>
                            <div class="mb-4">
                                <label for="short_description" class="font-weight-bold">Short Description</label>
                                <textarea id="short_description" class="form-control" name="short_description" rows="4" required>{{old('short_description')}}</textarea>
                                <div class="invalid-feedback"> {{$errors->first('short_description')}}</div>
                            </div>
                            <div class="mb-4">
                                <label for="price" class="font-weight-bold">Price</label>
                                <input type="number" name="price" placeholder="Enter Price..." class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" value="{{old('price')}}" required>
                                <div class="invalid-feedback"> {{$errors->first('price')}}</div>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="font-weight-bold">Image</label>
                                <input type="file" name="image" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}" required>
                                <div class="invalid-feedback"> {{$errors->first('image')}}</div>
                            </div>
                            <div class="mb-3 mt-4">
                                <button class="btn btn-secondary" type="submit" name="save_action" value="DRAFT">Save as draft</button>
                                <button class="btn btn-success" type="submit" name="save_action" value="PUBLISH">Publish</button>
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
            filebrowserUploadUrl    : "{{route('suvenirs.upload', ['_token' => csrf_token()])}}",
            filebrowserUploadMethod : 'form'
        });
    </script>
@endsection
