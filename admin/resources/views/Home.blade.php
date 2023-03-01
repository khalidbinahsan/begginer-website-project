@extends('Layout.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$TotalVisitor}}</h3>
                    <h3 class="count-card-text">Total Visitor</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$TotalServices}}</h3>
                    <h3 class="count-card-text">Total Services</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$TotalProject}}</h3>
                    <h3 class="count-card-text">Total Projects</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$TotalCourse}}</h3>
                    <h3 class="count-card-text">Total Course</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$TotalContact}}</h3>
                    <h3 class="count-card-text">Total Contact</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection