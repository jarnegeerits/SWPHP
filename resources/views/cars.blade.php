@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'My car')
@section('dashcontent')

<div class="container-fluid">
    <!-- Page Heading -->
    @foreach($yourCars as $car)
    <div class="card" style="width: 18rem">
        @if ($car->image == "default.jpg")
            <img src="{{ $car->image }}" class="card-img-top" alt="car image">
        @else
            <img src="userimgs\{{ $user->id }}\{{ $car->image }}" class="card-img-top" alt="car image">
        @endif
        <div class="card-body">
            <form action="/cars/image-upload" method="POST">
                <input class="form-control" type="hidden" name="carId" value="{{$car->id}}">
                <button type="submit" class="btn btn-danger form-control">Upload new image</button>
            </form>

        </div>
    </div>
    @endforeach
</div>
@endsection
