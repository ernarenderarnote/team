
@extends('layouts.employer')

@section('content')

<div class="job_listing_area employer-thankyousection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>YOU HAVE PLACED AN ORDER</h3>
        <img src="/images/thankyouicons.png">
        <h2>Your request for contact details was successful.</h2>
        <h4>Credits will be debited from your account after an educator
approves your contact request.</h4>
        <a href="{{ route('dashboard') }}" class="dashboard-back">&#8826;&#8826;Back To Dashboard</a> </div>
    </div>
  </div>
</div>
@endsection