@extends('layouts.admin')

@section('title', 'Gallery')

@section('breadcrumbs', 'Gallery')

@section('css')
    <style>
        .underline:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    {{-- Button to create new gallery item --}}
                    <div class="mb-5 text-right">
                        <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Create New Gallery
                        </a>
                    </div>

                    {{-- Display filter --}}
                    <div class="row mb-3">
                        <div class="col-sm-7">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link p-2 px-3 {{Request::get('status') == NULL ? 'active' : ''}}" href="{{route('gallery.index')}}">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-2 px-3 {{Request::get('status') == 'publish' ?'active' : '' }}" href="{{route('gallery.index', ['status' =>'publish'])}}">Publish</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-2 px-3 {{Request::get('status') == 'draft' ?'active' : '' }}" href="{{route('gallery.index', ['status' =>'draft'])}}">Draft</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-5">
                            <form action="{{route('gallery.index')}}">
                                <div class="input-group">
                                    <input name="keyword" type="text" value="{{Request::get('keyword')}}" class="form-control" placeholder="Filter by title">
                                    <div class="input-group-append">
                                        <input type="submit" value="Filter" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif

                    {{-- Table --}}
                    <table class="table">
                        <thead class="text-light" style="background-color:#33b751 !important">
                            <tr>
                                <th width="160px">Image</th>
                                <th class="">Title</th>
                                <th width="88px">Status</th>
                                <th width="88px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galleries as $gallery)
                                <tr>
                                    <td align="left">
                                        @if($gallery->image)
                                            <img src="{{asset('gallery_images/'.$gallery->image)}}" alt="" width="120px">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" style="color:#00838f;" class="underline">
                                            <span class="d-block">{{ $gallery->alt }}</span>
                                        </a>
                                    </td>
                                    <td class="text-right pr-4">
                                        @if ($gallery->status == 'DRAFT')
                                            <span class="font-italic text-danger">Draft</span>
                                        @elseif($gallery->status == 'PUBLISH')
                                            <span class="font-italic text-success">Published</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.edit', [$gallery->id]) }}" class="btn btn-sm btn-warning text-light" title="Edit"><i class="fa fa-pencil"></i></a>

                                        {{-- Delete Form --}}
                                        <form class="d-inline" method="POST" action="{{ route('gallery.destroy', [$gallery->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{$galleries->appends(Request::all())->links()}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    // If you need to add additional JS functionality like confirmation, you can add here.
</script>
@endsection
