@extends('layouts.default')

@section('content')
    <!-- Breadcumb area-->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bc_inner">
                        <p><span>Reset</span> Password</p>
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
                                <p><img src="/images/login-key.png" alt=""> Reset Password <span>Team.Education</span></p>
                            </div>
                            <form action="{{ route('auth.password.reset', request()->segment(3)) }}" method="post">
                                {{ csrf_field() }}
                                <fieldset>
                                    <label for="password">Password:</label>
                                    <input id="password" type="password" placeholder="Enter Your password" name="password">
                                    @hasErrorMsg('password') 
                                </fieldset>
                                <fieldset>
                                    <label for="password_confirmation">Retype Your Password:</label>
                                    <input id="password_confirmation" type="password" placeholder="Retype Your password" name="password_confirmation">
                                    @hasErrorMsg('password_confirmation') 
                                </fieldset>
                                @if(Session::has('error'))
                                <fieldset>
                                    <span>
                                        {{ Session::get('error') }}
                                    </span>
                                </fieldset>
                                 @endif
                                <div class="submit_box">
                                    <div class="submit_right">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
