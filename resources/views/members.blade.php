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
                        @foreach ($members as $member)
                        <tr>
                        @foreach ($users as $user)
                                @if($member->userId == $user->id)
                                <th scope="col">{{$user->name}}</th>
                                @endif
                            @endforeach
                            <th scope="col">{{$member->debt}}{{$member->debtUnit}}</th>
                            <th scope="col">{{$member->lastRefuelAmount}}</th>
                            @if(isset($member->lastRefuelDate))
                                <th scope="col">{{$member->lastRefuelDate}}</th>        
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