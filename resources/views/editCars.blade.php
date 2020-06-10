@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'My car')
@section('dashcontent')

<div class="container">
    <div class="row">
        <div class= "col-12">
            <h1>Add New picture for car from {{$member->name}}<h1>
            </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('cars.update', ['car' => $car]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @include('customers.form')

        <button type='submit' class="btn btn-primary">Save Picture</button>
        </form>
    </div>
</div>
@endsection
