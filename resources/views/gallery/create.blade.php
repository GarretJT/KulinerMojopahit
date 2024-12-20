@extends('layouts.admin')

@section('title', 'Create Gallery')

@section('breadcrumbs', 'Gallery')

@section('second-breadcrumb')
    <li>Create</li>
@endsection

@section('css')
    <!-- Additional styles if needed -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h3 align="center">Create Gallery</h3>
                    </div>
                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="font-weight-bold">Image</label>
                            <input type="file" name="image" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}" required>
                            <div class="invalid-feedback"> {{ $errors->first('image') }}</div>
                        </div>

                        <!-- Alt Text Input -->
                        <div class="mb-4">
                            <label for="alt" class="font-weight-bold">Alt Text</label>
                            <input type="text" name="alt" placeholder="Alt Text..." class="form-control {{ $errors->first('alt') ? 'is-invalid' : '' }}" value="{{ old('alt') }}" required>
                            <div class="invalid-feedback"> {{ $errors->first('alt') }}</div>
                        </div>

                        <!-- Save Buttons -->
                        <div class="mb-3 mt-4">
                            <button class="btn btn-secondary" type="submit" name="save_action" value="DRAFT">Save as Draft</button>
                            <button class="btn btn-success" type="submit" name="save_action" value="PUBLISH">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Additional scripts if needed -->
@endsection
