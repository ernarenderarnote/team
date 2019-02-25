@extends('layouts.educator')
@section('content')
<div class="job_listing_area">
   <div class="dashboard-educatetop">
      <div class="container">
         <div class="row">
            <div class="col-md-4 dashboard-educatetopinner">
               <div class="educatetop-innertop">
                  <div class="col-md-4"> <img src="/images/briefcase-ico.png"> </div>
                  <div class="col-md-8 text-right">
                     <h2>New Job Opportunities</h2>
                     <h1>{{ $jobCount }}</h1>
                  </div>
               </div>
               <div class="educatetop-innerbottom">
                  <p><a href="{{ route('educator.jobs.index', ['type' =>'newjob']) }}">VIEW ALL<span class="left-arrow">></span></a></p>
               </div>
            </div>
            <div class="col-md-4 dashboard-educatetopinner">
               <div class="educatetop-innertop">
                  <div class="col-md-4"> <img src="/images/approvedrequest.png"> </div>
                  <div class="col-md-8 text-right">
                     <h2>APPROVED REQUESTS</h2>
                     <h1>{{ $approvedCount }}</h1>
                  </div>
               </div>
               <div class="educatetop-innerbottom">
                  <p><a href="{{ route('educator.jobs.status', 'approved') }}">VIEW ALL<span class="left-arrow">></span></a></p>
               </div>
            </div>
            <div class="col-md-4 dashboard-educatetopinner">
               <div class="educatetop-innertop">
                  <div class="col-md-4"> <img src="/images/rejctedrequest.png"> </div>
                  <div class="col-md-8 text-right">
                     <h2>REJECTED REQUESTS</h2>
                     <h1>{{ $rejectedCount }}</h1>
                  </div>
               </div>
               <div class="educatetop-innerbottom">
                  <p><a href="{{ route('educator.jobs.status', 'rejected') }}">VIEW ALL<span class="left-arrow">></span></a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="dashboard-educatemiddle">
      <div class="container">
         <div classs="row">
            <div class="col-md-8 dashboard-educatemiddleleft">
               <h2> PENDING CONTACT REQUESTS <img src="/images/question-ico.png"></h2>
                
              @forelse($pendingContactRequests as $pendingContactRequest)
              
              <div class="dashboard-educatemiddleodd main-row" data-row-id="{{ $pendingContactRequest->id }}">
                <div class="dashboard-midletable dashboard-middlecontent">
                   <p>An Employer in <b>{{ $pendingContactRequest->employer->details->city or ''}}, {{ $pendingContactRequest->employer->details->state or '' }} </b>has requested your contact information.</p>
                </div>
                <div class="dashboard-middlebutton">
                  <a href="" class="approve-link" data-toggle="modal" data-target="#requestModal">APPROVE</a>
                  <a href="" data-target="#rejectModal" data-toggle="modal" class="reject-link">REJECT</a>
                </div>
              </div>

              {{--<div class="dashboard-educatemiddleodd main-row" data-row-id="{{ $pendingList->id }}" data-job-id="{{ $pendingList->job->id}}">
                  <div class="dashboard-midletable">
                     <table>
                        <thead>
                           <tr>
                              <th> JOB TITLE</th>
                              <th>LOCATION</th>
                              <th>SALARY</th>
                           </tr>
                           <tr>
                              <td>{{ $pendingList->job->title }}</td>
                              <td>{{ 'Tx '.$pendingList->job->job_city }}</td>
                              <td>${{ number_format($pendingList->job->pay_amount) }}</td>
                           </tr>
                        </thead>
                     </table>
                  </div>
                  <div class="dashboard-middlebutton">
                  <a href="{{ route('educator.jobs.show', $pendingList->job->id) }}" class="job-detaillink">JOB DETAILS</a>
                  <a href="" class="approve-link" data-toggle="modal" data-target="#requestModal">APPROVE</a>
                  <a href="" data-target="#rejectModal" data-toggle="modal" class="reject-link">REJECT</a> </div>
               </div>--}}
               @empty
                  <p class="panel-body"> Sorry! There is nothing to show here.</p>
               @endforelse

               @if($pendingContactRequests->count() < -1)
                  <div class="educatetop-innerbottom">
                      <p><a href="">VIEW ALL<span class="left-arrow">></span></a></p>
                  </div>
                @endif
               
            </div>
            <div class="col-md-4 dashboard-educatemiddleright">
               <h2> JOB QUICK SEARCH <img src="/images/question-ico.png"></h2>
               <div class="dashboard-educationrightform">
                  <form method="get" action="{{ route('educator.jobs.index')}}">
                     <div class="form-group">
                        <label>Keyword<span class="keyword-inner">(such as Chemistry, Science, etc)</span></label>
                        <input type="text" class="form-control" name="s">
                     </div>
                     <div class="form-statefields">
                        <div class="form-group second-field">
                           <label>State</label>
                           <select class="form-control" id="state" name="state">
                              @foreach($states as $state)
                                 <option value="{{ $state->id }}">{{ $state->short_name }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group second-field">
                           <label>Salary Range</label>
                           <select class="form-control" id="salary" name="atleast">
                             <!--  <option value="10000">$10,000+</option> -->
                              <option value="20000">$20,000+</option>
                              <option value="30000">$30,000+</option>
                              <option value="40000">$40,000+</option>
                              <option value="50000">$50,000+</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Date Posted</label>
                           <input type="text" class="form-control date-images" id="datepicker" name="created_at">
                        </div>
                     </div>
                     <div class="search-button"><button type="submit">SEARCH </button></div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('modal')
<!--approve request modal here-->
<div class="modal fade" id="requestModal" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2> Are you sure you want to approve this job request? </h2>
        <p>Approving this request will share your contact information with the employer.</p>
        <div class="approved-buttons">
          <button href="" class="yes-button job-approved">YES</button>
          <button href="" data-dismiss="modal" class="no-button">NO</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!--reject request modal here-->
<div class="modal fade rejectapprove-modal" id="rejectModal" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2> Are you sure you want to reject this job request? </h2>
        <p>Approving this request will share your contact information with the employer.</p>
        <div class="approved-buttons">
          <a href="" class="yes-button job-rejected">YES</a>
          <a href="" class="no-button" data-dismiss="modal">NO</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush

@push('js')

<script type="text/javascript">
   $(function(){

    
      $('#requestModal').on('show.bs.modal', function (event) {

        var $button = $(event.relatedTarget);

        var approvedCallback = function(e)
          {

            e.preventDefault();
            var $this = $button;
            var main = $this.closest('.main-row')
            var actionId = main.data('row-id');

            var url = '{{ route("educator.contact.request")}}' + "/" + actionId;
            loading();
            $.ajax({
                     url: url,
                     type: 'POST',
                     data: { status : "approved", _token : '{{ csrf_token() }}' },
                     success: function(response) {
                        main.remove();
                        $('#requestModal').modal("hide")
                       //window.location.href = window.location.href;
                     },
                      complete: function(){
                        loaded();
                     }
                  });
        };

        $(".job-approved").unbind(approvedCallback).click(approvedCallback);

      })
     
      


      $('#rejectModal').on('show.bs.modal', function (event) {

        var $button = $(event.relatedTarget);

        var rejectedCallback = function(e)
        {

          e.preventDefault();
          
          var $this = $button;
          var main = $this.closest('.main-row')
          var actionId = main.data('row-id');

          var url = '{{ route("educator.contact.request")}}' + "/" + actionId;
          loading();
          $.ajax({
                   url: url,
                   type: 'POST',
                   data: { status : "rejected", _token : '{{ csrf_token() }}' },
                   success: function(response) {
                      main.remove();
                      $('#rejectModal').modal("hide");
                   },
                    complete: function(){
                      loaded();
                   }
                });
          }

        $(".job-rejected").unbind(rejectedCallback).click(rejectedCallback);
      });

   })
</script>

@endpush