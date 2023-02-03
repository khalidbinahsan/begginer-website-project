
function allCourseData(){
    axios.get('/getCourseData')
    .then(function(response){
        $('#courseTable').empty();
        var courseData = response.data;
        $.each(courseData, function(i, item){
            $('<tr>').html('<td class="th-sm">'+ courseData[i].course_name+'</td><td class="th-sm">'+ courseData[i].course_fee+'</td><td class="th-sm">'+ courseData[i].course_totalenroll+'</td><td class="th-sm"><a href="" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td><td class="th-sm"><a href="" class="btn btn-primary"><i class="fas fa-edit"></i></a></td><td class="th-sm"><a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>').appendTo('#courseTable');
        })
    })
    .catch(function(error){

    });
}