@extends('layouts.employer')
@section('content')
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="row">
                  <div class="col-md-8">
                     <div class="jl_add_new">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="jl_add_new_left">
                                 <img src="/images/plus_icor.png" alt="">
                                 <p> ADD NEW JOB LISTING</p>
                                 <a href="{{ route('employer.jobs.create') }}">START</a> 
                              </div>
                           </div>
                           <!-- <div class="col-md-6">
                              <div class="jl_add_new_right">
                                 <div class="jianr_top">
                                    <img src="/images/briefcase-ico.png" alt="">
                                    <div class="nja text-right">
                                       <h6>NEW JOB APPLICANTS</h6>
                                       <span>{{ $appliedJobApplicantTotal }}</span>
                                    </div>
                                 </div>
                                 <div class="jianr_bottom">
                                    <a href="#">VIEW ALL <span> > </span></a>
                                 </div>
                              </div>
                           </div> -->
                           <div class="jl_add_new_right">
                             <div class="jianr_top">
                                <img src="/images/briefcase-ico.png" alt="">
                                <div class="nja text-left">
                                   <h6>There are <b>{{ $commonService->cart()->count() }}</b> applicants in your <a href="{{ route('employer.carts.index') }}">SHOPPING cart.</a></h6>
                                </div>
                             </div>
                             <div class="jianr_bottom">
                                <a href="{{ route('employer.carts.index') }}">GO TO CHECKOUT <span> > </span></a>
                             </div>
                          </div>
                        </div>
                     </div>
                     <div class="pending_job">
                        <div class="pj_top">
                           <p>PENDING JOB APPLICANT REQUESTS <img src="/images/question-ico.png" alt=""></p>
                        </div>
                        <div class="pending_job_box">
                        
                           <!-- single listing row -->
                           @forelse($pendingLists as $pendingList)
                           <div class="single_pjb main-row" data-row-id="{{ $pendingList->id }}" data-job-id="{{ $pendingList->job->id}}" >
                              <div class="sp_id">
                                 <span>ID#</span>
                                 <p>{{ $pendingList->sender->id }}</p>
                              </div>
                              <div class="sp_name">
                                 <span>POSITION REQUESTED</span>
                                 <h4>{{ $pendingList->job->title }}</h4>
                              </div>
                              <div class="sp_cl">
                                 <span>CURRENT LOCATION</span>
                                 <p>{{ $pendingList->sender->details->city }}</p>
                              </div>
                              <div class="sp_ctl">
                                 <ul>
                                    <li><a href="{{ route('employer.jobs.show', $pendingList->job->id) }}">DETAILS</a></li>
                                    <li><a class="confirm-approved" data-toggle="modal" data-target="#requestModal">APPROVE</a></li>
                                    <li><a class="confirm-rejected" data-toggle="modal" data-target="#rejectModal">REJECT</a></li>
                                 </ul>
                              </div>
                           </div>
                           @empty
                              <p class="panel-body">Sorry! There is nothing to show here.</p>
                           @endforelse

                        </div>
                        @if($pendingLists->count() > 5)
                        <div class="pj_bottom">
                           <a href="#">VIEW ALL <span> > </span></a>
                        </div>
                        @endif
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="jl_right">
                        <div class="jl_right_bottom" style="margin-top: 0px;">
                           <div class="pj_top">
                              <p>EDUCATOR QUICK SEARCH <img src="/images/question-ico.png" alt=""></p>
                           </div>
                           <div class="jl_form">
                              <form action="{{ route('employer.eductor-quick-search') }}">
                                 <fieldset>
                                    <label for="keyword">Keyword <span>(such as Chemistry, Science, etc.)</span></label>
                                    <input type="text" name="s" id="keyword">
                                 </fieldset>
                                 <div class="two_col_fieldset">
                                    <fieldset>
                                       <label for="state">State</label>
                                       <select name="state" id="state">
                                          @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->short_name }}</option>
                                          @endforeach
                                       </select>
                                    </fieldset>
                                    <fieldset>
                                       <label for="salary">Salary Wanted</label>
                                       <select name="salary" id="amount">
                                          <!-- <option value="10000">$10,000+</option> -->
                                          <option value="20000">$20,000+</option>
                                          <option value="30000">$30,000+</option>
                                          <option value="40000">$50,000+</option>
                                       </select>
                                    </fieldset>
                                 </div>
                                 <button type="submit" >SEARCH</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
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
        @if(auth()->user()->getUser()->details->credit > 0 )
          <h2> Are you sure you want to approve this job request? </h2>
          <p>Approving this request will cost 1 credit from your credit balance.</p>
          <div class="approved-buttons">
            <button href="" class="yes-button job-approved">YES</button>
            <button href="" data-dismiss="modal" class="no-button">NO</button>
          </div>
        @else
          <p>Approving this request will cost 1 credit from your credit balance. </p>
          <div>Please <a href="{{ route('employer.buy.credit') }}"><h2 style="display: inline-block;"> buy </h2></a>  credit before approved a request. </div>
        @endif
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

        $(".job-approved").unbind();
        $(".job-approved").click(function(e)
        {

          e.preventDefault();

          var $this = $button;
          var main = $this.closest('.main-row')
          var actionId = main.data('row-id');
          var jobId    = main.data('job-id');

          loading();
          var url = baseUrl  + '/employer/jobs/'+ jobId +'/action/'+ actionId;
          $.ajax({
                   url: url,
                   type: 'POST',
                   data: { status : "approved", _token : '{{ csrf_token() }}' },
                   success: function(response) {
                      main.remove();
                      $('#requestModal').modal('hide');
                      $("#credit-score").html(function(index, val) { return  (parseInt(val) - 1) });
                     //window.location.href = window.location.href;
                   },
                   complete: function(){
                      loaded();
                   }
                });
          })

      });


      $('#rejectModal').on('show.bs.modal', function (event) {

        var $button = $(event.relatedTarget);

        $(".job-rejected").unbind();
        $(".job-rejected").click(function(e)
        {

          e.preventDefault();
          
          var $this = $button;
          var main = $this.closest('.main-row')
          var actionId = main.data('row-id');
          var jobId    = main.data('job-id');

          loading();
          var url = baseUrl  + '/employer/jobs/'+ jobId +'/action/'+ actionId;
          $.ajax({
                   url: url,
                   type: 'POST',
                   data: { status : "rejected", _token : '{{ csrf_token() }}' },
                   success: function(response) {
                      main.remove();
                      $('#rejectModal').modal('hide');
                   },
                   error: function(error){
                      //window.location.href = window.location.href;
                   },
                   complete: function(){
                      loaded();
                   }
                });
          })
      });

   })
</script>

@endpush