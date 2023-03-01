@extends('Layout.app')
@section('content')
<div class="container d-none" id="project-list">
    <div class="row">
    <div class="col-md-12 p-5">
    <button class="btn btn-primary my-3" id="add-new-project">Add New</button>
    <table id="projectTableContainer" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm">Image</th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Description</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="project_table">
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
     <div class="modal fade" id="add-new-project-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewModalLabel">Add New Project</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100">
              <!-- Project Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addProjectName" class="form-control" />
                <label class="form-label" for="addProjectName">Service Name</label>
              </div>

              <!-- Project Description  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addProjectDescription" class="form-control" />
                <label class="form-label" for="addProjectDescription">Description</label>
              </div>

              <!-- Project Link  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addProjectLink" class="form-control" />
                <label class="form-label" for="addProjectLink">Description</label>
              </div>

              <!-- Project Image Link -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="addProjectImageLink" class="form-control" />
                <label class="form-label" for="addProjectImageLink">Image Link</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            <button type="button" id="addNewProject" class="btn btn-primary add-btn">Add</button>
          </div>
        </div>
      </div>
    </div>
    {{-- End Add New Modal --}}
    {{-- Edit Modal --}}
    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-container w-100 d-none">
              <!-- Project Name -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="projectName" class="form-control" />
                <label class="form-label" for="projectName">Service Name</label>
              </div>

              <!-- Project Description  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="projectDescription" class="form-control" />
                <label class="form-label" for="projectDescription">Description</label>
              </div>

              <!-- Project Link  -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="projectLink" class="form-control" />
                <label class="form-label" for="projectLink">Project Link</label>
              </div>

              <!-- Project Image Link -->
              <div class="form-outline mb-4 w-100">
                <input type="text" id="projectImageLink" class="form-control" />
                <label class="form-label" for="projectImageLink">Image Link</label>
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
            <button type="button" id="projectUpdate" class="btn btn-primary saveChange-btn">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-primary project-dlt-btn" data-id=" ">Delete</button>
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
getProjectData()
// Get data from database by axios.js
function getProjectData() {
    axios.get('/getProjectData')
        .then(function(response) {
            if (response.status == 200) {
                $('#project-list').removeClass('d-none');
                $('#page-loader').addClass('d-none');
                // To refuse table data duplicate         
                $('#projectTableContainer').DataTable().destroy();
                $('#project_table').empty();
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td><img class="table-img" src="' + jsonData[i].project_img +
                        '"></td><td>' + jsonData[i].project_name +
                        '</td><td>' + jsonData[i].project_des +
                        '</td><td style="width: 100px"><button type="button" class="btn btn-primary edit-btn" data-mdb-toggle="modal" data-mdb-target="#editModal" data-id="'+ jsonData[i].id +'"><i class="fas fa-edit"></i></button></td><td style="width: 100px"><button type="button" class="dlt-btn btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#deleteModal" data-id="' + jsonData[i].id + '"> <i class="fas fa-trash-alt"></i></button></td>').appendTo('#project_table');
                });
                // click option
                // get and set delete data id
                $('.dlt-btn').click(function() {
                    var id = $(this).data('id');
                    $('#deleteProjectModal').modal('show');
                    $('.project-dlt-btn').attr('data-id', id);
                    
                });
                //  edit data by id
                $('.edit-btn').click(function(){
                    var id = $(this).data('id');
                    $('#editProjectModal').modal('show');
                    $('#projectUpdate').attr('data-id', id);
                    getProjectDataById(id);
                });
                $('#projectTableContainer').DataTable({"order": false});
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

 // project delete confirmation button
 $('.project-dlt-btn').click(function() {
    var id = $(this).attr('data-id');
    dataProjectDelete(id);
});
// Data Project delete with axios from database
function dataProjectDelete(deleteId) {
    $('.project-dlt-btn').html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
    axios.post('/deleteProject', { id: deleteId })
        .then(function(response) {
            if (response.data == 1) {
                $('.project-dlt-btn').html('DELETE');
                getProjectData();
                $('#deleteProjectModal').modal('hide');
                $('#success-notifications').toast('show'); 
                $('#success-notifications h5').html('Delete Sucessfully');          
            } else {
              $('.project-dlt-btn').html('DELETE');
                getProjectData();
                $('#deleteProjectModal').modal('hide');
                $('#error-notifications').toast('show');
                
            }
        })
        .catch(function(error) { 
            $('.project-dlt-btn').html('DELETE');          
            $('#deleteProjectModal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');
        });
}
// Get Project Data By Id
function getProjectDataById(editId){
    axios.post('/getProjectById', {id: editId})
    .then(function(response){
        if(response.status==200){
            $('#data-loader').addClass('d-none');
            $('.form-container').removeClass('d-none');
            var pData = response.data;
            $('#projectName').val(pData[0].project_name);
            $('#projectDescription').val(pData[0].project_des);
            $('#projectLink').val(pData[0].project_link);
            $('#projectImageLink').val(pData[0].project_img);
        } else{
            $('#page-loader').addClass('d-none');
            $('#something-wrng2').removeClass('d-none');
        }
    })
    .catch(function(error){
        
    });
}
// Update Project data by save change btn from modal
$('#projectUpdate').click(function(){
    var id = $(this).attr('data-id');
    var projectName = $('#projectName').val();
    var projectDescription = $('#projectDescription').val();
    var projectLink = $('#projectLink').val();
    var projectImageLink = $('#projectImageLink').val();
    projectUpdate(id, projectName, projectDescription, projectLink, projectImageLink);
})
 // Project update function
function projectUpdate(id, projectName, projectDescription, projectLink, projectImageLink){
    if(projectName.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Project name is empty');
   } else if(projectDescription.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Project description is empty');
   } else if(projectLink.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Project Link is empty');
   } else if(projectImageLink.length==0){
      $('#error-notifications').toast('show');
      $('#error-notifications .error-msg').html('Project image is empty');
   } else {
       $('#projectUpdate').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
       axios.post('/updateProjectData', {
           id: id,
           projectName: projectName,
           projectDes: projectDescription,
           projectLink: projectLink,
           projectImg: projectImageLink
       })
       .then(function(response){
           $('#projectUpdate').html('Save Change');
           if(response.status==200){
               if(response.data == 1){
                   getProjectData();
                   $('#editProjectModal').modal('hide');
                   $('#success-notifications').toast('show');
                   $('#success-notifications h5').html('Update Successful');
               } else {
                  getProjectData();
                   $('#editProjectModal').modal('hide');
                   $('#error-notifications').toast('show');
                   $('#error-notifications .error-msg').html('Update Fail'); 
               }
           } else {
               $('#editProjectModal').modal('hide');
               $('#error-notifications').toast('show');
               $('#error-notifications .error-msg').html('Something went wrong !');  
           }

       })
       .catch(function (error) { 
           $('#editProjectModal').modal('hide');
           $('#error-notifications').toast('show');
           $('#error-notifications .error-msg').html('Something went wrong !');
        });
   }
}
// Project add new modal show
$('#add-new-project').click(function () { 
    $('#add-new-project-modal').modal('show');
 });
 // Project added by click add new btn
$('#addNewProject').click(function(){
    var addProjectName = $('#addProjectName').val();
    var addProjectDescription = $('#addProjectDescription').val();
    var addProjectLink = $('#addProjectLink').val();
    var addProjectimageLink = $('#addProjectImageLink').val();
    addNewProject(addProjectName, addProjectDescription, addProjectLink, addProjectimageLink);
    $('#addProjectName').val('');
    $('#addProjectDescription').val('');
    $('#addProjectLink').val('');
    $('#addProjectImageLink').val('');
})
function addNewProject(addProjectName, addProjectDescription, addProjectLink, addProjectimageLink){
    if(addProjectName.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Project name is empty');
    } else if(addProjectDescription.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Project description is empty');
    } else if(addProjectLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Project link is empty');
    } else if(addProjectimageLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Project image link is empty');
    } else {
        $('#addNewProject').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
        axios.post('/addNewProject', {
          projectName: addProjectName,
          projectDes: addProjectDescription,
          projectLink: addProjectLink,
          projectImageLink: addProjectimageLink,
        })
        .then(function(response){
            $('#addNewProject').html('Add');
            if(response.status==200){
                if(response.data == 1){
                    getProjectData();
                    $('#add-new-project-modal').modal('hide');
                    $('#success-notifications').toast('show');
                    $('#success-notifications h5').html('Successfully Added');
                } else {
                    getProjectData();
                    $('#add-new-project-modal').modal('hide');
                    $('#error-notifications').toast('show');
                    $('#error-notifications .error-msg').html('Fail'); 
                }
            } else {
                $('#add-new-project-modal').modal('hide');
                $('#error-notifications').toast('show');
                $('#error-notifications .error-msg').html('Something went wrong !');  
            }
 
        })
        .catch(function (error) { 
            $('#add-new-project-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');
         });
    }
}
</script>
@endsection