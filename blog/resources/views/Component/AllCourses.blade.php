<div class="container mt-5 mb-5">
    <div class="row">

        @foreach($AllCourses as $AllCourses)

        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$AllCourses->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$AllCourses->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">ম0{{$AllCourses->course_des}} </h6>
                    <h6 class="service-card-subTitle p-0 ">রেজিঃ {{$AllCourses->course_fee}} | মোট ক্লাসঃ  {{$AllCourses->course_totalenroll}}</h6>
                    <a class="normal-btn-outline mt-2 mb-4 btn" href="{{url('/postDetails/'.$AllCourses->id.'/'.$AllCourses->course_name)}}">শুরু করুন </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
