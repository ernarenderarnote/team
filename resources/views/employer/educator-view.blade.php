@extends('layouts.employer')
@section('content')
<style>
            .educator-view {    padding-left: 40px;    margin-bottom: 40px;}
            .view-re-box .btn-primary {    background-color: #22315f;    border-radius: 0;    font-size: 17px;    padding: 10px 30px;}
.view-re-box .btn-primary:hover {    background-color:#fff;color: #22315f;     }
          </style>
<div class="job_listing_area">
  <div class="container">
    <div class="row">
      <div class="job-detailspage">
        <div class="job-detailspageheader">
          <div class="col-md-5 job-detailsleft requets-contactdetailsleft">
            <h2> EDUCATOR APPLICANT </h2>
            <h5>#{{ $educator->id }}</h5>
          </div>
          <div class="col-md-3 job-detailsright">
            <h4>CURRENT REGION</h4>
            <h3>{{ $educator->details->region }}</h3>
          </div>
        </div>
        
        <div class="request-contactdetails">
          @include("employer.history.questionnaire")

          @if(!$isSendContact)
            @if(auth()->user()->getUser()->details->credit > 0)
            <div class="educator-view view-re-box"><a href="javascript:void(0)" class="btn btn-primary view-resume-btn"> View Resume</a></div>
            <div class="request-sender">
              <div class="requestcontact-buttontitle"><p>You are requesting this educator’s contact details. <br>
                  This educator will be alerted and will need to approve your request.</p></div>
              <div class="requestcontact-button">
                <a href="javascript:void()" class="request-contact"> REQUEST CONTACT DETAILS</a>
              </div>
            </div>
            @else
            <div class="educator-view view-re-box "><a href="javascript:void(0)" class="btn btn-primary view-resume-btn"> View Resume</a></div>
             <div class="text-center" style="margin-bottom: 20px;">
              <a href="" class="add-to-cartbutton" data-id="3" style="float: none;">ADD TO CART</a>
             </div>
            @endif
          @else
             <div class="educator-view view-re-box"><a href="{{ ($educator->details->resume) ? route('employer.educator.resume', $educator->id) : 'javascript:void(0)' }}" class="btn btn-primary view-resume-btn"> View Resume</a></div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(function(){

    $(".request-contact").click(function(e){
           
            var url = "{{ route('employer.educator.contact.request', $educator->id ) }}";
            loading();
            $.ajax({
               url: url,
               type: 'post',
               data: { action : "contact", _token : '{{ csrf_token() }}'  },
               success: function(response) {
                
                $(".request-sender").remove();
               },
               complete : function(res){
                 loaded();
               }
            });
        });

    $(".add-to-cartbutton").click(function(e){
               
      e.preventDefault();

      var $this = $(this);
      if($this.is(".added")){ return false; }
         
      var id =  $this.data("id");
      var url = "{{ route('employer.carts.store') }}";
      loading();

      $.ajax({
         url: url,
         type: 'POST',
         data: { educator_id : id, _token : '{{ csrf_token() }}'  },
         success: function(response) {
           $this.addClass("added").html("ADDED TO CART");
         },
         complete : function(res){
           loaded();
         }
      });
      
    });


  });


</script>
@endpush