@if(!auth()->user()->getUser()->is_verify_email)
<div class="alert alert-warning email-warning">
  You haven't confirmed your email address yet. Click here for the new confirmation. <a href="{{ route('employer.resend.email') }}">Resend</a>
</div>
@endif
 <!-- Header area -->
  <header class="dashboard-header">
      <div class="container container-dashboard">
          <div class="row">
              <div class="col-md-12">
                  <div class="header_inner">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="logo">
                                    <!-- Site logo here -->
                                  <a href="{{ route('dashboard') }}"><img src="/images/logo-white.png" alt="Team.Education"></a>
                              </div>
                          </div>
                          
                          <div class="col-md-5">
                              <nav class="nav_dash">
                                  <ul>
                                      <li><a href="{{ route('employer.jobs.create') }}">Add Job Listing</a> </li>
                                      <li><a href="{{ route('employer.eductor-quick-search') }}">SEARCH EDUCATORS</a></li>
                                      <li><a href="{{ route('employer.history.index') }}">HISTORY</a></li>
                                      <li><a href="{{ route('employer.faq') }}">FAQ</a></li>
                                      <li><a href="{{ route('employer.support.create') }}">SUPPORT</a></li>
                                  </ul>
                              </nav>
                          </div>
                          
                          <div class="col-md-4">
                              <div class="dash_right">
                                  <div class="notification_panel" style="float: none;">
                                          <!-- alerts -->
                                        <div class="dropdown alert new-alerts-notification">
                                            @php 
                                               $where = [];
                                               $where[] = 'App\Notifications\Employer\AppliedForJob';
                                               $where[] = 'App\Notifications\Employer\JobApproved';
                                               $where[] = 'App\Notifications\Employer\JobRejected';
                                               $alerts = auth()->user()->unreadNotifications()->whereIn('type', $where)->get();
                                            @endphp
                                            <a class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                               <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                               @if($alerts->count())<sup>{{ $alerts->count() }}</sup> @endif
                                               <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                            </a> 
                                            <span>ALERTS</span> </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             <div class="alertdropdown-header">YOU HAVE {{ $alerts->count() }} NEW ALERTS</div>
                                             <div class="alertdropdown-body">
                                               @foreach($alerts as $alert)
                                                  @include('notification.employer.'.snake_case(class_basename($alert->type)))
                                               @endforeach
                                             </div>
                                            </ul>
                                      </div>
                                     <!--  <div class="new_job_appl">
                                           <a><i class="fa fa-briefcase" aria-hidden="true"></i><sup></sup></a> 
                                          <span>NEW JOB APPLICANTS</span>
                                      </div> -->
                                      @push('js')
                                        <script type="text/javascript">
                                          $(function() {

                                              $(document).on('click', '.new-job-notification .dropdown-menu', function (e) {
                                                e.stopPropagation();
                                              });


                                              // read jobs  notification
                                              /*$(".new-job-notification").click(function(){

                                                 var $this =  $(this); 
                                                 var $len = $this.find(".new_jobcontent").length;
                                                 if($len > 0){
                                                    var url = "{{ route('educator.notification.jobs.read') }}";
                                                    $.ajax({
                                                           url: url,
                                                           type: 'POST',
                                                           data: {  _token : '{{ csrf_token() }}' },
                                                           success: function(response) {
                                                             //window.location.href = window.location.href;
                                                             $this.find("sup").remove();
                                                           }
                                                        });
                                                 }
                                              });*/


                                              // read alerts
                                              $(".new-alerts-notification").click(function(){

                                                 var $this =  $(this); 
                                                 var $len = $this.find(".alertdropdown-content").length;
                                                 if($len > 0){
                                                    var url = "{{ route('employer.notification.alerts.read') }}";
                                                    $.ajax({
                                                           url: url,
                                                           type: 'POST',
                                                           data: {  _token : '{{ csrf_token() }}' },
                                                           success: function(response) {
                                                             //window.location.href = window.location.href;
                                                             $this.find("sup").remove();
                                                           }
                                                        });
                                                 }
                                              });

                                           });
                                        </script>
                                     @endpush
                                  </div>
                                  <div class="user">
                                      <div class="username">
                                          <a> {{ auth()->user()->first_name }} <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                          
                                          <ul class="user-dropdown">
                                              <li>
                                                <a href="{{ route('employer.transections.index') }}">
                                                  <i class="fa fa-usd" aria-hidden="true"></i>
                                                  TRANSACTIONS</a>
                                              </li>
                                              <li>
                                                <a href="{{ route('employer.settings.index') }}">
                                                  <i class="fa fa-cog" aria-hidden="true"></i>
                                                  MY SETTINGS
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ route('auth.logout') }}">
                                                  <i class="fa fa-lock" aria-hidden="true"></i>
                                                  LOG OUT
                                                </a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- Container End -->
  </header>
  <!-- Header area End-->
    <!-- Sub menu area-->
