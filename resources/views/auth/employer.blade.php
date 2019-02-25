
@extends('layouts.default')


@section('content')
	<!-- Breadcumb area-->
	<div class="breadcumb_area">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="bc_inner">
	                    <p><span>Login</span> for Employers</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	@include("common.success")

	<!-- Login area-->
	<main class="login_container">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="login_inner">
	                    <div class="login_box">
	                        <div class="login_header">
	                            <p><img src="/images/login-key.png" alt=""> Log into <span>Team.Education</span></p>
	                        </div>
	                        <form action="{{ route('auth.login') }}" method="post">
	                        	{{ csrf_field() }}
	                            <fieldset>
	                                <label for="email">Email:</label>
	                                <input id="email" type="email" placeholder="Enter Your Email Address" name="email">
	                                @hasErrorMsg('email') 
	                            </fieldset>
	                            <fieldset>
	                            	@if(Session::has('error'))
	                                	<span>
	                                		{{ Session::get('error') }}
	                                	</span>
									@endif
	                            </fieldset>
	                            <fieldset>
	                                <div class="lebel-fpass">
	                                    <label for="pass">Password:</label>
	                                    <a href="{{ route('auth.password.forgot') }}">Forgot your Password?</a>
	                                </div>
	                                <input id="pass" type="password" placeholder="Enter Your Password" name="password">
	                                @hasErrorMsg('password') 
	                            </fieldset>
	                            <div class="submit_box">
	                                <div class="remeber_left">
	                                    <input type="checkbox" name="remember_to_pc" value="1" checked> Remember Me <br>on this computer
	                                </div>
	                                <div class="submit_right">
	                                    <input type="submit" name="login" value="Log In">
	                                </div>
	                            </div>
	                            <div class="donthaveaccount">
	                                <p>Don’t have an account? <a href="{{ route('signup.employer')  }}">Sign Up.</a></p>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</main>
@endsection