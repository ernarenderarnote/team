
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
                                    <h3>Sign up today and take advantage of Team.Education tools such as: </h3>
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
                                       <img src="/images/step1.png" alt="">
                                   </div>
                                    <div class="login_box step1">
                                        <div class="login_header">
                                            <p><img src="/images/login-key.png" alt=""> Log into <span>Team.Education</span></p>
                                        </div>

                                        <form action="" method="post">
                                            {{ csrf_field() }}
                                            <fieldset>
                                                <label for="email">Email:</label>
                                                <input id="email" type="email" placeholder="Enter Your Email Address" name="email" value="{{ old('email', '') }}">
                                                @hasErrorMsg('email') 
                                            </fieldset>
                                            <fieldset>
                                                <label for="pass">Select a Password:</label>
                                                <input id="pass" type="password" placeholder="Enter Your Password" name="password">
                                                @hasErrorMsg('password') 
                                            </fieldset>
                                            <fieldset>
                                                <label for="pass">Retype your Password:</label>
                                                <input id="pass" type="password" placeholder="Retype your password" name="password_confirmation">
                                                @hasErrorMsg('password_confirmation') 
                                            </fieldset>
                                            <div class="submit_box">
                                                
                                                <div class="submit_right float-right">
                                                    <input type="submit" name="login" value="Next">
                                                </div>
                                            </div>
                                            <div class="donthaveaccount">
                                                <p>Already have an account? <a href="{{ route('auth.educator') }}">Sign in.</a></p>
                                            </div>
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
