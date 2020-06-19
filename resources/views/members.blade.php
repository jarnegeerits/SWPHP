@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
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
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-active">
                                <th scope="col">Name</th>
                                <th scope="col">Debt</th>
                                <th scope="col">Last Refuel in Liters</th>
                                <th scope="col">Date of last refuel</th>
                                @if($ownCar->ownerId == Auth::id())
                                <th scope="col">Edit</th>
                                <th scope="col">Remove</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allMemberships as $currentMembership)
                            @php
                                $stopPrint = 0;
                            @endphp
                            @if($currentMembership->carId == $ownCar->id)
                                <tr>
                                    @foreach ($allUsers as $currentUser)
                                        @if($currentMembership->userId == $currentUser->id && $stopPrint == 0)
                                            <th scope="col">{{$currentUser->name}}</th>
                                            @php
                                                $stopPrint = 1;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if($ownCar->ownerId == Auth::id())
                                        <form action="members/edit" method="POST">
                                            @csrf
                                            <th scope="col"><input class="form-control" type="number" name="memberDebt" id="memberDebt"
                                                value="{{$currentMembership->debt}}">
                                            </th>
                                            <th scope="col"><input class="form-control" type="number" name="memberRefuel" id="memberRefuel"
                                                value="{{$currentMembership->lastRefuelAmount}}">
                                            </th>
                                            @if(isset($currentMembership->lastRefuelDate))
                                                <th scope="col"><input class="form-control" type="date" name="memberRefuelDate" id="memberRefuelDate"
                                                    value="{{$currentMembership->lastRefuelDate}}">
                                                </th>
                                            @else
                                                <th scope="col"><input class="form-control" type="date" name="memberRefuelDate" id="memberRefuelDate"></th>
                                            @endif
                                            <th scope="col">
                                                <button class="btn btn-success" type="submit">Submit</button>
                                            </th>
                                        </form>
                                        <form action="members/remove" method="POST">
                                            @csrf
                                            <th>
                                                <input class="form-control" type="hidden" name="membershipId" value="{{$currentMembership->id}}">
                                                <button class="btn btn-danger" type="submit">Remove Member</button>
                                            </th>
                                        </form>
                                    @else
                                        <th scope="col">{{$currentMembership->debt}}{{$currentMembership->debtUnit}}</th>
                                        <th scope="col">{{$currentMembership->lastRefuelAmount}}</th>
                                        @if(isset($currentMembership->lastRefuelDate))
                                            <th scope="col">{{$currentMembership->lastRefuelDate}}</th>
                                        @else
                                            <th scope="col">Never refueled</th>
                                        @endif
                                    @endif
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>
@endsection
{{-- @foreach ($allMemberships as $currentMembership)
                                @if ($currentMembership->carId == $ownCar->id)
                                    @foreach ($allUsers as $currentUser)
                                    <tr>
                                        @if($currentMembership->userId == $currentUser->id)
                                            <th scope="col">{{$currentUser->name}}</th>
                                            <th scope="col">{{$currentMembership->debt}}{{$currentMembership->debtUnit}}</th>
                                            <th scope="col">{{$currentMembership->lastRefuelAmount}}</th>
                                            @if(isset($currentMembership->lastRefuelDate))
                                                <th scope="col">{{$currentMembership->lastRefuelDate}}</th>
                                            @else
                                                <th scope="col">Never refueled</th>
                                             @endif
                                        @endif
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach --}}
