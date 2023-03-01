<div class="container-fluid jumbotron mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="images/code.svg">
            <h1 class="page-top-title mt-3">- প্রজেক্টস সমূহ -</h1>
        </div>
    </div>
</div>

<div class="container mt-5 pt-5">
    <div class="row">
        <div id="one" class="owl-carousel mb-4 owl-theme">
            @foreach($projectData as $projectData)
            <div class="item m-1 card">
                <div class="text-center">
                    <img class="w-100" src="{{$projectData->project_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$projectData->project_name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$projectData->project_des}}</h6>
                    <a class="normal-btn mt-2 mb-4 btn" href="{{$projectData->project_link}}">বিস্তারিত</a>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>
