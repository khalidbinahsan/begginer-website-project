<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="images/knowledge.svg">
            <h1 class="page-top-title mt-3">- অনলাইন কোর্স সমূহ -</h1>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        @foreach($courseData as $courseData)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" height="200" src="{{$courseData->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$courseData->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 ">{{$courseData->course_des}}</h6>
                    <h6 class="service-card-subTitle p-0 ">রেজিঃ {{$courseData->course_fee}} | মোট ক্লাসঃ {{$courseData->course_totalenroll}}</h6>
                    <a class="normal-btn-outline mt-2 mb-4 btn" href="{{$courseData->course_link}}" target="_blank">শুরু করুন </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
