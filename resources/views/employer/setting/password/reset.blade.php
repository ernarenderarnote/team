@extends('layouts.employer')
@section('content')

<div class="job_listing_area">
	<div class="container">

    	<div class="row">
        	<div class="col-md-6">
        		@if(session()->has('error'))
        		<div class="alert alert-danger">
				  {{ session()->get('error') }}
				</div>
				@endif
        		<form action="" method="POST">
        			{{ csrf_field() }}
					<div class="form-group">
						<label for="formGroupExampleInput">Old Password</label>
						<input type="password" class="form-control" placeholder="Old Password" name="old_password">
						@hasErrorMsg('old_password')
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">New Password</label>
						<input type="password" class="form-control" placeholder="New Password" name="password">
						@hasErrorMsg('password')
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">Confirm Password</label>
						<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
						@hasErrorMsg('password_confirmation')
					</div>
					<div class="form-group">
						 <button type="submit" class="btn btn-default">Submit</button>
					</div>
        		</form>
        	</div>
        </div>
    </div>
</div>

@endsection