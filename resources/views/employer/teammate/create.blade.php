@extends('layouts.employer')
@section('content')
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
                  <h2>ADD NEW TEAM MEMBER</h2>
               </div>
               <div class="member-inner">
                  <div class="col-md-8">
                     <div class="member-innerleft">
                        <p>Adding a new team member will allow them to log into your account. There are three types of Access - <strong>Administrator,</strong> <strong>Pay Approved</strong> and <strong> Limited.</strong> </p>
                        <p> <strong>Administrator</strong> has full access over all functionality including billing changes, checkout, and purchases. </p>
                        <p><strong>Limited</strong> only allows job candidate searches and adding a candidate to the cart. Users with limited access can not make changes to your account or make any purchases. </p>
                        <div class="addmemberform">
                           <h2>Add Team  Member</h2>
                           <form method="post" action="{{ route('employer.teammates.store') }}" class="add-team">
                              {{ csrf_field() }}
                             

                              @if(old('team'))
                                @foreach(old('team') as $key => $team )
                                <div class="addmemeberform-fields team-wrap" data-row="{{ $key }}">
                                   <div class="form-group col-md-3">
                                      <label>First Name</label>
                                      <input type="text" name="team[{{ $key }}][first_name]" class="form-control" placeholder="Enter First Name" value="{{ $team['first_name'] }}" >
                                      @php  if($errors->has('team.'. $key .'.first_name')){ @endphp
                                          <span class="help-block error">
                                              <span>@php  echo $errors->first('team.'. $key .'.first_name') @endphp</span>
                                          </span>
                                      @php } @endphp
                                   </div>
                                   <div class="form-group col-md-3">
                                      <label>Last Name</label>
                                      <input type="text" name="team[{{ $key}}][last_name]" class="form-control" placeholder="Enter Last Name" value="{{ $team['last_name'] }}">
                                      @php  if($errors->has('team.'. $key .'.last_name')){ @endphp
                                          <span class="help-block error">
                                              <span>@php  echo $errors->first('team.'. $key .'.last_name') @endphp</span>
                                          </span>
                                      @php } @endphp
                                   </div>
                                   <div class="form-group col-md-3">
                                      <label>Email Address</label>
                                      <input type="email" name="team[{{ $key}}][email]" class="form-control" placeholder="Enter Email Address" value="{{ $team['email'] }}">
                                      @php  if($errors->has('team.'. $key .'.email')){ @endphp
                                          <span class="help-block error">
                                              <span>@php  echo $errors->first('team.'. $key .'.email') @endphp</span>
                                          </span>
                                      @php } @endphp
                                   </div>
                                   <div class="form-group col-md-3">
                                      <label>Level Of Access</label>
                                      <select name="team[{{ $key}}][roles]" class="form-control">
                                        @foreach($team_permissions as $team_permission)  
                                          <option value="{{ strtolower($team_permission->name) }}"  @if($team['roles'] ==  strtolower($team_permission->name) ) selected="selected" @endif >{{ $team_permission->name }}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                </div>
                                @endforeach
                              @else
                               <div class="addmemeberform-fields team-wrap" data-row="0">
                                 <div class="form-group col-md-3">
                                    <label>First Name</label>
                                    <input type="text" name="team[0][first_name]" class="form-control" placeholder="Enter First Name">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Last Name</label>
                                    <input type="text" name="team[0][last_name]" class="form-control" placeholder="Enter Last Name">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Email Address</label>
                                    <input type="email" name="team[0][email]" class="form-control" placeholder="Enter Email Address">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Level Of Access</label>
                                    <select name="team[0][roles]" class="form-control">
                                      @foreach($team_permissions as $team_permission)  
                                        <option value="{{ strtolower($team_permission->name) }}">{{ $team_permission->name }}</option>
                                      @endforeach
                                    </select>
                                 </div>
                              </div>
                              @endif
                              <div class="addmember-link"> <a href="#" class="new-teammate">+ ADD ANOTHER TEAM MEMBER</a> </div>
                              <div class="save-button">
                                 <button type="submit"> SAVE </button>
                              </div>
                              <div class="new-membertext">
                                 <p>New team members will be sent an email to create their password. </p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="member-innerright">
                        <h2 class="mb-2">CURRENT TEAM MEMBERS</h2>
                        @include('employer.teammate.list')
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(function(){

      var template = '<div class="addmemeberform-fields team-wrap" data-row=":::">'+
                                 '<div class="form-group col-md-3">'+
                                    '<label>First Name</label>'+
                                    '<input type="text" name="team[:::][first_name]" class="form-control" placeholder="Enter First Name">'+
                                 '</div>'+
                                 '<div class="form-group col-md-3">'+
                                    '<label>Last Name</label>'+
                                    '<input type="text" name="team[:::][last_name]" class="form-control" placeholder="Enter Last Name">'+
                                 '</div>'+
                                 '<div class="form-group col-md-3">'+
                                    '<label>Email Address</label>'+
                                    '<input type="email" name="team[:::][email]" class="form-control" placeholder="Enter Email Address">'+
                                 '</div>'+
                                 '<div class="form-group col-md-3">'+
                                    '<label>Level Of Access</label>'+
                                    '<select name="team[:::][roles]" class="form-control">'+
                                        @foreach($team_permissions as $team_permission)  
                                          '<option value="{{ strtolower($team_permission->name) }} >{{ $team_permission->name }}</option>'+
                                        @endforeach
                                    '</select>'+
                                 '</div>'+
                              '</div>';

     

      $(".new-teammate").click(function(e){

        e.preventDefault()
        var $teamForm = $(".add-team");
        var id = $teamForm.find('.team-wrap').last().data('row');
        $teamForm.find(".team-wrap").last().after(template.replace(/:::/g, parseInt(id) + 1));
      });

    });
</script>
@endpush