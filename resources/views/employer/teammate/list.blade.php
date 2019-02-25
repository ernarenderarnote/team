 <style>
.permission-form button{
  background: none;
  border: 0 none;
}
.permission-form .selected{
  font-weight: bold;
}
 </style>
 @forelse($clients as $client)
 <div class="memberrightinner pt-2">
  <div class="col-md-8 p-0l">
    <h2>{{ $client->name }}</h2>
    <p>{{ $client->email }}</p>
  </div>
  <div class="col-md-4">
  <div class="newmembericons add-deleteiconsmain">
    <span class="icon-cogg">
      <div class="dropdown dropdown-toggle">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cog cog-icons" aria-hidden="true" title="setting" ></i>
        </a>
        <ul class="dropdown-menu">
          @foreach($team_permissions as $team_permission)  
            <li>
              <form action="{{ route('employer.teammates.update', $client->id) }}" method="post" class="permission-form">
                {{ method_field("PATCH")}}
                {{ csrf_field() }}
                <input type="hidden" name="roles" value="{{ strtolower($team_permission->name) }}">
                <button  type="submit" class="@if($client->roles == strtolower($team_permission->name))selected @endif" > {{ $team_permission->name }}  </button>
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </span>
  	<form action="{{ route('employer.teammates.destroy', $client->id) }}" method="post" style="display: inline;">
  		{{ csrf_field() }}
  		{{ method_field("DELETE") }}
 		  <span class="icon-delete delete-teammate" onclick="$(this).closest('form').submit();">
      <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
  	</form>
   </div>
  </div>
</div>
@empty
<p>Sorry! There is nothing to show here.</p>
@endforelse
