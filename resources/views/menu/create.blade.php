@extends('layouts.admin')

@section('title', 'Create Menu')

@section('breadcrumbs', 'Menus')

@section('second-breadcrumb')
    <li>Create</li>
@endsection

@section('css')
    <!-- Removed CKEditor script -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <h3 align="center">Create Menu</h3>
                    </div>
                    <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-10">
                            <!-- Tenant selection -->
                            <div class="mb-4">
                                <label for="tenant_id" class="font-weight-bold">Tenant</label>
                                <select name="tenant_id" class="form-control {{$errors->first('tenant_id') ? "is-invalid" : ""}}" required>
                                    <option value="">Select Tenant</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ old('tenant_id') == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->title }}  <!-- Changed from name to title -->
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"> {{$errors->first('tenant_id')}}</div>
                            </div>


                            <!-- Name input -->
                            <div class="mb-4">
                                <label for="name" class="font-weight-bold">Menu Name</label>
                                <input type="text" name="name" placeholder="Menu Name..." class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{ old('name') }}" required>
                                <div class="invalid-feedback"> {{$errors->first('name')}}</div>
                            </div>

                            <!-- Price input -->
                            <div class="mb-4">
                                <label for="price" class="font-weight-bold">Price</label>
                                <input type="number" name="price" placeholder="Enter Price..." class="form-control {{$errors->first('price') ? "is-invalid" : ""}}" value="{{ old('price') }}" required>
                                <div class="invalid-feedback"> {{$errors->first('price')}}</div>
                            </div>

                            <!-- Description input -->
                            <div class="mb-4">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea id="description" class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                                <div class="invalid-feedback"> {{$errors->first('description')}}</div>
                            </div>

                            <!-- Image upload -->
                            <div class="mb-3">
                                <label for="image" class="font-weight-bold">Image</label>
                                <input type="file" name="image" class="form-control {{$errors->first('image') ? "is-invalid" : ""}}">
                                <div class="invalid-feedback"> {{$errors->first('image')}}</div>
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
    <!-- Removed CKEditor script -->
@endsection
