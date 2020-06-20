@extends('layouts.app')
@section('title', 'Members')
@section('dashcontent')

<div class="container-fluid">
    @foreach ($ownCars as $ownCar)
        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h1 class="h3 mb-0 text-white">{{ $ownCar->brand }} {{ $ownCar->model }}</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <div class="col-sm">Name</div>
                            <div class="col-sm">Debt</div>
                            <div class="col-sm">Last Refuel</div>
                            <div class="col-sm">Date of last refuel</div>
                            @if($ownCar->ownerId == Auth::id())
                                <div class="col-sm">Edit</div>
                                <div class="col-sm">Remove</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($allMemberships as $currentMembership)
                        @php
                            $stopPrint = 0;
                        @endphp
                        @if($currentMembership->carId == $ownCar->id)
                            <div class="form-row">

                            @foreach ($allUsers as $currentUser)
                                @if($currentMembership->userId == $currentUser->id && $stopPrint == 0)
                                    <div class="col-sm"><span class="input-group-text">{{$currentUser->name}}</span></div>
                                    @php
                                        $stopPrint = 1;
                                    @endphp
                                @endif
                            @endforeach

                            @if($ownCar->ownerId == Auth::id())
                                <form class="col-sm-8" method="POST" action="/members/edit">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm">
                                            <input class="form-control" type="number" name="memberDebt" id="memberDebt" value="{{$currentMembership->debt}}">
                                        </div>
                                        <div class="col-sm">
                                            <input class="form-control" type="number" name="memberRefuel" id="memberRefuel" value="{{$currentMembership->lastRefuelAmount}}">
                                        </div>
                                        @if(isset($currentMembership->lastRefuelDate))
                                            <div class="col-sm">
                                                <input class="form-control" type="date" name="memberRefuelDate" id="memberRefuelDate" value="{{$currentMembership->lastRefuelDate}}">
                                            </div>
                                        @else
                                            <div class="col-sm">
                                                <input class="form-control" type="date" name="memberRefuelDate" id="memberRefuelDate">
                                            </div>
                                        @endif
                                        <div class="col-sm">
                                            <input class="form-control" type="hidden" name="membershipId" value="{{$currentMembership->id}}">
                                            <button class="btn btn-success form-control" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm">
                                    <form method="POST" action="/members/remove">
                                        @csrf
                                        <input class="form-control" type="hidden" name="membershipId" value="{{$currentMembership->id}}">
                                        <button class="btn btn-danger" type="submit">Remove Member</button>
                                    </form>
                                </div>
                            @else
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$currentMembership->debt}}{{$currentMembership->debtUnit}}
                                    </span>
                                </div>
                                <div class="col-sm">
                                    <span class="input-group-text">
                                        {{$currentMembership->lastRefuelAmount}}
                                    </span>
                                </div>
                                @if(isset($currentMembership->lastRefuelDate))
                                    <div class="col-sm">
                                        <span class="input-group-text">
                                            {{$currentMembership->lastRefuelDate}}
                                        </span>
                                    </div>
                                @else
                                    <div class="col-sm">
                                        <span class="input-group-text">
                                            Never refueled
                                        </span>
                                    </div>
                                @endif
                            @endif
                            </div>
                            <br>
                        @endif
                        @endforeach
                    </div>
                    @if($ownCar->ownerId == Auth::id())
                        <div class="card-footer">
                            <form action="/members/new" method="POST">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input class="form-control" type="email" name="email" id="email" required>
                                    <input class="form-control" type="hidden" name="carId" value="{{$ownCar->id}}">
                                    <button class="btn btn-success" type="submit">Add Member</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>
@endsection
