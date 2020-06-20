@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'My car')
@section('dashcontent')

<div class="container-fluid">
    <!-- Page Heading -->
    @foreach($yourCars as $car)
    @php
        $stopPrint = 0;
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-row">
                                <div class="col-sm">Brand</div>
                                <div class="col-sm">Model</div>
                                <div class="col-sm">Fuel Capacity</div>
                                <div class="col-sm">Current Fuel</div>
                                <div class="col-sm">Currently in posession of</div>
                                @if($car->ownerId == Auth::id())
                                    <div class="col-sm">Edit</div>
                                    <div class="col-sm">Remove</div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                @if($car->ownerId == Auth::id())
                                <form class="col-sm-10" method="POST" action="/cars/edit">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="carBrand" value="{{$car->brand}}">
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="text" name="carModel" value="{{$car->model}}">
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="number" name="carFuelCap" value="{{$car->fuelCap}}">
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="number" name="carCurrentFuel" value="{{$car->currentFuel}}">
                                        </div>
                                        <div class="col-sm">
                                            <select class="form-control" name="carCurrentPoss">
                                                @foreach ($memberships as $membership)
                                                    @if ($membership->carId == $car->id)
                                                        @foreach ($members as $member)
                                                            @if ($membership->userId == $member->id)
                                                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="hidden" name="carId" value="{{$car->id}}">
                                            <button class="btn btn-success form-control" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-2">
                                    <form method="POST" action="/cars/remove">
                                        @csrf
                                        <input class="form-control" type="hidden" name="carId" value="{{$car->id}}">
                                        <button class="btn btn-danger" type="submit">Remove Car</button>
                                    </form>
                                </div>
                                @else
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$car->brand}}
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$car->model}}
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$car->fuelCap}}
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$car->currentFuel}}
                                    </span>
                                </div>
                                <div class="col-sm">
                                    @foreach ($memberships as $membership)
                                        @if ($membership->carId == $car->id)
                                            @foreach ($members as $member)
                                                @if ($car->ownerId == $member->id && $stopPrint == 0)
                                                    <span class="input-group-text">
                                                        {{$member->name}}
                                                    </span>
                                                    @php
                                                        $stopPrint = 1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 32rem">
                        @if ($car->image == "default.jpg")
                            <img src="{{ $car->image }}" class="card-img-top" alt="car image">
                        @else
                            <img src="userimgs\{{ $car->image }}" class="card-img-top" alt="car image">
                        @endif
                        @if($car->ownerId == Auth::id())
                            <div class="card-body">
                                <form action="/upload-img" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="hidden" name="carId" value="{{$car->id}}">
                                    <div class="input-group mb-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" class="form-control" value="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger form-control">Upload new image</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @endforeach
</div>
@endsection
