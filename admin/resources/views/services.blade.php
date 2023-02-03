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
// Get data from database by axios.js
function getServicesData() {
    axios.get('/getServicesData')
        .then(function(response) {
            if (response.status == 200) {
                $('#services-list').removeClass('d-none');
                $('#page-loader').addClass('d-none');
                // To refuse table data duplicate
                $('#service_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td><img class="table-img" src="' + jsonData[i].service_img +
                        '"></td><td>' + jsonData[i].service_name +
                        '</td><td>' + jsonData[i].service_des +
                        '</td><td><button type="button" class="btn btn-primary edit-btn" data-mdb-toggle="modal" data-mdb-target="#editModal" data-id="'+ jsonData[i].id +'"><i class="fas fa-edit"></i></button></td><td><button type="button" class="dlt-btn btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="' + jsonData[i].id + '"> <i class="fas fa-trash-alt"></i></button></td>').appendTo('#service_table');
                });
                // click option
                // get and set delete data id
                $('.dlt-btn').click(function() {
                    var id = $(this).data('id');
                    $('.service-dlt-btn').attr('data-id', id);
                    
                });
                // get and set edit data id
                $('.edit-btn').click(function(){
                    var id = $(this).data('id');
                    $('.saveChange-btn').attr('data-id', id);
                    getServiceDataById(id);
                });

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

 // service delete confirmation button
 $('.service-dlt-btn').click(function() {
    var id = $(this).attr('data-id');
    dataServiceDelete(id);
});
// Data Services delete with axios from database
function dataServiceDelete(deleteId) {
    $('.service-dlt-btn').html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
    axios.post('/deleteService', { id: deleteId })
        .then(function(response) {
            $('.service-dlt-btn').html('DELETE');
            if (response.data == 1) {
                getServicesData();
                $('#deleteModal').modal('hide');
                $('#success-notifications').toast('show');           
            } else {
                getServicesData();
                $('#deleteModal').modal('hide');
                $('#error-notifications').toast('show');
                
            }
        })
        .catch(function(error) {           
            $('#deleteModal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');
        });
}
// Get Service Data By Id
function getServiceDataById(editId){
    axios.post('/getServiceDataById', {id: editId})
    .then(function(response){
        if(response.status==200){
            $('#data-loader').addClass('d-none');
            $('.form-container').removeClass('d-none');
            var idData = response.data;
            $('#serviceName').val(idData[0].service_name);
            $('#serviceDescription').val(idData[0].service_des);
            $('#imageLink').val(idData[0].service_img);
        } else{
            $('#page-loader').addClass('d-none');
            $('#something-wrng2').removeClass('d-none');
        }
    })
    .catch(function(error){
        
    });
}
// Update service data by save change btn from modal
$('#saveCng').click(function(){
    var id = $(this).attr('data-id');
    var serviceName = $('#serviceName').val();
    var serviceDescription = $('#serviceDescription').val();
    var imageLink = $('#imageLink').val();
    serviceUpdate(id, serviceName, serviceDescription, imageLink);
})
 // Service update function
function serviceUpdate(id, serviceName, serviceDescription, imageLink){
    if(serviceName.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service name is empty');
   } else if(serviceDescription.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service description is empty');
   } else if(imageLink.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service image is empty');
   } else {
       $('.saveChange-btn').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
       axios.post('/updateServiceData', {
           id: id,
           serviceName: serviceName,
           serviceDescription: serviceDescription,
           imageLink: imageLink
       })
       .then(function(response){
           $('.saveChange-btn').html('Save Change');
           if(response.status==200){
               if(response.data == 1){
                   getServicesData();
                   $('#editModal').modal('hide');
                   $('#success-notifications').toast('show');
                   $('#success-notifications h5').html('Update Successful');
               } else {
                   getServicesData();
                   $('#editModal').modal('hide');
                   $('#error-notifications').toast('show');
                   $('#error-notifications .error-msg').html('Update Fail'); 
               }
           } else {
               $('#editModal').modal('hide');
               $('#error-notifications').toast('show');
               $('#error-notifications .error-msg').html('Something went wrong !');  
           }

       })
       .catch(function (error) { 
           $('#editModal').modal('hide');
           $('#error-notifications').toast('show');
           $('#error-notifications .error-msg').html('Something went wrong !');
        });
   }
}
// Service add new modal show
$('#add-new-btn').click(function () { 
    $('#add-new-modal').modal('show');
 });
 // Service added by click add new btn
$('#addNew').click(function(){
    var addName = $('#addName').val();
    var addDescription = $('#addDescription').val();
    var addimageLink = $('#addimageLink').val();
    addNew(addName, addDescription, addimageLink);
    $('#addName').val('');
    $('#addDescription').val('');
    $('#addimageLink').val('');
})
function addNew(serviceName, serviceDes, imgLink){
    if(serviceName.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Service name is empty');
    } else if(serviceDes.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Service description is empty');
    } else if(imgLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Service image is empty');
    } else {
        $('#addNew').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
        axios.post('/addNewService', {
            addName: serviceName,
            addDescription: serviceDes,
            addimageLink: imgLink
        })
        .then(function(response){
            $('#addNew').html('Add');
            if(response.status==200){
                if(response.data == 1){
                    getServicesData();
                    $('#add-new-modal').modal('hide');
                    $('#success-notifications').toast('show');
                    $('#success-notifications h5').html('Successfully Added');
                } else {
                    getServicesData();
                    $('#add-new-modal').modal('hide');
                    $('#error-notifications').toast('show');
                    $('#error-notifications .error-msg').html('Fail'); 
                }
            } else {
                $('#add-new-modal').modal('hide');
                $('#error-notifications').toast('show');
                $('#error-notifications .error-msg').html('Something went wrong !');  
            }
 
        })
        .catch(function (error) { 
            $('#add-new-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');
         });
    }
}
</script>
@endsection