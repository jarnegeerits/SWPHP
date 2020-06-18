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
                                    <th scope="col">{{$currentMembership->debt}}{{$currentMembership->debtUnit}}</th>
                                    <th scope="col">{{$currentMembership->lastRefuelAmount}}</th>
                                    @if(isset($currentMembership->lastRefuelDate))
                                        <th scope="col">{{$currentMembership->lastRefuelDate}}</th>
                                    @else
                                        <th scope="col">Never refueled</th>
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
