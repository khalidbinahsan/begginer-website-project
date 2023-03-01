// Get Review Data from database
function getReviewData() {
    axios.get('/allReview')
        .then(function(response) {
            if (response.status == 200) {
                $('#review-list').removeClass('d-none');
                $('#page-loader').addClass('d-none');
                // To refuse table data duplicate         
                $('#reviewTableContainer').DataTable().destroy();
                $('#review_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td><img class="table-img" src="' + jsonData[i].images +
                        '"></td><td>' + jsonData[i].name +
                        '</td><td>' + jsonData[i].description +
                        '</td><td style="width: 100px"><button type="button" class="btn btn-primary edit-btn" data-mdb-toggle="modal" data-mdb-target="#editModal" data-id="'+ jsonData[i].id +'"><i class="fas fa-edit"></i></button></td><td style="width: 100px"><button type="button" id="review-dlt" class="dlt-btn btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="' + jsonData[i].id + '"> <i class="fas fa-trash-alt"></i></button></td>').appendTo('#review_table');
                });
                // click option
                // get and set delete data id
                $('.dlt-btn').click(function() {
                    var id = $(this).attr('data-id');
                    $('#delete-review-modal').modal('show');
                    $('.review-dlt-btn').attr('data-id', id);
                    
                });
                //  edit data by id
                $('.edit-btn').click(function(){
                    var id = $(this).attr('data-id');
                    $('#editReviewModal').modal('show');
                    $('#reviewUpdate').attr('data-id', id);
                    getReviewDataById(id);
                });
                $('#reviewTableContainer').DataTable({"order": false});
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
// Add New Review
$('#add-new-review').click(function(){
    $('#add-new-review-modal').modal('show');
});
$('#addNewReview').click(function(){
    var clientName = $('#addClientName').val();
    var feedback = $('#addFeedback').val();
    var clientPhoto = $('#clientPhoto').val();
    if(clientName.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Name Field is Empty');
    } else if(feedback.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Feedback Field is Empty'); 
    } else if(clientPhoto.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Photo Field is Empty'); 
    } else {
        $('#addNewReview').html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
        axios.post('/add_new_review', {
            'clientName': clientName, 
            'clientFeedback': feedback,
            'clientPhoto': clientPhoto
        })
        .then(function(response){
            if(response.data == 1){
                $('#addNewReview').html('Add');
                $('#addClientName').val('');
                $('#addFeedback').val('');
                $('#clientPhoto').val('');
                getReviewData();
                $('#add-new-review-modal').modal('hide');
                $('#success-notifications').toast('show');
                $('#success-notifications h5').html('Review added successfully');
            } else {
                $('#addNewReview').html('Add');
                $('#add-new-review-modal').modal('hide');
                $('#error-notifications').toast('show');
                $('#error-notifications h5').html('Review added fail'); 
            }
        })
        .catch(function (error) { 
            $('#addNewReview').html('Add');
            $('#add-new-review-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications h5').html('Review added fail'); 
         })
    }
});
// Review Delete
$('.review-dlt-btn').click(function(){
    $(this).html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
    var id = $(this).attr('data-id');
    axios.post('/review_delete', {'id': id})
    .then(function(response){
        if(response.data == 1){
            $('.review-dlt-btn').html('Delete');
            getReviewData();
            $('#delete-review-modal').modal('hide');
            $('#success-notifications').toast('show');
            $('#success-notifications h5').html('Review delete successfully');
        } else {
            $('.review-dlt-btn').html('Delete');
            $('#delete-review-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications h5').html('Delete fail'); 
        }
    })
    .catch(function(error){
        $('.review-dlt-btn').html('Delete');
        $('#delete-review-modal').modal('hide');
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Delete fail'); 
    })
});
// Edit review
// Get review Data By Id
function getReviewDataById(id){
    axios.post('/get_review', {id: id})
    .then(function(response){
        if(response.status==200){
            $('#data-loader').addClass('d-none');
            $('.form-container').removeClass('d-none');
            var rData = response.data;
            $('#edit-client-name').val(rData[0].name);
            $('#edit-client-feedback').val(rData[0].description);
            $('#edit-client-photo').val(rData[0].images);
        } else{
            $('#page-loader').addClass('d-none');
            $('#something-wrng2').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#something-wrng2').removeClass('d-none');
        $('#data-loader').addClass('d-none');
        $('.form-container').removeClass('d-none');
    });
}
// Update Review data by save change btn from modal
$('#reviewUpdate').click(function(){
    var id = $(this).attr('data-id');
    var name = $('#edit-client-name').val();
    var description = $('#edit-client-feedback').val();
    var images = $('#edit-client-photo').val();
    reviewUpdate(id, name, description, images);
})
 // Project update function
function reviewUpdate(id, name, description, images){
    if(name.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Name is empty');
   } else if(description.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Review is empty');
   } else if(images.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Image is empty');
   } else {
       $('#reviewUpdate').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
       axios.post('/update_review', {
           id: id,
           name: name,
           description: description,
           images: images
       })
       .then(function(response){
           $('#reviewUpdate').html('Save Change');
           if(response.status==200){
               if(response.data == 1){
                    getReviewData();
                    $('#editReviewModal').modal('hide');
                   $('#success-notifications').toast('show');
                   $('#success-notifications h5').html('Update Successful');
               } else {
                    getReviewData();
                   $('#editReviewModal').modal('hide');
                   $('#error-notifications').toast('show');
                   $('#error-notifications .error-msg').html('Update Fail'); 
               }
           } else {
               $('#editReviewModal').modal('hide');
               $('#error-notifications').toast('show');
               $('#error-notifications .error-msg').html('Something went wrong !');  
           }

       })
       .catch(function (error) { 
           $('#editReviewModal').modal('hide');
           $('#error-notifications').toast('show');
           $('#error-notifications .error-msg').html('Something went wrong !');
        });
   }
}