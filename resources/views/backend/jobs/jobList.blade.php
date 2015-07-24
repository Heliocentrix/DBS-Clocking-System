@extends('backend.includes.layout')

@section('title')
	Job
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable();
        } );
    </script>
@stop

@section('content')

	@include('frontend.includes.errors')

    <div class="add-user-form col-sm-12">
    	<div class="col-sm-3 col-sm-offset-1">
    		<h1>
                ADD JOB:
    		</h1>
    	</div>
    	<div class="col-sm-7 login-form">
    		{!! Form::open(['url' => '/admin/jobs', 'method' => 'POST']) !!}

    			<div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="number">Job Number:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="number" value="{{ old('number') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="screen_name">Screen Name:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="screen_name" value="{{ old('screen_name') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="address">Address:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="address" value="{{ old('address') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="postcode">Postcode:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="postcode" value="{{ old('postcode') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="contractor">Main Contractor:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="contractor" value="{{ old('contractor') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="form-group">
                	<div class="col-xs-3">
    	            	<label for="foreman">Foreman:</label>
                	</div>
                	<div class="col-xs-9">
    	                <input type="text" name="foreman" value="{{ old('foreman') }}" class="login-input">	            		
                	</div>
                </div>

                <div class="text-center">
                    <button class="submit-btn"></button>
                </div>


    		{!! Form::close() !!}
    	</div>
    </div>

    <div class="col-xs-12 col-xs-offset1">
        <h1 class="col-xs-offset-1">
            JOB NUMBER LOCATIONS:
         </h1>
        <div class="col-sm-8 col-sm-offset-2">
            <table id="datatables" class="table-responsive table-bordered table-hover"  class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>
                            Job Number
                        </th>
                        <th>
                            Main Contractor
                        </th>
                        <th>
                            Foreman
                        </th>
                        <th>
                            On Screen Name
                        </th>
                        <th>
                            Active
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td class="paddingLeft">
                                {{$job->number}}
                            </td>
                            <td class="paddingLeft">
                                {{$job->contractor}}
                            </td>
                            <td class="paddingLeft">
                                {{$job->foreman}}
                            </td>
                            <td class="paddingLeft">
                                {{$job->screen_name}}
                            </td>
                            <td class="text-center">
                                {!! Form::open(['url' => "/admin/jobs/$job->id", 'method' => 'PUT']) !!}
                                    @if($job->active)
                                        <button class="success-btn"></button>
                                    @else
                                        <button class="cross-btn"></button>
                                    @endif
                                {!! Form::close() !!}

                            </td>                            
                            <td class="text-center"> 
                                {!! Form::open(['url' => "/admin/jobs/$job->id", 'method' => 'DELETE']) !!}
                                    
                                    <button class="cross-btn"></button>
                                {!! Form::close() !!}
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="clear-float"></div>

@stop