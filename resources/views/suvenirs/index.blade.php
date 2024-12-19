@extends('layouts.admin')

@section('title', 'Suvenirs')

@section('breadcrumbs', 'Suvenirs')

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
          
          {{-- button create --}}
          <div class="mb-5 text-right">
              <a href="{{ route('suvenirs.create') }}" class="btn btn-sm btn-success"> 
                  <i class="fa fa-plus"></i> Create New
              </a>
          </div>

          {{-- display filter --}}
          <div class="row mb-3">
            <div class="col-sm-7">
              <ul class="nav nav-tabs ">
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == NULL ? 'active' : ''}}" href="{{route('suvenirs.index')}}">All</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == 'publish' ?'active' : '' }}" href="{{route('suvenirs.index', ['status' =>'publish'])}}">Publish</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link p-2 px-3 {{Request::get('status') == 'draft' ?'active' : '' }}" href="{{route('suvenirs.index', ['status' =>'draft'])}}">Draft</a>
                  </li>
              </ul>
            </div>
            <div class="col-sm-5">
              <form action="{{route('suvenirs.index')}}">
                  <div class="input-group">
                      <input name="keyword" type="text" value="{{Request::get('keyword')}}" class="form-control" placeholder="Filter by title">
                      <div class="input-group-append">
                          <input type="submit" value="Filter" class="btn btn-info">
                      </div>
                  </div>
              </form>
            </div>
          </div>

          {{-- alert --}}
          @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('success')}}.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
          @endif
          
          {{-- table --}}
          <table class="table">
              <thead class="text-light" style="background-color:#33b751 !important">
                  <tr>
                      <th width="160px">Image</th>
                      <th class="">Title</th>
                      <th width="150px"></th>
                      <th width="88px">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($suvenirs as $index => $suvenir)                            
                      <tr>
                          <td align="left">
                              @if($suvenir->image)
                                  <img src="{{asset('suvenirs_image/'.$suvenir->image)}}" alt="" width="120px">
                              @endif
                          </td>
                          <td>
                              <a href="{{route('suvenirs.edit', [$suvenir->id])}}" style="color:#00838f;" class="underline">
                                  <span class="d-block">{{$suvenir->name}}</span>
                              </a>
                          </td>
                          <td class="text-right pr-4">
                              @if ($suvenir->status=='DRAFT')
                                  <span class="font-italic text-danger">Draft</span>
                              @endif
                          </td>
                          <td>
                              <a href="{{route('suvenirs.edit', [$suvenir->id])}}" class="bnt btn-sm btn-warning text-light" title="Edit"><i class="fa fa-pencil"></i></a>
                              <button class="btn btn-sm btn-danger" onclick="deleteConfirm('{{$suvenir->id}}', '{{$suvenir->title}}')" data-target="#modalDelete" data-toggle="modal"><i class="fa fa-trash"></i></button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
                  {{$suvenirs->appends(Request::all())->links()}}
              </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title d-inline">Delete Suvenir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="message">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="" id="url" method="POST" class="d-inline">
          @csrf 
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </div>
      </div>
      </div>
    </div>
  <!-- End Modal Delete -->

@endsection

@section('script')
  <script>
    function deleteConfirm(id, name){ 
      var url = '{{ route("suvenirs.destroy", ":id") }}';    
          url = url.replace(':id', id);
      document.getElementById("url").setAttribute("action", url);
      document.getElementById('message').innerHTML ="Are you sure you want to delete suvenir <b>"+name+"</b>?"
      $('#modalDelete').modal();
    }

  </script>
@endsection