
@extends('layouts.default')

@section('content')
  <!-- Breadcumb area-->
  <div class="breadcumb_area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="bc_inner">
            <p><span>Signup</span> For Employers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                    <li>- Post a career opportunity in less time</li>
                    <li>- Search pre-screened job candidates</li>
                    <li>- Instanly  receive applicants contact details </li>
                  </ul>
                  <div class="post-job">
                    <p>Posting a job is 100% <strong>FREE!</strong>
                  </div>
                  <div class="note-signupemployers">
                    <p><span>Note:</span> In order to complete your signup, we must verify your account. <br>
                      You will recieve an email once you have been verified. </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login_inner">
                  <div class="login_box step1">
                    <div class="login_header">
                      <p><img src="/images/login-key.png" alt=""> Sign up at<span>Team.Education</span></p>
                    </div>
                    <form action="" class="signup-employer" method="post">
                      {{ csrf_field() }}
                      <fieldset>
                        <label for="email">School name:</label>
                        <select class="form-control" id="sel1" name="school_id">
              						<option value="" >Please Select a School</option>
                          @foreach($schools as $school)
                            <option value="{{ $school->id }}" @if(old("school_id") ==  $school->id )) selected="selected"  @endif>{{ $school->values->school_name }}</option>
                          @endforeach
            					  </select>
                        @hasErrorMsg('school_id')
                      </fieldset>
                      <fieldset>
                        <label for="first_name">first Name:</label>
                        <input id="first_name" type="text" placeholder="Enter Your First Name" name="first_name" value="{{ old('first_name') }}">
                        @hasErrorMsg('first_name')
                      </fieldset>
                      <fieldset>
                        <label for="last_name">Last Name:</label>
                        <input id="last_name" type="text" placeholder="Enter Your Last Name" name="last_name" value="{{ old('last_name') }}">
                        @hasErrorMsg('last_name')
                      </fieldset>
                      <fieldset>
            						<label for="email">Email:</label>
            						<input id="email" type="email" placeholder="Enter Your Email Address" name="email" value="{{ old('email') }}">
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
                          <input type="submit" name="signup-employers" value="Signup">
                        </div>
                      </div>
                      <div class="donthaveaccount">
                        <p>Already have an account?&nbsp;&nbsp;<a href="{{ route('auth.employer')  }}">Log in here</a></p>
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