<div class="new_jobcontent">
   <div class="new_jobicon"> <img src="/images/jobcart.png"> </div>
   <div class="new_jobdata">
     <div class="new_jobdatainner">
      <span class="teacher">{{ $notification->data['job']['title'] }}</span> - 
      <span class="teacher-details">{{  $notification->data['job']['city']['name'] .','. $notification->data['job']['state']['short_name'] }}</span>
     </div>
     <div class="new_jobdatainner"><span class="salary-range"> 
     Salary: {{ $notification->data['job']['pay_min'] }}
      / 
      @if($notification->data['job']['pay_type'] == 'salary')
         yr
      @elseif($notification->data['job']['pay_type'] == 'hourly')
        hrs
      @endif
      </span>
      <a href="{{ route('educator.jobs.show', $notification->data['job']['id']) }}" class="view-link" target="_blank">View</a></div>
   </div>
 </div>