@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'Dashboard')
@section('dashcontent')

<div class="container-fluid">
@foreach ($ownCars as $ownCar)
    @foreach ($ownMemberships as $ownMembership)
        @php
            $stopPrint = 0;
        @endphp
        @if ($ownCar->id == $ownMembership->carId)
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

                <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                        <h1 class="h3 mb-0 text-white">{{ $ownCar->brand }} {{ $ownCar->model }}</h1>
                    </div>
                </div>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->
            <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Last refuel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ownMembership->lastRefuelDate }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-black"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Current debt</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ownMembership->debtUnit }} {{ $ownMembership->debt }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas {{ $currencyIcon }} fa-2x text-black"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fuel</div>
                        <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($ownCar->currentFuel / $ownCar->fuelCap * 100) }}%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ number_format($ownCar->currentFuel / $ownCar->fuelCap * 100) }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-gas-pump fa-2x text-black"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Currently used by</div>
                            @foreach ($memberships as $membership)
                                @if ($membership->carId == $ownCar->id)
                                    @foreach ($members as $member)
                                        @if ($ownCar->currentPoss == $member->id && $stopPrint == 0)
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $member->name }}</div>
                                            @php
                                                $stopPrint = 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-key fa-2x text-black"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <br>
        @endif
    @endforeach
@endforeach
@endsection
