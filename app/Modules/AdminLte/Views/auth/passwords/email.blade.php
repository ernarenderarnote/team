@extends('layouts.default')

@section('content')
    <!-- Breadcumb area-->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bc_inner">
                        <p><span>Forgot</span> Password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login area-->
    <main class="login_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login_inner">
                        <div class="login_box">
                            <div class="login_header">
                                <p><img src="/images/login-key.png" alt=""> Forgot <span>Team.Education</span></p>
                            </div>
                            
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <fieldset>
                                    <label for="email">Email:</label>
                                    <input id="email" type="email" placeholder="Enter Your Email Address" name="email">
                                    @hasErrorMsg('email') 
                                </fieldset>
                                @if(Session::has('error'))
                                <fieldset>
                                    <span>
                                        {{ Session::get('error') }}
                                    </span>
                                </fieldset>
                                 @endif
                                <div class="submit_box">
                                    <div class="">
                                        <input type="submit" name="login" value="Send Recovery Email">
                                    </div>
                                </div>
                                <div class="donthaveaccount">
                                    <p>Don’t have an account? <a href="{{ route('signup.educator.step') }}">Sign Up.</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
