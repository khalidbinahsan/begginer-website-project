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
                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td><img class="table-img" src="' + jsonData[i].service_img +
                        '"></td><td>' + jsonData[i].service_name +
                        '</td><td>' + jsonData[i].service_des +
                        '</td><td><a href="" ><i class="fas fa-edit"></i></a></td><td><a href="#myModal" class="trigger-btn" data-toggle="modal" > <i class="fas fa-trash-alt"></i></a></td>').appendTo('#service_table');
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