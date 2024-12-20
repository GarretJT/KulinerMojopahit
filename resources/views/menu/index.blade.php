@extends('layouts.admin')

@section('title', 'Menu')

@section('breadcrumbs', 'Menu')

@section('css')
  <style>
    .underline:hover{
      text-decoration: underline;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          
          {{-- Button to create new menu item --}}
          <div class="mb-5 text-right">
              <a href="{{ route('menu.create') }}" class="btn btn-sm btn-success"> 
                  <i class="fa fa-plus"></i> Create New Menu Item
              </a>
          </div>

          {{-- Display filter --}}
          <div class="row mb-3">
            <div class="col-sm-7">
              <ul class="nav nav-tabs ">
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == NULL ? 'active' : ''}}" href="{{route('menu.index')}}">All</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == 'publish' ?'active' : '' }}" href="{{route('menu.index', ['status' =>'publish'])}}">Publish</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == 'draft' ?'active' : '' }}" href="{{route('menu.index', ['status' =>'draft'])}}">Draft</a>
                  </li>
              </ul>
            </div>
            <div class="col-sm-5">
              <form action="{{route('menu.index')}}">
                  <div class="input-group">
                      <input name="keyword" type="text" value="{{Request::get('keyword')}}" class="form-control" placeholder="Filter by name">
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
                      <th class="">Name</th>
                      <th width="150px">Price</th>
                      <th width="88px">Status</th>
                      <th width="88px">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($menus as $menu)      
                      <tr>
                          <td align="left">
                              @if($menu->image)
                                  <img src="{{asset('menus_image/'.$menu->image)}}" alt="" width="120px">
                              @endif
                          </td>
                          <td>
                              <a href="{{ route('menu.edit', $menu->id) }}" style="color:#00838f;" class="underline">
                                <span class="d-block">{{$menu->name}}</span>
                            </a>

                          </td>
                          <td>
                              <span class="d-block">${{number_format($menu->price, 2)}}</span>
                          </td>
                          <td class="text-right pr-4">
                              @if ($menu->status == 'DRAFT')
                                  <span class="font-italic text-danger">Draft</span>
                              @elseif($menu->status == 'PUBLISH')
                                  <span class="font-italic text-success">Published</span>
                              @endif
                          </td>
                          <td>
                              <a href="{{route('menu.edit', [$menu->id])}}" class="btn btn-sm btn-warning text-light" title="Edit"><i class="fa fa-pencil"></i></a>

                              {{-- Delete Form --}}
                              <form class="d-inline" method="POST" action="{{ route('menu.destroy', [$menu->id]) }}">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  {{$menus->appends(Request::all())->links()}}
              </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
<script>
    // You can add additional JS functionality for delete confirmation or other features here
</script>
@endsection
