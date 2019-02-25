<ul>
    <li>
      <div class="request-questions">What region do you currently work in?</div>
      <div class="request-answers">{{ $educator->details->region or '' }}</div>
    </li>
    <li>
      <div class="request-questions">What region(s) are you willing to relocate to?</div>
      <div class="request-answers">
        @php $relocate = is_array($educator->details->relocate) ? $educator->details->relocate : []; @endphp
     		{{ implode(",", $relocate) or '' }}
     	</div>
    </li>
    <li>
      <div class="request-questions">What is your gender?</div>
      <div class="request-answers">
      	@if($educator->details->gender == 'm')Male @elseif($educator->details->gender == 'f') Female @else Prefer not to answer @endif
      </div>
    </li>
    <li>
      <div class="request-questions">Do you currently work at the campus or district level?</div>
      <div class="request-answers">{{ $educator->details->campus or '' }}</div>
    </li>
    <li>
      <div class="request-questions">Which of the following would you classify yourself as?</div>
      @inject('group', 'App\Group')
      <div class="request-answers"> {{ $group->find($educator->details->classify)->name or ''}}</div>
    </li>
    <li>
      <div class="request-questions">How many years of creditable experience do you have? </div>
      <div class="request-answers">{{ $educator->details->creditable_experience or '' }} years</div>
    </li>
    <li>
      <div class="request-questions">What is the mininum amount that you would accept in order to relocate? </div>
      <div class="request-answers">{{ $educator->details->amount_order_to_relocate or '' }}</div>
    </li>
    <li>
      <div class="request-questions">Highest degree attained?</div>
      @inject('group', 'App\Group')
      <div class="request-answers">{{ $group->find($educator->details->degree_attained)->name or ''  }}</div>
    </li>
    <li>
      <div class="request-questions">What is your current position? </div>
      <div class="request-answers">{{ $group->find($educator->details->current_position)->name or '' }}</div>
    </li>
    <li>
      <div class="request-questions">What is the least amount you would be willing to make? </div>
      <div class="request-answers">${{ @number_format(explode("-", $educator->details->least_amount)[0]) or '' }}</div>
    </li>
    <li>
      <div class="request-questions">Select positions you would accept and are generally qualified for.</div>
      <div class="request-answers">
        <ul class="positions-select">
        	@inject('group', 'App\Group')
        	@php 
        		if(is_null($educator->details->accept_positions))
        			$accept_positions = [];
        		else
        			$accept_positions = $educator->details->accept_positions;
        	@endphp
        	@foreach($group->whereIn('id', $accept_positions)->get() as $position)
          	<li>{{ $position->name }}</li>
          @endforeach
        </ul>
      </div>
    </li>
    <li>
      <div class="request-questions">Years of Experience? </div>
      <div class="request-answers">{{ $educator->details->zipcode }}</div>
    </li>
    <li>
      <div class="request-questions">What certifications do you have? </div>
      <div class="request-answers">
        <ul class="positions-select">
        	@inject('group', 'App\Group')
          @php 
        		if(is_null($educator->details->certifications))
        			$certifications = [];
        		else
        			$certifications = $educator->details->certifications;
        	@endphp
        	@foreach($group->whereIn('id', $certifications)->get() as $position)
          	<li>{{ $position->name }}</li>
          @endforeach
        </ul>
      </div>
    </li>
    <li>
      <div class="request-questions">Are you willing to consider additional duties?</div>
      <div class="request-answers">@if($educator->details->is_additional_duties)Yes @else No @endif</div>
    </li>
  </ul>