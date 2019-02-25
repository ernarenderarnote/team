 <!-- Header area -->
  <header>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="header_inner">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="logo">
                                    <!-- Site logo here -->
                                  <a href="/"><img src="/images/logo.png" alt="Team.Education"></a>
                              </div>
                          </div>
                          
                          <div class="col-md-8">
                              <div class="header_right">
                                  @if(Auth::check())
                                    <a href="{{ route('dashboard') }} "><i class="fa fa-tachometer"></i> Dashboard </a>
                                    <a href="{{ route('auth.logout') }} "><i class="fa fa-lock"></i> Logout</a>
                                  @else
                                    @if (request()->is('auth/*') || request()->is('signup/*'))
                                      <!-- <a class="auth-text"><i class="fa fa-lock"></i> log in</a> -->
                                    @else
                                      <ul>
                                        <li>
                                            <a><i class="fa fa-lock"></i> log in</a>
                                            <ul id="login_dropdown">
                                                <li><a href="{{ route('auth.educator') }}">Educator</a></li>
                                                <li><a href="{{ route('auth.employer') }}">Employer</a></li>
                                            </ul>
                                         </li>
                                      </ul>
                                    @endif
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- Container End -->
  </header>
  <!-- Header area End-->