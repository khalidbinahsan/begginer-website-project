@extends('Layout.app')
@section('content')
<div class="container d-none" id="services-list">
    <div class="row">
    <div class="col-md-12 p-5">
    <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="service_table">
        {{-- All services data will appear here. Getting by axios.js from custom.js file --}}
      </tbody>
    </table>
    
    </div>
    </div>
    </div>
    {{-- Page Loader --}}
    <div class="container" id="page-loader" style="height: 99vh">
      <div class="row align-items-center h-100">
        <div class="col-md-12 text-center p-5">
          <img src="{{asset('images/loading.svg')}}" alt="svg-file">
        </div>
      </div>
    </div>
    {{-- Data empty --}}
    <div class="container d-none" id="something-wrng" style="height: 100vh">
      <div class="row h-100 align-items-center">
        <div class="col-md-12 text-center p-5">
          <h3 style="color: red">Something went wrong.....</h3>
        </div>
      </div>
    </div>
    {{-- Data Delete Modal --}}
    <div id="myModal" class="modal fade">
      <div class="modal-dialog modal-confirm">
        <div class="modal-content">
          <div class="modal-header flex-column">
            <div class="icon-box">
              <i class="fas fa-xmark"></i>
            </div>						
            <h4 class="modal-title w-100">Are you sure?</h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Do you really want to delete these records? This process cannot be undone.</p>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div> 
@endsection


@section('script')
<script type="text/javascript">
getServicesData()
</script>
@endsection