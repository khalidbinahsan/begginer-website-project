@extends('Layout.app')
@section('title', 'Gallery')
@section('content')
    <div class="container gallery-wrapper d-none">
      <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary my-3" id="add-new">Add New</button>
        </div>
      </div>
      <div class="row gallery-row">
        {{-- Image will appear from database by axios.js --}}
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button class="btn btn-primary mt-3 load-more">Load More</button>
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

    {{-- Add New Modal --}}
    <div class="modal fade" id="add-new-modal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addNewModalLabel">Add New Image</h5>
              <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-container w-100">
                <!-- Select Images -->
                <div class="form-outline mb-4 w-100">
                  <input type="file" id="image-input" class="form-control" />
                </div>
                <img src="" alt="" id="image-preview" style="max-width: 100%">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
              <button type="button" id="upload-image" class="btn btn-primary add-btn">Upload</button>
            </div>
          </div>
        </div>
      </div>
      {{-- End Add New Modal --}}
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
    $('#add-new').click(function(){
        $('#add-new-modal').modal('show');
    });
    $('#image-input').change(function(){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function(event){
            var imgSource = event.target.result;
            $('#image-preview').attr('src', imgSource);
        }
    });
    $('#upload-image').on('click', function(){
      $(this).html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>')
      var imageFile = $('#image-input').prop('files')[0];
      var formData = new FormData();
      formData.append('image', imageFile);
      axios.post('/image_upload', formData)
      .then(function(response){
        if(response.status==200){
          $('#upload-image').html('Add');
          $('.gallery-row').empty();
          imageLoad();
          $('#add-new-modal').modal('hide');
          $('#success-notifications').toast('show');
          $('#success-notifications h5').html('Upload Successfull');
          $('#image-input').val('');
          $('#image-preview').attr('src', '');
        } else {
          $('#upload-image').html('Add');
          $('#add-new-modal').modal('hide');
          $('#error-notifications').toast('show');
          $('#error-notifications h5').html('Something went wrong');
        }
      })
      .catch(function(error){
        $('#upload-image').html('Add');
        $('#add-new-modal').modal('hide');
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Upload Fail');
      })
    })
    function imageLoad(){
      axios.get('/image_load')
      .then(function(response){
        if(response.status==200){
          $('.gallery-wrapper').removeClass('d-none');
          $('#page-loader2').addClass('d-none');
          $.each(response.data, function(i, item){
          $('<div class="col-md-3 mt-2 mb-2">').html('<img data-id="'+item['id']+'" src="'+item['image_path']+'" alt=""><button class="btn btn-danger btn-sm image-delete" data-id="'+item['id']+'" data-path="'+item['image_path']+'">Delete</button>').appendTo('.gallery-row');
        })

        $('.image-delete').click(function(){
           var id = $(this).attr('data-id');
           var imagePath = $(this).attr('data-path');
           deleteImage(id, imagePath)
        })
        }
        
      })
      .catch(function(error){

      })
    }
    imageLoad();
    function loadMore(id){
      var url = "/image_load_more/"+id;
      axios.get(url)
      .then(function(response){
        if(response.status==200){
          $('.load-more').html('Load More');
          $.each(response.data, function(i, item){
          $('<div class="col-md-3 mt-2 mb-2">').html('<img data-id="'+item['id']+'" src="'+item['image_path']+'" alt=""><button class="btn btn-danger btn-sm image-delete" data-id="'+item['id']+'" data-path="'+item['image_path']+'">Delete</button>').appendTo('.gallery-row');
        })
        $('.image-delete').click(function(){
           var id = $(this).attr('data-id');
           var imagePath = $(this).attr('data-path');
           deleteImage(id, imagePath)
        })
        }
      })
      .catch(function(error){
        $('.load-more').html('Load More');
      })
    }
    $('.load-more').on('click', function(){
      let id = $('.gallery-row div:last-child').find('img').attr('data-id');
      $(this).html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>')
      loadMore(id);
    });

   function deleteImage(id, imagePath){
      axios.post('/image_delete', {
        'data-id': id,
        'data-path': imagePath
      })
      .then(function(response){
        if(response.status==200){
          $('#success-notifications').toast('show');
          $('#success-notifications h5').html('Image Delete Successfull');
          $('.gallery-row').empty();
          imageLoad();
        }
      })
      .catch(function(error){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Delete Fail');
      })
   }
   

</script>
@endsection