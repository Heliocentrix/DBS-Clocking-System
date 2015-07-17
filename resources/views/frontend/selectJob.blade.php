@extends('frontend.includes.layout')

@section('title')
	Sign In
@stop

@section('scripts')

@stop

@section('content')

	<div class="op-name text-center">
		{{Auth::user()->name}}
	</div>

	@include('frontend.includes.errors')

	{!! Form::open(['url' => '/signin', 'method' => 'POST']) !!}

		<div class="form-group text-center">

			{!! Form::label('job_id', 'Job Number:') !!}

			{!! Form::select('job_id', [null => 'Select Job'] + $jobs->all()) !!}

		</div>

		<div class="form-group text-center">

			{!! Form::label('hour_type_id', 'Hour Type:') !!}

			{!! Form::select('hour_type_id', [null => 'Hour Type'] + $hourTypes->all()) !!}

		</div>

		<div class="text-center">
            <button class="signin-btn">
              
            </button>
        </div>


	{!! Form::close() !!}

@stop