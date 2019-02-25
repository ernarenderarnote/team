@extends('layouts.educator')
@section('content')
<div class="job_listing_area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="job_listing_inner">
          <div class="jobl_header text-center">
            <h2>EDUCATION REJECTED REQUESTS</h2>
          </div>
          <div class="approved-requestlist">
            <table class="table">
              <thead>
                <tr>
                  <th> JOB TITLE</th>
                  <th>LOCATION</th>
                  <th>SALARY</th>
                </tr>
              </thead>
              <tbody>
                @forelse($userActions as $userAction)
                <tr>
                  <td>{{ $userAction->job->title }}</td>
                  <td>{{ $userAction->job->state->short_name }}</td>
                  <td>${{ number_format($userAction->job->pay_min) }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3"> Sorry! There is nothing to show here. </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection