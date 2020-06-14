@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'Members')
@section('dashcontent')

<div class="container-fluid">
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
                        @foreach ($carMembers as $carMember)
                        <tr>
                            @foreach ($allUsers as $currentUser)
                                @if($carMember->userId == $currentUser->id)
                                    <th scope="col">{{$currentUser->name}}</th>
                                @endif
                            @endforeach
                            <th scope="col">{{$carMember->debt}}{{$carMember->debtUnit}}</th>
                            <th scope="col">{{$carMember->lastRefuelAmount}}</th>
                            @if(isset($carMember->lastRefuelDate))
                                <th scope="col">{{$carMember->lastRefuelDate}}</th>        
                            @else
                                <th scope="col">Never refueled</th> 
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection