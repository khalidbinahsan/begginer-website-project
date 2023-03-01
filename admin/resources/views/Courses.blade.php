@extends('Layout.app')
@section('content')
<div class="container d-none" id="courseDataList">
    <div class="row">
        <div class="col-md-12 p-5">
            <button class="btn btn-primary my-3" id="add-new-course">Add New</button>
            <table id="courseTblContainer" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Fee</th>
                        <th class="th-sm">Enroll</th>
                        <th class="th-sm">Details</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="courseTable">
                    {{-- All course data will append here by javascript axios.js--}}
                </tbody>
            </table>

        </div>
    </div>
</div>
 {{-- Page Loader --}}
 <div class="container" id="page-loader2" style="height: 99vh">
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
   {{-- Add Course Modal --}}
   <div class="modal fade" id="add-new-course-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addNewModalLabel">Add New Course</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-container w-100">
            <!-- Course Name -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="courseName" class="form-control" />
              <label class="form-label" for="courseName">Course Name</label>
            </div>

            <!-- Course Description  -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="courseDescription" class="form-control" />
              <label class="form-label" for="courseDescription">Course Description</label>
            </div>
            <!-- Course Fee  -->
            <div class="form-outline mb-4 w-100">
                <input type="text" id="courseFee" class="form-control" />
                <label class="form-label" for="courseFee">Course Fee</label>
            </div>
            <!-- Course Total Enroll  -->
            <div class="form-outline mb-4 w-100">
                <input type="text" id="courseEnroll" class="form-control" />
                <label class="form-label" for="courseEnroll">Course Total Enroll</label>
            </div>
             <!-- Course Link  -->
             <div class="form-outline mb-4 w-100">
                <input type="text" id="courseLink" class="form-control" />
                <label class="form-label" for="courseLink">Course Link</label>
            </div>

            <!-- Course Image Link -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="courseimageLink" class="form-control" />
              <label class="form-label" for="courseimageLink">Image Link</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="button" id="addNewCourse" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
  {{-- End Add New Modal --}}
  {{-- Update Course Modal --}}
  <div class="modal fade" id="update-course-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addNewModalLabel">Update Course</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-container w-100">
            <!-- Course Name -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="ucourseName" class="form-control" />
              <label class="form-label" for="ucourseName">Course Name</label>
            </div>

            <!-- Course Description  -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="ucourseDescription" class="form-control" />
              <label class="form-label" for="ucourseDescription">Course Description</label>
            </div>
            <!-- Course Fee  -->
            <div class="form-outline mb-4 w-100">
                <input type="text" id="ucourseFee" class="form-control" />
                <label class="form-label" for="ucourseFee">Course Fee</label>
            </div>
            <!-- Course Total Enroll  -->
            <div class="form-outline mb-4 w-100">
                <input type="text" id="ucourseEnroll" class="form-control" />
                <label class="form-label" for="ucourseEnroll">Course Total Enroll</label>
            </div>
             <!-- Course Link  -->
             <div class="form-outline mb-4 w-100">
                <input type="text" id="ucourseLink" class="form-control" />
                <label class="form-label" for="ucourseLink">Course Link</label>
            </div>

            <!-- Course Image Link -->
            <div class="form-outline mb-4 w-100">
              <input type="text" id="ucourseimageLink" class="form-control" />
              <label class="form-label" for="ucourseimageLink">Image Link</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="button" id="updateCourse" class="btn btn-primary" data-id="">Update</button>
        </div>
      </div>
    </div>
  </div>
  {{-- End  update Modal --}}
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
  {{-- Delete confirmation Modal --}}
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
          <button type="button" class="btn btn-primary course-dlt-btn" data-id=" ">Delete</button>
        </div>
      </div>
    </div>
  </div>
  {{-- Delete confirmation model end --}}
@endsection
@section('script')
<script type="text/javascript">
allCourseData();
function allCourseData() {
    axios
        .get("/getCourseData")
        .then(function (response) {
            if (response.status == 200) {
                $("#courseDataList").removeClass("d-none");
                $("#page-loader2").addClass("d-none");
                $('#courseTblContainer').DataTable().destroy();
                $("#courseTable").empty();
                var courseData = response.data;
                $.each(courseData, function (i, item) {
                    $("<tr>")
                        .html(
                            '<td class="th-sm">' +
                                courseData[i].course_name +
                                '</td><td class="th-sm">' +
                                courseData[i].course_fee +
                                '</td><td class="th-sm">' +
                                courseData[i].course_totalenroll +
                                '</td><td class="th-sm"><button href="#" class="btn btn-primary view-details-btn" data-id="'+ courseData[i].id +'"><i class="fa-solid fa-eye"></i></button></td><td class="th-sm"><button href="#" class="btn btn-primary course-edit-btn" data-id="'+ courseData[i].id +'"><i class="fas fa-edit"></i></button></td><td class="th-sm"><button href="#" class="btn btn-danger course-delete-btn"  data-id="'+ courseData[i].id +'"><i class="fas fa-trash-alt"></i></button></td>').appendTo("#courseTable");
                });
                // Delete Course
                $('.course-delete-btn').click(function(){
                    var id = $(this).attr('data-id');
                    $('#deleteModal').modal('show');
                    $('.course-dlt-btn').attr('data-id', id);
                });
                // Course update modal
                $('.course-edit-btn').click(function(){
                    var id = $(this).attr('data-id');
                    $('#update-course-modal').modal('show');
                    getDataById(id);
                    $('#updateCourse').attr('data-id', id);
                })
                $('#courseTblContainer').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');
                
            } else {
                $('#something-wrng2').removeClass('d-none');
                $("#page-loader2").addClass('d-none');
            }
        })
        .catch(function (error) {
            $('#something-wrng2').removeClass('d-none');
            $("#page-loader2").addClass('d-none');
        });
}
// Get Data by id function
function getDataById(id){
    axios.post('/getCourseById', {id: id})
    .then(function(response){
        if(response.status == 200 ){
            var cData = response.data;
            $('#ucourseName').val(cData[0].course_name);
            $('#ucourseDescription').val(cData[0].course_des);
            $('#ucourseFee').val(cData[0].course_fee);
            $('#ucourseEnroll').val(cData[0].course_totalenroll);
            $('#ucourseLink').val(cData[0].course_link);
            $('#ucourseimageLink').val(cData[0].course_img);
        } else {
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong!');
        }
        
    })
    .catch(function (error) { 

     });
}
// Add new course
$('#add-new-course').click(function(){
    $('#add-new-course-modal').modal('show');
});
$('#addNewCourse').click(function(){
    var courseName = $('#courseName').val();
    var courseDes = $('#courseDescription').val();
    var courseFee = $('#courseFee').val();
    var courseTotalEnroll = $('#courseEnroll').val();
    var courseLink = $('#courseLink').val();
    var courseImg = $('#courseimageLink').val();
    addNewCourse(courseName, courseDes, courseFee, courseTotalEnroll, courseLink, courseImg);
    $('#courseName').val('');
    $('#courseDescription').val('');
    $('#courseFee').val('');
    $('#courseEnroll').val('');
    $('#courseLink').val('');
    $('#courseimageLink').val('');
});
function addNewCourse(courseName, courseDes, courseFee, courseTotalEnroll, courseLink, courseImg){
    if(courseName.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course name is empty');
    } else if(courseDes.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  description is empty');
    } else if(courseFee.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  fee is empty');
    } else if(courseTotalEnroll.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  enroll is empty');
    } else if(courseLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  link is empty');
    } else if(courseImg.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  image is empty');
    } else {
        $('#addNewCourse').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
        axios.post('/addCourse', {
            courseName: courseName,
            courseDes: courseDes,
            courseFee: courseFee,
            courseTotalEnroll: courseTotalEnroll,
            courseLink: courseLink,
            courseImg: courseImg
        })
        .then(function(response){
            if(response.status==200){
                $('#addNewCourse').html('Add');
                if(response.data==1){
                    allCourseData();
                    $('#add-new-course-modal').modal('hide');
                    $('#success-notifications').toast('show');
                    $('#success-notifications h5').html('Successfully Added');
                } else {
                    $('#add-new-course-modal').modal('hide');
                    $('#error-notifications').toast('show');
                    $('#error-notifications .error-msg').html('Fail'); 
                }
            } else {
                $('#add-new-course-modal').modal('hide');
                $('#error-notifications').toast('show');
                $('#error-notifications .error-msg').html('Something went wrong !');  
            }
        })
        .catch(function(error){
            $('#add-new-course-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');  
        })
    }

}
// Course delete 
$('.course-dlt-btn').click(function(){
    var id = $(this).attr('data-id');
    deleteCourseData(id);
});
function deleteCourseData(id){
    $('.course-dlt-btn').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
    axios.post('/courseDelete', {id: id})
    .then(function(response){
        if(response.data == 1){
            $('.course-dlt-btn').html('Delete');
            allCourseData();
            $('#deleteModal').modal('hide');
            $('#success-notifications').toast('show');
            $('#success-notifications h5').html('Successfully Deleted');
        } else {
            $('.course-dlt-btn').html('Delete');
            $('#deleteModal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');  
        }
    })
    .catch(function (error) { 
        $('.course-dlt-btn').html('Delete');
        $('#deleteModal').modal('hide');
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Something went wrong !');  
     });
}
// Course Update
$('#updateCourse').click(function(){
    var id = $(this).attr('data-id');
    var courseName = $('#ucourseName').val();
    var courseDes = $('#ucourseDescription').val();
    var courseFee = $('#ucourseFee').val();
    var courseEnroll = $('#ucourseEnroll').val();
    var courseLink = $('#ucourseLink').val();
    var imageLink = $('#ucourseimageLink').val();
    updateCourseData(id, courseName, courseDes, courseFee, courseEnroll, courseLink, imageLink);
})
function updateCourseData(id, courseName, courseDes, courseFee, courseEnroll, courseLink, imageLink){
    if(courseName.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course name is empty');
    } else if(courseDes.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  description is empty');
    } else if(courseFee.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  fee is empty');
    } else if(courseEnroll.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  enroll is empty');
    } else if(courseLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  link is empty');
    } else if(imageLink.length==0){
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Course  image is empty');
    } else {
    axios.post('/courseUpdate', {
        id: id,
        courseName: courseName,
        courseDes: courseDes,
        courseFee: courseFee,
        courseTotalEnroll: courseEnroll,
        courseLink: courseLink,
        courseImg: imageLink
    })
    .then(function(response){
        $('#updateCourse').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
        if(response.status==200){
        if(response.data == 1){
            allCourseData();
            $('#updateCourse').html('Update');
            $('#update-course-modal').modal('hide');          
            $('#success-notifications').toast('show');
            $('#success-notifications h5').html('Successfully Updated');
        } else {
            $('#update-course-modal').modal('hide');
            $('#updateCourse').html('Update');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong!');
        }
    }

    })
    .catch(function(error){
        $('#update-course-modal').modal('hide');
        $('#updateCourse').html('Update');
        $('#error-notifications').toast('show');
        $('#error-notifications .error-msg').html('Something went wrong!');
    })
    }
}

</script>
@endsection