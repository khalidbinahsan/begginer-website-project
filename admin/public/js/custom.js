// Visitor table
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});
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
