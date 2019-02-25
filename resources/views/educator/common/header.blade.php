 
@if(!auth()->user()->is_verify_email)
 <div class="alert alert-warning email-warning">
  You haven't confirmed your email address yet. Click here for the new confirmation. <a href="{{ route('educator.resend.email') }}">Resend</a>
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
                           <li><a href="{{ route('educator.jobs.index') }}">SEARCH JOB LISTINGS</a></li>
                           <li><a href="{{ route('educator.history.index') }}">HISTORY</a></li>
                           <li><a href="{{ route('educator.faq') }}">FAQ</a></li>
                           <li><a href="{{ route('educator.support.create') }}">SUPPORT</a></li>
                        </ul>
                     </nav>
                  </div>
                  <div class="col-md-4">
                     <div class="dash_right">
                        <div class="notification_panel">

                              <!-- alerts -->
                              <div class="dropdown alert new-alerts-notification">
                              @php 
                                 $where = [];
                                 $where[] = 'App\Notifications\Educator\JobApproved';
                                 $where[] = 'App\Notifications\Educator\JobRejected';
                                 $where[] = 'App\Notifications\Educator\JobAccepted';
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
                                    @include('notification.educator.'.snake_case(class_basename($alert->type)))
                                 @endforeach
                               </div>
                             </ul>
                           </div>

                            <!--  newjob dropdown start here-->
                           <div class="new_job_appl dropdown new-job-notification">
                           @php 
                              $jobNotifications = auth()->user()->unreadNotifications()->whereType('App\Notifications\Educator\NewJobPost')->get();
                           @endphp
                           <a class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <i class="fa fa-briefcase" aria-hidden="true"></i>
                                 @if($jobNotifications->count()) <sup>{{ $jobNotifications->count() }}</sup> @endif
                              <i class="fa fa-sort-desc" aria-hidden="true"></i>
                           </a> 
                           <span>NEW JOBS</span>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <div class="alertdropdown-header">YOU HAVE {{ $jobNotifications->count() }} NEW JOB LISTINGS</div>
                               @if($jobNotifications->count() > 0)
                              <div class="new_jobdropdownbody">
                                 @foreach($jobNotifications as $notification)
                                    @include('notification.educator.'.snake_case(class_basename($notification->type)))
                                 @endforeach
                              </div>
                              @endif
                           </ul>
                           </div>
                           @push('js')
                              <script type="text/javascript">
                                $(function() {

                                    $(document).on('click', '.new-job-notification .dropdown-menu', function (e) {
                                      e.stopPropagation();
                                    });


                                    // read jobs  notification
                                    $(".new-job-notification").click(function(){

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
                                    });


                                    // read alerts
                                    $(".new-alerts-notification").click(function(){

                                       var $this =  $(this); 
                                       var $len = $this.find(".alertdropdown-content").length;
                                       if($len > 0){
                                          var url = "{{ route('educator.notification.alerts.read') }}";
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
                           <!--newjob dropdown end here --> 
                        </div>
                        <div class="user">
                           <div class="username">
                              <a>{{ ucfirst(auth()->user()->first_name) }} <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                              <ul class="user-dropdown">
                                 <!-- <li>
                                    <a href="">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                    TRANSACTIONS</a>
                                 </li> -->
                                 <li>
                                    <a href="{{ route('educator.settings.index') }}">
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
   </div>
   <!-- Container End -->
</header>
<!-- Header area End-->
<!-- Sub menu area