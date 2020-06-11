@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'My car')
@section('dashcontent')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card" style="width: 18rem">
        @if ($car->image == "default.jpg")
            <img src="{{ $car->image }}" class="card-img-top" alt="car image">
        @else
            <img src="userimgs\{{ $user->id }}\{{ $car->image }}" class="card-img-top" alt="car image">
        @endif
        <div class="card-body">
            <button type="button" class="btn btn-secondary btn-block">Upload new image</button>
        </div>
      </div>
</div>

@endsection
