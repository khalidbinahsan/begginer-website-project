@extends('Layout.app')
@section('content')
<div class="container d-none" id="review-list">
    <div class="row">
    <div class="col-md-12 p-5">
    <button class="btn btn-primary my-3" id="add-new-review">Add New</button>
    <table id="reviewTableContainer" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Feedback</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="review_table">
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
     <div class="modal fade" id="add-new-review-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewModalLabel">Add New Review</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100">
              <!-- Project Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addClientName" class="form-control" />
                <label class="form-label" for="addClientName">Client Name</label>
              </div>

              <!-- Project Description  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addFeedback" class="form-control" />
                <label class="form-label" for="addFeedback">Feedback</label>
              </div>

              <!-- Project Image Link -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="clientPhoto" class="form-control" />
                <label class="form-label" for="clientPhoto">Client Photo</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" id="addNewReview" class="btn btn-primary add-btn">Add</button>
          </div>
        </div>
      </div>
    </div>
    {{-- End Add New Modal --}}
    {{-- Edit Modal --}}
    <div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Review</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100 d-none">
              <!-- Client Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="edit-client-name" class="form-control" />
                <label class="form-label" for="edit-client-name">Client Name</label>
              </div>

              <!-- Client Feedback  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="edit-client-feedback" class="form-control" />
                <label class="form-label" for="edit-client-feedback">Client Feedback</label>
              </div>

              <!-- Client Photo  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="edit-client-photo" class="form-control" />
                <label class="form-label" for="edit-client-photo">Client Photo</label>
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
            <button type="button" id="reviewUpdate" class="btn btn-primary saveChange-btn" data-id=''>Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="delete-review-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Review</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="modal-icon mb-2"><div><img src="{{asset('images/close.gif')}}" alt="" width="80"></div></div>
            <h5 class="modal-title" id="deleteModalLabel">Are you sure want to delete this?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary review-dlt-btn" data-id=" ">Delete</button>
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
    getReviewData();
</script>
@endsection