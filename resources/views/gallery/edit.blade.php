@extends('layouts.admin')

@section('title', 'Edit Gallery')

@section('breadcrumbs', 'Edit Gallery')

@section('second-breadcrumb')
    <li>Edit</li>
@endsection

@section('css')
    <!-- Add any custom CSS if needed -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h3 align="center">Edit Gallery</h3>
                    </div>
                    <form action="{{ route('gallery.update', [$gallery->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-10">

                            <!-- Alt input -->
                            <div class="mb-4">
                                <label for="alt" class="font-weight-bold">Alt Text</label>
                                <input type="text" name="alt" placeholder="Alt Text..." class="form-control {{$errors->first('alt') ? "is-invalid" : ""}}" value="{{ old('alt', $gallery->alt) }}" required>
                                <div class="invalid-feedback"> {{$errors->first('alt')}}</div>
                            </div>

                            <!-- Image upload -->
                            <div class="mb-3">
                                <label for="image" class="font-weight-bold">Image</label>
                                @if($gallery->image)
                                    <img src="{{ asset('gallery_image/'.$gallery->image) }}" alt="Gallery Image" width="120px">
                                @else
                                    <p>No image available</p>
                                @endif
                                <input type="file" name="image" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">
                                <div class="invalid-feedback"> {{$errors->first('image')}}</div>
                                <small class="text-muted">Leave empty if you don't want to change the image.</small>
                            </div>

                            <!-- Save buttons -->
                            <div class="mb-3 mt-4">
                                <button class="btn btn-secondary" type="submit" name="save_action" value="DRAFT">Save as Draft</button>
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
    <!-- Add any custom scripts if needed -->
@endsection
