@forelse($jobs as $job)
  <div class="educate-main-row" data-row-id="{{ $job->id }}">
     <div class="educate-search {{ ($loop->index ) % 2 == 0 ? 'even' : 'odd' }}">
        <div class="col-md-7 educate-searchtable">
           <table class="table">
              <thead>
                 <tr>
                    <th>DATE POSTED</th>
                    <th>JOB TITLE</th>
                    <th>LOCATION</th>
                    <th>SALARY</th>
                 </tr>
              </thead>
              <tbody>
                 <tr>
                    <td>{{ carbon($job->created_at)->format(config('global.date_format2')) }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->city->name .', '. $job->state->short_name }}</td>
                    <td>${{$job->pay_min . '-' . $job->pay_max}} </td> {{--per {{ $job->pay_type --}}
                 </tr>
              </tbody>
           </table>
        </div>
        <div class="col-md-5 educate-searchbutton job-oppurtunitieslinks">
          <a href="" class="hidejob-detaillink">HIDE JOB DETAILS</a>
          <a href="" class="job-detaillink">JOB DETAILS</a>

          @if($job->userAction->isEmpty())
            <a href="" class="apply-link" data-toggle="modal" data-target="#applyModal">APPLY</a>
            <a href="" class="hide-detaillink">HIDE</a>
          @else
            <a href="javascript:void(0);" class="apply-link">APPLIED</a>
          @endif
          
        </div>
     </div>
     <div class="educate-desc">
        <div class="job-detailsection">
           <div class="job-detailsectionimage"> <img src="/images/info.png"> </div>
           <div class="job-detialleftsection">
              <p><strong>Job ID:</strong> {{ $job->id }} </p>
              <p><strong>Apply Deadline:</strong>
              @if($job->deadline)
                {{ carbon($job->deadline)->format(config('global.date_format')) }}
              @else
                Posted until Filled
              @endif
              </p>
              <p><strong>Posted:</strong> {{ carbon($job->created_at)->format(config('global.date_format'))  }}</p>
           </div>
           <div class="job-detialrightsection">
              <p><strong>Position Type:</strong> <span class="job-detailrighttext">{{ $job->jobType->name}}</span></p>
              <p><strong>Salary:</strong> <span class="job-detailrighttext">${{$job->pay_min . '-' . $job->pay_max}} </span></p> 
              {{--per {{ $job->pay_type --}}
           </div>
        </div>
        <div class="job-descriptionmiddle">

           <h2>Job Description</h2>
           <p>{{ $job->description }}</p>

           <b>Education/Certification:</b>
           <p>{{ $job->education }}</p>

           @if($job->skills)
              <b>Special Knowledge/Skills:</b>
              <p>{{ $job->skills }}</p>
            @endunless

           @if($job->additional_information)
              <b>Experience:</b>
              <p>{{ $job->additional_information }}</p>
           @endunless
           @if(empty($job->user_action))
           <div class="apply-jobbutton removeafterapply"><a href="" data-toggle="modal" data-target="#applyModal">Apply For This job</a></div>
           @endif
        </div>
     </div>
  </div>
  @empty
    <p class="col-md-8"> Sorry! There is nothing to show here.</p>
  @endforelse
  <div class="col-md-12 text-center">{{ $jobs->appends(request()->all())->links() }}</div>