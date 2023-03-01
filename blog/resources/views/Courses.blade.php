@extends('Layout.app')
@section('title', 'Courses')
@section('content')
    @include('Component.CourseBreadcrumb')
    @include('Component.AllCourses')
@endsection

