@extends('layouts.educator')
@section('content')
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
                  <h2>APPROVED JOB OPPORTUNITIES</h2>
                  <p> You Have Approved {{ $approvedApplicants->count() }} Job Opportunities</p>
               </div>
               <div class="listing_box employer-searchmain employer-searchmain2">
                  @unless($approvedApplicants->isEmpty())
                  <!-- <div class="search-header">
                     <label>Sort by:</label>
                     <select id="date">
                        <option value="date">Date</option>
                     </select>
                  </div> -->
                  @endunless
                  <div class="employer-search1">
                     @forelse($approvedApplicants as $approvedApplicant)
                     <div class="col-md-9 searchtable">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>JOB POST</th>
                                 <th>NAME</th>
                                 <th>LOCATION</th>
                                 <th>MIN SALARY</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>{{ carbon($approvedApplicant->job->created_at)->format(config('global.date_format')) }}</td>
                                 <td>{{ $approvedApplicant->job->title }}</td>
                                 <td>{{ $approvedApplicant->job->city->name .', '. $approvedApplicant->job->state->short_name }}</td>
                                 <td>${{ number_format($approvedApplicant->job->pay_min) }}</td>
                              </tr>
                        </table>
                     </div>
                     <div class="col-md-3">  <a href="#" class="approved-request">APPROVED</a> <a href="" class="close close-icon"><i class="fa fa-close" aria-hidden="true"></i></a> </div>
                     @empty
                     <p class="panel-body"> Sorry! There is nothing to show here. </p>
                     @endforelse
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Login area-->
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
                  <h2>DENIED JOB OPPORTUNITIES</h2>
                  <p> You Have Rejected  {{ $rejectedApplicants->count() }} Job Opportunities</p>
               </div>
               <div class="listing_box employer-searchmain employer-searchmain2">
                  @unless($rejectedApplicants->isEmpty())
                  <!-- <div class="search-header">
                     <select id="date">
                        <option value="date">Date</option>
                     </select>
                  </div> -->
                  @endunless
                  <div class="employer-search1">
                     @forelse($rejectedApplicants as $rejectedApplicant)
                     <div class="col-md-9 searchtable">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>DATE POSTED</th>
                                 <th>JOB TITLE </th>
                                 <th>LOCATION</th>
                                 <th>SALARY</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>{{ carbon($rejectedApplicant->job->created_at)->format(config('global.date_format')) }}</td>
                                 <td>{{ $rejectedApplicant->job->title }}</td>
                                 <td>{{ $rejectedApplicant->job->city->name .', '. $rejectedApplicant->job->state->short_name }}</td>
                                 <td>${{ number_format($rejectedApplicant->job->pay_min) }}</td>
                              </tr>
                        </table>
                     </div>
                     <div class="col-md-3">  <a href="#" class="rejected-button">Rejected</a> <a href="" class="close close-icon"><i class="fa fa-close" aria-hidden="true"></i></a> </div>
                     @empty
                     <p class="panel-body"> Sorry! There is nothing to show here. </p>
                     @endforelse
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection