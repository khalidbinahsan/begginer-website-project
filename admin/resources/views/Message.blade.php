@extends('Layout.app')
@section('content')
<div class="container d-none" id="message-list">
    <div class="row">
    <div class="col-md-12 p-5">
    <table id="messageTableContainer" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Name</th>
          <th class="th-sm">Mobile</th>
          <th class="th-sm">Email</th>
          <th class="th-sm">Message</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="message_table">
        {{-- All message data will appear here. Getting by axios.js from custom.js file --}}
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
     {{-- Delete Modal --}}
     <div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
              <button type="button" class="btn btn-primary message-dlt-btn" data-id=" ">Delete</button>
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
    getMessageData();
    
function getMessageData() {
    axios.get('/allMessage')
        .then(function(response) {
            if (response.status == 200) {
                $('#message-list').removeClass('d-none');
                $('#page-loader').addClass('d-none');
                // To refuse table data duplicate         
                $('#messageTableContainer').DataTable().destroy();
                $('#message_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td>' + jsonData[i].contact_name +
                        '</td><td>' + jsonData[i].contact_mobile +
                        '</td><td>' + jsonData[i].contact_email +
                        '</td><td>' + jsonData[i].contact_msg +
                        '</td><td style="width: 100px"><button type="button" class="dlt-btn btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="' + jsonData[i].id + '"> <i class="fas fa-trash-alt"></i></button></td>').appendTo('#message_table');
                });
                // click option
                // get and set delete data id
                $('.dlt-btn').click(function() {
                    var id = $(this).data('id');
                    $('#deleteMessageModal').modal('show');
                    $('.message-dlt-btn').attr('data-id', id);
                    
                });
                $('#messageTableContainer').DataTable({"order": false});
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#page-loader').addClass('d-none');
                $('#something-wrng').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#page-loader').addClass('d-none');
            $('#something-wrng').removeClass('d-none');
        });
       

}
// Message delete confirm
$('.message-dlt-btn').click(function(){
    var id = $(this).attr('data-id');
    dataMessageDelete(id);
});
function dataMessageDelete(id){
    axios.post('/deleteMessage', {id: id})
    .then(function(response){
        if(response.data == 1){
            getMessageData();
            $('#deleteMessageModal').modal('hide');
            $('#success-notifications').toast('show');
            $('#success-notifications h5').html('Delete send successfully');
        } else {
            $('#deleteMessageModal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Delete Fail');
        }
    })
    .catch(function(error){
        $('#deleteMessageModal').modal('hide');
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Delete Fail');
    })
};

</script>
@endsection