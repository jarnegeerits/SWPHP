@extends('layouts.app')
{{-- @include('sweetalert::alert') --}}
@section('title', 'New Car')
@section('dashcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Car') }}</div>

                <div class="card-body">
                    <form method="POST" action="/postnewcar">
                        @csrf

                        <div class="form-group row">
                            <label for="carBrand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                            <div class="col-md-6">
                                <input id="carBrand" type="text" class="form-control" name="carBrand" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carModel" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>

                            <div class="col-md-6">
                                <input id="carModel" type="text" class="form-control" name="carModel" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carFuelCap" class="col-md-4 col-form-label text-md-right">{{ __('Fuel Capacity') }}</label>

                            <div class="col-md-6">
                                <input id="carFuelCap" type="number" class="form-control" name="carFuelCap" value="100" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carCurrentFuel" class="col-md-4 col-form-label text-md-right">{{ __('Current Fuel level') }}</label>

                            <div class="col-md-6">
                                <input id="carCurrentFuel" type="number" class="form-control" name="carCurrentFuel" value="50" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="carFuelUnit" class="col-md-4 col-form-label text-md-right">{{ __('Fuel Unit') }}</label>

                            <div class="col-md-6">
                                <input id="carFuelUnit" type="text" class="form-control" name="carFuelUnit" value="L" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Submit New Car') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
