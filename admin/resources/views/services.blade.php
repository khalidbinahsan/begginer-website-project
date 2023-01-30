@extends('Layout.app')
@section('content')
<div class="container d-none" id="services-list">
    <div class="row">
    <div class="col-md-12 p-5">
      <button class="btn btn-primary my-3" id="add-new-btn">Add New</button>
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
    {{-- Add New Modal --}}
     <div class="modal fade" id="add-new-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewModalLabel">Add New Services</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100">
              <!-- Service Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addName" class="form-control" />
                <label class="form-label" for="addName">Service Name</label>
              </div>

              <!-- Service Description  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addDescription" class="form-control" />
                <label class="form-label" for="addDescription">Description</label>
              </div>

              <!-- Service Image Link -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addimageLink" class="form-control" />
                <label class="form-label" for="addimageLink">Image Link</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" id="addNew" class="btn btn-primary add-btn">Add</button>
          </div>
        </div>
      </div>
    </div>
    {{-- End Add New Modal --}}
    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Services</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100 d-none">
              <!-- Service Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="serviceName" class="form-control" />
                <label class="form-label" for="serviceName">Service Name</label>
              </div>

              <!-- Service Description  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="serviceDescription" class="form-control" />
                <label class="form-label" for="serviceDescription">Description</label>
              </div>

              <!-- Service Image Link -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="imageLink" class="form-control" />
                <label class="form-label" for="imageLink">Image Link</label>
              </div>
            </div>

              {{-- data Loader --}}
              <div class="container" id="data-loader" style="height: 99vh">
                <div class="row align-items-center h-100">
                  <div class="col-md-12 text-center p-5">
                    <img src="{{asset('images/loading.svg')}}" alt="svg-file">
                  </div>
                </div>
              </div>

              {{-- Data empty --}}
              <div class="container d-none" id="something-wrng2" style="height: 100vh">
                <div class="row h-100 align-items-center">
                  <div class="col-md-12 text-center p-5">
                    <h3 style="color: red">Something went wrong.....</h3>
                  </div>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" id="saveCng" class="btn btn-primary saveChange-btn">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Services</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="modal-icon mb-2"><div><img src="{{asset('images/close.gif')}}" alt="" width="80"></div></div>
            <h5 class="modal-title" id="deleteModalLabel">Are you sure want to delete this?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary service-dlt-btn" data-id=" ">Delete</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Success Toasts Design --}}
    <div id="success-notifications" class="toast fade bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body">
        <img src="{{asset('images\check animation.gif')}}" alt="" width="30">
        <h5 class="ml-2">Delete Successfull</h5>
      </div>
    </div>

    {{-- Error Toast Design --}}
    <div id="error-notifications" class="toast fade bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body">
        <img src="{{asset('images\error.gif')}}" alt="" width="30">
        <h5 class="ml-2 error-msg">Delete Fail</h5>
      </div>
    </div>
    
@endsection


@section('script')
<script type="text/javascript">
getServicesData()
</script>
@endsection