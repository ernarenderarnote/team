
@extends('layouts.employer')

@section('content')
<div class="job_listing_area">
	<div class="container">
	  <div class="row">
	    <div class="job-detailspage">
	      <div class="job-detailspageheader">
	        <div class="col-md-4 job-detailsleft">
	          <h4>JOB TITLE</h4>
	          <h3>{{ $job->title }}</h3>
	        </div>
	        <div class="col-md-3 job-detailsright">
	          <h4>Location</h4>
	          <h3>{{ $job->city->name.', '.$job->state->short_name }}</h3>
	        </div>
	      </div>
	      <div class="job-detailsmiddle">
	        <div class="col-md-1 info-image"> <img src="/images/info.png"> </div>
	        <div class="col-md-3 job-detailsmiddlecenter">
	          <p><strong>Job ID:</strong> {{ $job->id }}</p>
	          <p><strong>Apply Deadline:</strong>
		          @if($job->deadline)
	                {{ carbon($job->deadline)->format(config('global.date_format')) }}
	              @else
	                Posted until Filled
	              @endif
	          </p>
	          <p><strong>Posted:</strong> {{ carbon($job->created_at)->format(config('global.date_format2')) }}</p>
	        </div>
	        <div class="col-md-3 job-detailsmiddleright">
	          <p><strong>Position Type:</strong> <span class="postions-details">{{ $job->jobType->name }}</span></p>
	          <p><strong>Salary:</strong> <span class="postions-details">${{ number_format($job->pay_min) }} per {{
	          $job->pay_type == "salary" ? "yearly" : $job->pay_type
	          }}</span></p>
	        </div>
	      </div>
	      <div class="job-detailsbottom">
	        <h2>Job Description</h2>
	        <p>{{ $job->description }}</p>
	        <p><b>Education/Certification:</b></p>
	        <p> {{ $job->education }}</p>

	        @if($job->skills)
              <p><b>Special Knowledge/Skills:</b></p>
              <p>{{ $job->skills }}</p>
            @endunless

            @if($job->additional_information)
              <p><b>Experience:</b></p>
              <p>{{ $job->additional_information }}</p>
            @endunless
	        <!--<div class="apply-jobbutton">
	         <div class="apply-jobbutton"><a href="" data-toggle="modal" data-target="#applyModal">Apply For This job</a></div>
	        </div>-->
	      </div>
	    </div>
	  </div>
	</div>
</div>

@endsection

{{-- 
@push('js')

<script type="text/javascript">
	$(function(){

		    $('#applyModal').on('show.bs.modal', function (event) {

	        //var $button = $(event.relatedTarget);
	        var id = {{ $job->id }};

	        $(".apply-button").unbind();
	       
	        $(".apply-button").click(function(e){
	            e.preventDefault();
	            var url = '{{ route('educator.jobs.index') }}'  + '/'+id;
	             loading();
	            $.ajax({
	               url: url,
	               type: 'POST',
	               data: { action : "apply", _token : '{{ csrf_token() }}', "_method" :"PUT" },
	               success: function(response) {
	                 $("#applyModal").modal("hide");
	               },
                    complete: function(){
                      loaded();
                   }
	            });
	        });
	      });
	});
</script>

@endpush

@push('modal')

<div class="modal fade" id="applyModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
          <h2> You’re about to apply for this position. </h2>
          <p>If the employer approves your application, your contact information will be immediately shared with the employer. </p>
          <h5>To move forward, please select Apply now below.</h5>
          <div class="approved-buttons"><a href="" class="apply-button">Apply Now</a> <a href="" class="no-applybutton">DO NOT APPLY</a></div>
       </div>
    </div>
  </div>
</div>

@endpush --}}