
@extends('layouts.employer')

@section('content')
	<div class="job_listing_area">
		<div class="container">
		  <div class="row">
		    <div class="col-md-12">
		      <div class="job_listing_inner">
		        <div class="jobl_header text-center">
		          <h2>CONTACT TEAM.EDUCATION SUPPORT</h2>
		          <p class="search-text">Please allow 12-24 hours for a support person to reply.</p>
		        </div>
		        <div class="support-innersection">
		          <div class="support-form">
		            <form method="post" action="{{ route('employer.support.store') }}">
		              {{ csrf_field() }}
		              <div class="col-md-6 form-group">
		                <label>Email Address</label>
		                <input type="email" class="form-control" placeholder="johndoe@gmail.com" name="email" value="{{ old('email', auth()->user()->email) }}">
		                @hasErrorMsg('email')
		              </div>
		              <div class="col-md-6 form-group">
		                <label>Phone Number</label>
		                <input type="text" class="form-control" placeholder="Enter a phone number" name="phone" value="{{ old('phone') }}">
		                @hasErrorMsg('phone')
		              </div>
		              <div class="col-md-6 form-group">
		                <label>Subject</label>
		                <select class="form-control" id="subject" name="subject_id">
		                  <option value="">Select the subject of your question</option>
		                  @foreach($subjects as $subject)
		                  	<option value="{{ $subject->id }}">{{ $subject->subject }}</option>
		                  @endforeach
		                </select>
		                @hasErrorMsg('subject_id')
		              </div>
		              <div class="col-md-12 form-group">
		                <label>Message</label>
		                <textarea class="form-control" rows="6" name="message">{{ old('email') }}</textarea>
		                @hasErrorMsg('message')      
		              </div>
		              <div class="col-md-12 button-group"> <button type="submit">SEND THIS MESSAGE TO SUPPORT</button> </div>
		            </form>
		          </div>
		          <div class="contact-details">
		            <h2>Address:</h2>
		            <p>{{ $supports->values->address }}</p>
		            <h2>Support Email:</h2>
		            <p>{{ $supports->values->email }}</p>
		            <h2>Phone Support:</h2>
		            <p>{{ $supports->values->phone }}</p>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
@endsection