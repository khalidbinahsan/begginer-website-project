<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables-select.min.css')}}">
    <title>Admin Login</title>
    <style>
        img{
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container form-container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="row align-items-center p-5" style="box-shadow: 0 0 16px;">
            <div class="col-md-6">
                <form action=" "  class="login-form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email" required="">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="userPassword" value="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
                    </div>

                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="col-md-6 banner-container">
                <img src="images/bannerImg.png" alt="Banner Image">
            </div>
        </div>
    </div>
    {{-- Error Toast Design --}}
    <div id="error-notifications" class="toast fade bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
          <img src="{{asset('images\error.gif')}}" alt="" width="30" style="width: 30px !important">
          <h5 class="ml-2 error-msg">Delete Fail</h5>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sidebarmenu.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sticky-kit.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom.min-2.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/datatables-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
<script type="text/javascript">
    $('.login-form').on('submit', function(event){
        event.preventDefault();
        let FormData = $(this).serializeArray();
        let email = FormData[0]['value'];
        let password = FormData[1]['value'];
        axios.post('/on_login', {
            email: email,
            password: password
        })
        .then(function(response){
            if(response.status==200 && response.data==1){
                window.location.href="/";
            } else {
                $('#error-notifications').toast('show');
                $('#error-notifications h5').html('Email or Password dose not match');
            }
        })
        .catch(function(error){
            $('#error-notifications').toast('show');
            $('#error-notifications h5').html('Email or Password dose not match');
        })
    })
</script>
</body>
</html>