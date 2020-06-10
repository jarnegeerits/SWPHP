@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'My car')
@section('dashcontent')

<div class="container">
    <div class="row">
        <div class= "col-12">
            <h1>Add New Car<h1>
            </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @include('customers.form')

        <button type='submit' class="btn btn-primary">Add Picture</button>
        </form>
    </div>
</div>
@endsection
