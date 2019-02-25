
@extends('layouts.employer')

@section('content')
	<div class="job_listing_area">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="job_listing_inner">
	                    <div class="jobl_header text-center">
	                        <h2>ADD A NEW JOB LISTING</h2>
	                    </div>

	                    <div class="listing_box">
	                        <h3>General Listing Settings</h3>
	                        
	                        <form action="{{ route('employer.jobs.store') }}" method="post">
	                        	{{ csrf_field() }}
	                        	<fieldset>
	                               <label for="jobtitle">Job Title</label>
	                               <input type="text" id="jobtitle" name="title" placeholder="Enter Job Title" value="{{ old('title') }}">
	                               @hasErrorMsg('title')
	                            </fieldset>
	                            <div class="two_col_fieldeset">
		                            <fieldset>
		                               <label for="jobtitle">Job type</label>
		                               <select name="job_type_id" id="job_state">
	                                       <option value="">Select Job Type</option>
	                                       @foreach($jobtypes as $jobtype)
	                                       		<option value="{{ $jobtype->id }}" @if(old('job_type_id') == $jobtype->id ) selected="selected" @endif >{{ $jobtype->name }}</option>
	                                       @endforeach
	                                   </select>
		                               @hasErrorMsg('job_type_id')
		                           </fieldset>
		                            <fieldset>
			                               <label for="datepicker">Application Deadline</label>
			                               <input type="text" id="datepicker" name="deadline" placeholder="Choose a End Date" value="{{ old('deadline') }}">
			                               @hasErrorMsg('deadline')
			                        </fieldset>
	                           </div>
	                            <div class="two_col_fieldeset">
	                            <fieldset>
	                               <label for="jobtitle">Job State</label>
	                               <select name="state_id" id="job_state">
                                       <option value="">Select Job State</option>
                                       @foreach($states as $state)
                                       		<option value="{{ $state->id }}" @if(old('state_id') == $state->id ) selected="selected" @endif >{{ $state->name }}</option>
                                       @endforeach
                                   </select>
	                               @hasErrorMsg('state_id')
	                           </fieldset>
	                           <fieldset>
	                               <label for="jobtitle">Job City</label>
	                               <select name="city_id" id="job_city">
                                       <option value="">Select Job City</option>
                                        @foreach($states as $state)
                                        <optgroup label="{{$state->name}}">
                                        	@foreach($state->city as $city)
                                       			<option value="{{ $city->id }}" @if(old('city_id') == $city->id ) selected="selected" @endif >{{ $city->name }}</option>
                                       		@endforeach
                                        </optgroup>
                                       @endforeach
                                   </select>
	                               @hasErrorMsg('city_id')
	                           </fieldset>
	                           </div>

	                            
	                           <div class="two_col_fieldeset">
	                            <fieldset>
                                   <label for="qualified">Category. </label>
                                   <select name="category_id" id="qualified">
                                      @foreach($categories as $pCategory)
                                      <optgroup label="{{ $pCategory->name }}">
                                        @foreach($pCategory->sub as $category)
                                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                      </optgroup>
                                      @endforeach
                                      @hasErrorMsg('category_id')
                                   </select>
                               </fieldset>
                                <fieldset>
                                   <label for="qualified">Grade. </label>
                                   <select name="grade_id" id="qualified">
                                     <option value="Kindergarten or Pre-K">Kindergarten or Pre-K</option>
                                     <option value="1st">1st</option>
                                     <option value="2nd">2nd</option>
                                     <option value="3rd">3rd</option>
                                     <option value="4th">4th</option>
                                     <option value="5th">5th</option>
                                     <option value="6th">6th</option>
                                     <option value="7th">7th</option>
                                     <option value="8th">8th</option>
                                     <option value="9th">9th</option>
                                     <option value="10th">10th</option>
                                     <option value="11th">11th</option>
                                     <option value="12th">12th</option>
                                     <option value="Does not apply to a grade">Does not apply to a grade</option>
                                   </select>
                                   @hasErrorMsg('grade_id')
                               </fieldset>
	                           </div>
	                           <div class="two_col_fieldeset">
	                               <fieldset>
	                                   <label for="jobtype">Salary or Hourly?</label>
	                                   <select name="pay_type" id="jobtype">
	                                       <option value="">Select one...</option>
	                                       <option value="salary" @if(old('pay_type') == 'salary') selected="selected" @endif >Salary</option>
	                                       <option value="hourly" @if(old('pay_type') == 'hourly')  selected="selected" @endif >Hourly</option>
	                                   </select>
	                                   @hasErrorMsg('pay_type')
	                               </fieldset>
	                               <fieldset class="pay-amount-wrapper">
	                                   <label for="jobtype">Select amount</label>
	                                   <!-- <input type="text" id="datepicker" name="pay_amount" placeholder="Enter amount" value="{{ old('pay_amount') }}"> -->

	                                  <select name="pay_amount" id="jobtype" class="pay_amount">
	                                        <option value="">Select one...</option>
		                                    <option salary value="20000-30000" @if(old('pay_amount') == '20000-30000') selected="selected" @endif > 20k – 30k</option>
											<option salary value="30000-40000" @if(old('pay_amount') == '30000-40000') selected="selected" @endif > 30k – 40k</option>
											<option salary value="40000-50000" @if(old('pay_amount') == '40000-50000') selected="selected" @endif > 40k – 50k</option>
											<option salary value="50000-60000" @if(old('pay_amount') == '50000-60000') selected="selected" @endif > 50k – 60k</option>
											<option salary value="60000-70000" @if(old('pay_amount') == '60000-70000') selected="selected" @endif > 60k – 70k</option>
											<option salary value="70000-80000" @if(old('pay_amount') == '70000-80000') selected="selected" @endif > 70k – 80k</option>
											<option salary value="80000-90000" @if(old('pay_amount') == '80000-90000') selected="selected" @endif > 80k – 90k</option>
											<option salary value="90000-100000" @if(old('pay_amount') == '90000-100000') selected="selected" @endif> 90k – 100k</option>
											<option salary value="100000" @if(old('pay_amount') == '100000') selected="selected" @endif > More than 100k</option>
											<option hourly value="20-30" @if(old('pay_amount') == '20-30') selected="selected" @endif > 20 – 30</option>
											<option hourly value="30-40" @if(old('pay_amount') == '30-40') selected="selected" @endif > 30 – 40</option>
											<option hourly value="40-50" @if(old('pay_amount') == '40-50') selected="selected" @endif > 40 – 50</option>
											<option hourly value="50-60" @if(old('pay_amount') == '50-60') selected="selected" @endif > 50 – 60</option>
											<option hourly value="60-70" @if(old('pay_amount') == '60-70') selected="selected" @endif > 60 – 70</option>
											<option hourly value="70-80" @if(old('pay_amount') == '70-80') selected="selected" @endif > 70 – 80</option>
											<option hourly value="80-90" @if(old('pay_amount') == '80-90') selected="selected" @endif > 80 – 90</option>
											<option hourly value="90-100" @if(old('pay_amount') == '90-100') selected="selected" @endif> 90 – 100</option>
											<option hourly value="100" @if(old('pay_amount') == '100') selected="selected" @endif > More than 100k</option>
	                                   </select>

	                                   @hasErrorMsg('pay_amount')
	                               </fieldset>
	                           </div>
	                           <h3>Job Description</h3>
	                           
	                           <fieldset>
	                               <label for="briefdescription">Enter a brief description of the job description. You will be able to add more later.</label>
	                               <textarea name="description" id="briefdescription" cols="30" rows="10" placeholder="Provide students with appropriate learning activities and experiences in the core academic subject area assigned to help them fulfill their potential for intellectual, emotional, physical, and social growth. Enable students to develop competencies and skills to function successfully in society.">{{ old('description') }}</textarea>
	                               @hasErrorMsg('description')
	                           </fieldset>
	                           
	                           <fieldset>
	                               <label for="education">Education / Certifications Needed:</label>
	                               <textarea name="education" id="education" cols="30" rows="10" placeholder="Provide students with appropriate learning activities and experiences in the core academic subject area assigned to help them fulfill their potential for intellectual, emotional, physical, and social growth. Enable students to develop competencies and skills to function successfully in society.">{{ old('education') }}</textarea>
	                               @hasErrorMsg('education')
	                           </fieldset>
	                           
	                           <fieldset>
	                               <label for="knowledge">Special Knowledge / Skills required: <span>Optional. Leave blank if none.</span></label>
	                               <textarea name="skills" id="knowledge" cols="30" rows="10">{{ old('skills') }}</textarea>
	                           </fieldset>
	                           
	                           <fieldset>
	                               <label for="information">Would you like to add additional information? <span>  Optional. Leave blank if none.</span></label>
	                               <textarea name="additional_information" id="information" cols="30" rows="10">{{ old('additional_information') }}</textarea>
	                           </fieldset>
	                           <input name="post-job" type="submit" value="POST JOB LISTING">
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@push('style')
<style type="text/css">

	.pay_amount[pay-type] [salary],
	.pay_amount[pay-type] [hourly]{
		display: none;
	}
	.pay_amount[pay-type="salary"] [salary],
	.pay_amount[pay-type="hourly"] [hourly]{
		display: block;
	}
</style>
@endpush
@push('js')

<script type="text/javascript">

	$(function(){

		// state;
		var $state = $('[name="state_id"]');
		var $city  = $('[name="city_id"]');
		var state = $state.val();
		function stateChanged(state)
		{
			$city.find("option:first").prop('selected', true);

			if(state) {
				$city.prop("disabled", false );
				$city.find('optgroup').hide().eq(parseInt(state)-1).show();
			}else{
				$city.prop("disabled", true );
			}
		}

		if(state)
			$city.find('optgroup').hide().eq(parseInt(state)-1).show();
		else
			stateChanged(state);

		$state.change(function(){
			stateChanged($(this).val());
		});


		var $payType = $('[name="pay_type"]');
		var $payAmount = $('.pay_amount');
		var $payAmountWrap =  $('.pay-amount-wrapper');

		function payTypeChanged(type)
		{
	
			$payAmount.find("option:first").prop('selected', true);
			if(type)
			{
				$payAmount.attr("pay-type", $payType.val());
			}
			else{
				$payAmount.attr("pay-type", '');
			}

		}

		if($payType.val()){
			$payAmount.attr("pay-type", $payType.val());
		}
		else{
			payTypeChanged($payType.val());
		}


		$payType.change(function(){
			payTypeChanged($(this).val());
		});

		

	});
</script>
@endpush

