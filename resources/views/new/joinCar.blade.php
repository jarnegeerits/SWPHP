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
                    <form method="POST" action="/postjoincar">
                        @csrf

                        <div class="form-group row">
                            <label for="carJoin" class="col-md-4 col-form-label text-md-right">{{ __('Join a car') }}</label>

                            <div class="col-md-6">
                                <input id="carJoin" type="text" class="form-control" name="carJoin" required autofocus value="E-mail">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Join') }}
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
