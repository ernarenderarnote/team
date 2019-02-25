
@extends('layouts.employer')

@section('content')
<div class="job_listing_area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="job_listing_inner">
            <div class="jobl_header text-center">
              <h2>VIEW ALL TEAM MEMBERS</h2>
            </div>
            <div class="view-allmember">
              <div class="col-md-6 col-md-offset-3">
                <div class="member-innerright"> 
                  <h2 class="mb-2">CURRENT TEAM MEMBERS</h2>
                  @include('employer.teammate.list')
                </div>
              </div>
			     </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection