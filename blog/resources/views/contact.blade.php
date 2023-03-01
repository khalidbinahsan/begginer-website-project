@extends('Layout.app')
@section('title', 'Contact')
@section('content')
{{--    Breadcrumb --}}
<div class="container-fluid jumbotron mt-5 mb-0">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <h1 class="page-top-title mt-3">যোগাযোগ</h1>
        </div>
    </div>
</div>
{{-- end Breadcrumb --}}

{{-- Contact Form --}}
<div class="container-fluid  parallax text-center" id="contact">
    <div class="row ">
        <div class="col-md-6 contact-form ">
            <h5 class="help-line-title"><i class="fas icon-custom-color fa-headphones-alt"></i> হেলপ লাইন </h5>
            <h5 class="help-line-title m-0"> ০১৭৫৪৮৭৯৩০২ </h5>
        </div>
        <div class="col-md-4 contact-form">
            <div class="contact-container" style="padding: 30px 20px; background: #fff">
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input type="text" id="contact-name" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input type="text" id="contact-phone" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input type="text" id="contact-email" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input type="text" id="contact-msg" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button type="submit" id="contact-send" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন</button>
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
