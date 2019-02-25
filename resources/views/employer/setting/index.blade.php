@extends('layouts.employer')
@section('content')
<style type="text/css">

.main-row .editing-link, 
.main-row .setting-form,
.main-row.editing .eEditing{
	display: none;
}
.main-row.editing .editing-link, 
.main-row.editing .setting-form{
	display: block;
}

</style>
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
                  <h2>EMPLOYER SETTINGS</h2>
               </div>
               <div class="employersetting-inner">
                  <div class="col-md-7 first-settingsection contactedit-listmain">
                     <h2 class="contact-heading">Contact Details</h2>
                     <a href="{{ route('employer.password.reset') }}" class="reset-password">RESET PASSWORD</a>
                     <div class="setting-detailssection">
                        <p>Note: Your contact details will be sent to employers when you are approved for a job opportunity.</p>
                        <div class="main-row">
                           <div class="edit-fields">
                              <h4> <span class="field-name">Name: </span>
                                 <span class="editfields-content"> {{ auth()->user()->name }}</span> 
                                 <span class="editing-link"><a >Editing</a></span>
                                 <span class="edit-link form-edit"><a href="#" class="edit-link eEditing">Edit</a></span>
                              </h4>
                           </div>
                           <div class="setting-form" id="nameform">
                              <form id="editNameForm">
                                 <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->first_name }}" required="required" name="first_name">
                                 </div>
                                 <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->last_name }}" required="required" name="last_name">
                                 </div>
                                 <div class="button-group"> <button type="submit"> SAVE</button> </div>
                              </form>
                           </div>
                        </div>
                        <div class="main-row">
                           <div class="edit-fields">
                              <h4> <span class="field-name"> Email Address: </span>
                                 <span class="editfields-content"> {{ auth()->user()->email }} </span>
                                 <span class="editing-link"><a href="#">Editing</a></span>
                                 <span class="edit-linkblue"><a href="#" class="eEditing" id="edit-email">Edit</a></span>
                              </h4>
                           </div>
                           <div class="setting-formemail setting-form" id="emailform1">
                              <form id="emailForm">
                                 <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required="required">
                                 </div>
                                 <div class="button-group"> <button type="submit">SAVE</button>  </div>
                              </form>
                           </div>
                        </div>
                        <div class="main-row">
                           <div class="edit-fields">
                              <h4>
                              	 <span class="field-name"> Birthdate: </span>
                                 <span class="editfields-content">{{ carbon(auth()->user()->date_of_birth)->format(config('global.date_format2'))}}</span>
                                 <span class="editing-link"><a href="#">Editing</a></span>
                                 <span class="edit-linkblue"><a href="#" id="edit-birthdate" class="eEditing">Edit</a></span>
                              </h4>
                           </div>
                           <div class="setting-formemail setting-form">
                              <form method="post" action="#" id="birthDateForm">
                                 <div class="form-group">
                                    <label> Birthdate:</label>

                                    @php 
                                    	$month = carbon(auth()->user()->date_of_birth)->format('m');
                                    	$day = carbon(auth()->user()->date_of_birth)->format('d');
                                    	$year = carbon(auth()->user()->date_of_birth)->format('Y');
                                    @endphp

                                    <select name="month" required="">
	                                    <option value="">Month</option>
	                                    <option value="01" @if($month == '01') selected="selected" @endif>January</option>
	                                    <option value="02" @if($month == '02') selected="selected" @endif>February</option>
	                                    <option value="03" @if($month == '03') selected="selected" @endif>March</option>
	                                    <option value="04" @if($month == '04') selected="selected" @endif>April</option>
	                                    <option value="05" @if($month == '05') selected="selected" @endif>May</option>
	                                    <option value="06" @if($month == '06') selected="selected" @endif>June</option>
	                                    <option value="07" @if($month == '07') selected="selected" @endif>July</option>
	                                    <option value="08" @if($month == '08') selected="selected" @endif>August</option>
	                                    <option value="09" @if($month == '09') selected="selected" @endif>September</option>
	                                    <option value="10" @if($month == '10') selected="selected" @endif>October</option>
	                                    <option value="11" @if($month == '11') selected="selected" @endif>November</option>
	                                    <option value="12" @if($month == '12') selected="selected" @endif>December</option>
	                                </select>
	                                <select name="day" required="">
	                                    <option value=""> Day</option>
	                                    @for($i = 1; $i <= 31; $i++)
	                                        @php $di = ($i < 10) ? '0'.$i : $i;  @endphp
	                                        <option value="{{ $di }}" @if($day == $di) selected="selected" @endif> {{ $di }}</option>
	                                    @endfor
	                                </select>
	                                <select name="year" required="">
	                                    <option value="">Year</option>

	                                    @for($i= $year; $i >= 1905; $i-- )
	                                        <option value="{{ $i }}" @if($year == $i) selected="selected" @endif>{{ $i }}</option>
	                                    @endfor
	                                </select>
                                 </div>
                                 <div class="button-group"> <button type="submit">SAVE</button> </div>
                              </form>
                           </div>
                        </div>
                        <div class="main-row">
                        	<div class="edit-fields">
	                           <h4>
	                             <span class="field-name"> Gender: </span>
	                             <span class="editfields-content">{{ auth()->user()->details->gender  }}</span>
	                             <span class="editing-link"><a href="#">Editing</a></span>
	                             <span class="edit-linkblue"><a href="#" id="edit-gender" class="eEditing">Edit</a></span> </h4>
	                        </div>
	                        <div class="setting-formemail setting-form">
	                           <form method="post" action="#" id="genderForm">
	                              <div class="form-group">
	                                 <label>Gender:</label>
	                                 <label class="radio-inline">
	                                 <input type="radio" name="gender" value="male" @if(auth()->user()->details->gender == 'male') checked @endif>
	                                 Male</label>
	                                 <label class="radio-inline">
	                                 <input type="radio" name="gender" value="female" @if(auth()->user()->details->gender == 'female') checked @endif>
	                                 Female</label>
	                              </div>
	                              <div class="button-group"> <button type="submit"> Save </button>  </div>
	                           </form>
	                        </div>
                        </div>

                        <div class="main-row">
                        	<div class="edit-fields">
	                           <h4>
	                           	<span class="field-name"> Address: </span>
	                           	@php 
	                           		$details =  auth()->user()->details;
	                           	@endphp
	                            <span class="editfields-content">{{ 
		                            $details->address.' '.
		                            $details->address2.', '.
		                            $details->city.', '.
		                            $details->state.", ".
		                            $details->zipcode
	                            }} </span><span class="edit-linkblue">
	                            <span class="editing-link"><a href="#">Editing</a></span>
	                            <a href="#" id="edit-address" class="eEditing">Edit</a></span> </h4>
	                        </div>
	                        <div class="setting-formemail setting-form">
	                           <form method="post" action="#" id="addressForm">
	                              <div class="form-group">
	                                 <label>Address:</label>
	                                 <input type="text" class="form-control" name="address" required="" value="{{  $details->address }}">
	                                 
	                              </div>
	                              <div class="form-group">
	                                 <label>Address 2 (Optional):</label>
	                                 <input type="text" class="form-control" name="address2" value="{{  $details->address2 }}">
	                                 
	                              </div>
	                              <div class="form-group">
                                     <div class="city">
                                         <label for="city">City</label>
                                         <input id="city" type="text" class="form-control" required="required" name="city" value="{{  $details->city }}" placeholder="Your City" >
                                          
                                     </div>
	                              </div>
                                 <div class="form-group">
                                    <div class="State">
                                            <label for="state">State</label>
                                            <input id="state" type="text" class="form-control" required="required" name="state" value="{{  $details->state }}" placeholder="XX">
                                             
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="zip">
                                         <label for="zip">Zip Code</label>
                                         <input id="zip" type="text" class="form-control" required="required" name="zipcode" value="{{  $details->zipcode }}" placeholder="12345">
                                          
                                    </div>
                                 </div> 
	                              <div class="form-group"> <button type="submit"> SAVE </button>  </div>
	                           </form>
	                        </div>
                        </div>

                        <div class="notifications-settings">
                           <h2>NOTIFICATION SETTINGS</h2>
                           <form action="post" action="" id="notifications">
                              {{ csrf_field() }}
                              @php 
                                 $notifications = is_array($details->notifications) ? $details->notifications : [];
                              @endphp
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" value="1" name="notifications[applyforjob]" @if(array_key_exists('applyforjob',$notifications) && $notifications['applyforjob']) checked @endif>
                                 Notify me when someone applies for my position</label>
                              </div>
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" value="1" name="notifications[approvedforjob]" @if(array_key_exists('approvedforjob',$notifications) && $notifications['approvedforjob']) checked @endif>
                                 Notify me when someone approves my position offer</label>
                              </div>
                              <div class="checkbox disabled">
                                 <label>
                                 <input type="checkbox" value="1" name="notifications[rejectedforjob]" @if(array_key_exists('rejectedforjob',$notifications) && $notifications['rejectedforjob']) checked @endif>
                                 Notify me when someone rejects my position offer</label>
                              </div>
                              <div class="my-changesbutton"> <input type="submit" value="I’M DONE WITH MY CHANGES" /> </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="secondsection">
                        <h2>ADD TEAM MEMBERS</h2>
                        <div class="team-membereven">
                            @include('employer.teammate.list')
                        </div>
                        <div class="teamnewmemberlinks"> <a href="{{ route('employer.teammates.create') }}">ADD NEW TEAM MEMBER</a><br>
                           <a href="{{ route('employer.teammates.index') }}">View All members</a>
                        </div>
                     </div>
                     <div class="secondsection savedcreditcardsection">
                        <h2>SAVED CREDIT CARDS  <a data-toggle="modal" data-target="#myModal" class="addcard-link" >ADD CARD</a></h2>

                        @inject("commonSvc", "App\Services\CommonService")
                        @inject("heplerSvc", "App\Helper\Common")
                        @php 
                           $cards = $commonSvc->cards();
                        @endphp
                        @forelse($cards as $card)
                        <div>
                           <span class="visa-icon">
                              <img src="/images/{{ $heplerSvc->validatecard($card->card_number) }}.jpg">
                           </span>
                           <span class="visa-text">  
                           <span class="visa-dots">
                              <sup>{{ str_pad(substr($card->card_number, -3), 16, "*", STR_PAD_LEFT) }}</sup>
                           </span>
                           <br>
                              Expires {{$card->expiry_month}}/{{$card->expiry_year}}
                           </span>
                           <span class="visa-links addcard-link">
                              <a href="{{ route('employer.cards.edit', $card->id) }}" >EDIT CARD</a><br>
                             
                           </span> 
                        </div>
                        @empty
                           Sorry! There is nothing to show here.
                        @endforelse
                        
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@push('js')
<script type="text/javascript">
   $(function(){
   
   	$options = {};
   	$options.errorsWrapper =  '<ul class="parsley-errors-list"></ul>';
   
   	function updateSettings(data, success)
   	{
   		data._token = '{{ csrf_token() }}';
         data._method = 'PUT';

   		var url = '{{ route("employer.settings.update", auth()->user()->id) }}';

         loading();
   		$.ajax({
                 url: url,
                 type: 'POST',
                 data: data,
                 success: success,
                 complete: function(){
                      loaded();
                 }
              });
   	}
   
   
   	$("#editNameForm,#emailForm,#birthDateForm,#genderForm,#addressForm,#notifications").parsley($options);
   
   	$('#editNameForm,#emailForm,#birthDateForm,#genderForm,#addressForm,#notifications').submit(function(e){
   
   		e.preventDefault();

   		var $this = $(this);
   		var $mainRow = $this.closest(".main-row");
         
   		if($this.parsley().validate())
   		{
   		   var data = formToJson($this.serializeArray());
   		   updateSettings(data, function(res){

   		   		if($this.is("#editNameForm"))
   		   			$mainRow.find(".editfields-content").text(res.first_name +' '+ res.last_name);

   		   		if($this.is("#emailForm"))
   		   			$mainRow.find(".editfields-content").text(res.email);

   		   		if($this.is('#birthDateForm'))
   		   			$mainRow.find(".editfields-content").text( moment(new Date(res.date_of_birth.date)).format("{{ config('global.mdate_format2')}}"));

   		   		if($this.is('#genderForm'))
   		   			$mainRow.find(".editfields-content").text(res.details.gender);

   		   		if($this.is('#addressForm'))
   		   		{

   		   			var details = res.details;
   		   			var address = details.address+' '+ details.city+', '+ details.state+", "+ details.zipcode

   		   			$mainRow.find(".editfields-content").text(address);
   		   		}

   		   		$mainRow.toggleClass('editing');
   		   });
   		}
   		
   	});
   	

	$(".eEditing").click(function(e){
		e.preventDefault();
		$(this).closest('.main-row').toggleClass('editing');
	});


    var hasModalOpen =  "{{ old('type') }}";
    if( hasModalOpen ) { $("#myModal").modal("show"); }
   
   });
</script>
@endpush

@push('modal')
<!--order-modal start here-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      @include("employer.card.create")
    </div>
  </div>
</div>
<!--order-modal end here--> 
@endpush