@extends('Layout.app')
@section('title', 'Projects')
@section('content')
    @include('Component.ProjectsBreadcrumb')
    @include('Component.AllProjects')
@endsection
