@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('breadcrumbs', 'Menus')

@section('second-breadcrumb')
    <li>Edit</li>
@endsection

@section('css')
    <!-- No need for CKEditor anymore -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h3 align="center">Edit Menu</h3>
                    </div>
                    <!-- Form Action Updated to Use 'menu.update' Route -->
                    <form action="{{ route('menu.update', [$menu->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-10">
                            <!-- Tenant Selection -->
                            <div class="mb-4">
                                <label for="tenant_id" class="font-weight-bold">Tenant</label>
                                <select name="tenant_id" class="form-control {{$errors->first('tenant_id') ? "is-invalid" : ""}}" required>
                                    <option value="">Select Tenant</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}" 
                                            {{ $menu->tenant_id == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> {{$errors->first('tenant_id')}}</div>
                            </div>

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="font-weight-bold">Menu Name</label>
                                <input type="text" name="name" placeholder="Menu Name..." class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{$menu->name}}" required>
                                <div class="invalid-feedback"> {{$errors->first('name')}}</div>
                            </div>

                            <!-- Price Field -->
                            <div class="mb-4">
                                <label for="price" class="font-weight-bold">Price</label>
                                <input type="number" name="price" step="0.01" placeholder="Enter Price..." class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" value="{{$menu->price}}" required>
                                <div class="invalid-feedback"> {{$errors->first('price')}}</div>
                            </div>

                            <!-- Description Field (Using Regular Textarea) -->
                            <div class="mb-3">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" name="description" rows="10" cols="50">{{$menu->description}}</textarea>
                                <div class="invalid-feedback"> {{$errors->first('description')}}</div>
                            </div>

                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="image" class="font-weight-bold d-flex">Image</label>
                                @if($menu->image)
                                    <img src="{{ asset('menus_image/'.$menu->image) }}" alt="Menu Image" width="120px">
                                @else   
                                    No Image
                                @endif
                                <input type="file" name="image" class="form-control mt-2">
                                <small class="text-muted">Leave empty if you don't want to change the image.</small>
                            </div>

                            <!-- Save/Publish Buttons -->
                            <div class="mb-3 mt-4">
                                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>
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
    <!-- No need for CKEditor script anymore -->
@endsection
