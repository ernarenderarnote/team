
@extends('layouts.default')

@section('content')
<!-- Breadcumb area-->
	<div class="breadcumb_area">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="bc_inner">
	                    <p><span>Sign Up</span> for Educators</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	<!-- Login area-->
	<main class="login_container signup">
	    <div class="container">
	        <div class="row">
                <div class="col-md-12">
                    <div class="signup_inner">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="singup_detail">
                                    <h3>Sign up today and take advantage of 
Team.Education tools such as: </h3>
                                   <ul>
                                       <li>- Daily opportunities sent to your inbox</li>
                                       <li>- Search career opportunities easily online</li>
                                       <li>- Quickly apply for or reject job opportunities</li>
                                       <li>- Pre-screen yourself for the right career move </li>
                                   </ul>
                                   
                                   <p><span>Note:</span> There are 3 steps that you must complete in order to become pre-screened. By clicking the Next Button you will be taken through the pre-screening process. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="login_inner">
                                   <div class="login_steps">
                                       <img src="/images/step2.png" alt="">
                                   </div>
                                    <div class="login_box step2">
                                        <div class="login_header">
                                            <p><img src="/images/user.png" alt=""> Complete Your <span>Profile</span></p>
                                        </div>

                                        <form action="" method="post">
                                            {{ csrf_field() }}
                                            <fieldset>
                                               <p><b>Full Name: </b></p>
                                                <div class="name_field">
                                                    <div class="nf_left">
                                                        <label for="first-name">First Name</label>
                                                        <input id="first-name" type="text" value="{{ old('first_name') }}" placeholder="Your First Name" name="first_name">
                                                        @hasErrorMsg('first_name') 
                                                    </div>
                                                    <div class="nf_right">
                                                        <label for="first-name">Last Name</label>
                                                        <input id="last-name" type="text" value="{{ old('last_name') }}" placeholder="Your Last Name" name="last_name">
                                                        @hasErrorMsg('last_name') 
                                                    </div>
                                                </div>
                                            </fieldset>
                                             <fieldset>
                                                <p><b>Phone number</b></p>
                                                <input type="text" class="phone_us" placeholder="Phone number" value="{{ old('phone') }}" name="phone">
                                                @hasErrorMsg('phone') 
                                            </fieldset>
                                            <fieldset class="birth-signup2">
                                                <p><b>Date of Birth:</b></p>
                                                <!-- pattern="\d{1,2}/\d{1,2}/\d{4}" -->
                                                <div class="date-fields">
                                                    <select name="month">
                                                    <option value="">Month</option>
                                                    <option value="01" @if(old('month') == '01') selected="selected" @endif>January</option>
                                                    <option value="02" @if(old('month') == '02') selected="selected" @endif>February</option>
                                                    <option value="03" @if(old('month') == '03') selected="selected" @endif>March</option>
                                                    <option value="04" @if(old('month') == '04') selected="selected" @endif>April</option>
                                                    <option value="05" @if(old('month') == '05') selected="selected" @endif>May</option>
                                                    <option value="06" @if(old('month') == '06') selected="selected" @endif>June</option>
                                                    <option value="07" @if(old('month') == '07') selected="selected" @endif>July</option>
                                                    <option value="08" @if(old('month') == '08') selected="selected" @endif>August</option>
                                                    <option value="09" @if(old('month') == '09') selected="selected" @endif>September</option>
                                                    <option value="10" @if(old('month') == '10') selected="selected" @endif>October</option>
                                                    <option value="11" @if(old('month') == '11') selected="selected" @endif>November</option>
                                                    <option value="12" @if(old('month') == '12') selected="selected" @endif>December</option>
                                                    </select>
                                                </div>

                                                <div class="date-fields day-field">
                                                    <select name="day">
                                                        <option value=""> Day</option>
                                                        @for($i = 1; $i <= 31; $i++)
                                                            @php $di = ($i < 10) ? '0'.$i : $i;  @endphp
                                                            <option value="{{ $di }}" @if(old('day') == $di) selected="selected" @endif> {{ $di }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="date-fields year-field">
                                                    @php
                                                        $year = carbon()->now()->format("Y");
                                                    @endphp
                                                    <select name="year">
                                                        <option value="">Year</option>
                                                        @for($i= $year; $i >= 1905; $i-- )
                                                            <option value="{{ $i }}" @if(old("year") == $i) selected="selected" @endif>{{ $i }}</option>
                                                        @endfor
                                                    </select>

                                                </div>
                                                <div class="clearfix"></div>
                                                    @if($errors->has('month') || $errors->has('day') || $errors->has('year'))
                                                        <span class="help-block error">
                                                            <span>Date of birth is required</span>
                                                        </span>
                                                    @endif
                                                
                                                <!-- <input id="datepicker" type="text" class="datepicker" value="{{ old('date_of_birth') }}" name="date_of_birth" placeholder="mm/dd/yyyy"  /> -->
                                                {{--@hasErrorMsg('date_of_birth')--}}
                                            </fieldset>
                                            <fieldset>
                                                <p><b>Full Address</b></p>
                                                <label for="add1">Address 1</label>
                                                <input id="add1" type="text" placeholder="Your Full Address" value="{{ old('address') }}" name="address">
                                                @hasErrorMsg('address') 
                                            </fieldset>
                                            <fieldset>
                                                <label for="add2">Address 2 (Optional)</label>
                                                <input id="add2" type="text" name="address2" value="{{ old('address2') }}">
                                                @hasErrorMsg('address2')
                                            </fieldset>
                                            <fieldset>
                                                <div class="city_state">
                                                    <div class="city">
                                                        <label for="city">City</label>
                                                        <input id="city" type="text" name="city" value="{{ old('city') }}" placeholder="Your City">
                                                        @hasErrorMsg('city') 
                                                    </div>
                                                    <div class="State">
                                                        <label for="state">State</label>
                                                        <input id="state" type="text" name="state" value="{{ old('state') }}"  placeholder="XX">
                                                        @hasErrorMsg('state') 
                                                    </div>
                                                    <div class="zip">
                                                        <label for="zip">Zip Code</label>
                                                        <input id="zip" type="text" name="zipcode" value="{{ old('zipcode') }}" placeholder="12345">
                                                        @hasErrorMsg('zipcode') 
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="submit_box">
                                                
                                                <div class="submit_right float-right">
                                                    <input type="submit" name="login" value="Next">
                                                </div>
                                            </div>
                                            <!-- <div class="donthaveaccount">
                                                <p>I have an account? <a href="#">Sign Up.</a></p>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
	            
	        </div>
	    </div>
	</main>
@endsection

@push("js")
<script type="text/javascript" src="/js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.phone_us').mask('(000) 000-0000');
    })
</script>
@endpush