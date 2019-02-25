
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
                                       <img src="/images/step3.png" alt="">
                                   </div>
                                    <div class="login_box step3">
                                        <div class="login_header">
                                            <p><img src="/images/succ.png" alt=""> Complete Your <span>Questionnaire</span></p>
                                        </div>

                                        <div class="succ_inner text-center">
                                            <p>You will now be taken to another page to complete the questionnaire. Click the button below to begin. </p>
                                            <span class="completion-time">Completion Time: 10 minutes</span>
                                            
                                            <a href="{{ route('signup.educator.questionnaire') }}">Next</a>
                                            
                                            <span class="note">
                                                Note: You can complete the questionnare at a later date, but you must complete the questionnaire in order to apply for positions.
                                            </span>
                                        </div>
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