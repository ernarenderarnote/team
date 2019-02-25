@extends('layouts.employer')
@section('content')
<style>
    .hisroty-page {    padding-top: 90px;}            
    .view-re-box .btn-primary {    background-color: #22315f;    border-radius: 0;    font-size: 17px;    padding: 10px 30px;}
    .view-re-box .btn-primary:hover {    background-color:#fff;color: #22315f;     }

          </style>
<div class="job_listing_area">
    <div class="container">
      <div class="row">
        <div class="job-detailspage">
          <div class="job-detailspageheader">
            <div class="print-icons"><a href="javascript:window.print()"><img src="/images/printdetails.png"></a></div>
            <h2 class="details-nameheading">{{ $educator->name}}</h2>
          </div>

          <div class="view-detailsmiddle"> <a href="" class="printDiv" ><img src="/images/view-detialsicons.png"></a>
            <div class="details-section">
              <p><b>Name:</b> {{ $educator->name}}</p>
              <p><b>Email Address:</b><span class="email-text"> {{ $educator->email}}</span></p>
              <p><b>Phone Number:</b> {{ $educator->details->phone }}</p>
              <p><b>Address:</b> <br>
              	{{ $educator->details->address}}<br>
                {{ $educator->details->city }}, {{ $educator->details->state }} {{ $educator->details->zipcode }}</p>
            </div>
          </div>
          <div class="hisroty-page view-re-box text-center"><a href="{{ ($educator->details->resume) ? route('employer.educator.resume', $educator->id) : 'javascript:void(0)' }}" class="btn btn-primary view-resume-btn"> View Resume</a></div>

          <div class="request-contactdetails">
            @include("employer.history.questionnaire")
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection