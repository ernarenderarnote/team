@extends('layouts.employer')
@section('content')
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
               	  @php

                  	  	$sQuery = '';
                  	  	if(!empty(request()->s))
                  	  		$sQuery = "\"".request()->s."\"";

                  	  	$sSearch = '';
                  	  	if(!empty(request()->salary))
                  	  		$sSearch = "\"$".request()->salary."\"";

                  	  	$sState = '';
                  	  	if(!empty(request()->state))
                  	  		$sState = "\"".request()->state."\"";

               	  @endphp
               	  @if( !( empty($sQuery) || empty($sSearch) || empty($sState) ) )
					       <h2>Results for @if($sQuery) {{ $sQuery }} + @endif {{ $sSearch }} +  {{ $sState}}</h2>
                    @endif
               </div>
               <div class="listing_box employer-searchmain">
                  <!-- <div class="search-header">
                     <label>Sort by:</label>
                     <select id="date">
                        <option value="date">Date</option>
                     </select>
                  </div> -->
                  <!-- employer-search2 -->
                  @forelse($educators as $educator)
	                  <div class="employer-search1">
	                     <div class="col-md-8 searchtable">
	                        <table class="table">
	                           <thead>
	                              <tr>
	                                 <th>ID#</th>
	                                 <th>PREFERRED REGION(S)</th>
	                                 <th>LOCATION</th>
	                                 <th>MIN SALARY</th>
	                                 <th>CURRENT POSITION</th>
	                              </tr>
	                           </thead>
	                           <tbody>
	                              <tr>
	                                 <td>{{ $educator->id }}</td>
                                    <td>{{ $educator->details->region }}</td>
                                    <td>{{ @implode(',', is_array($educator->details->relocate) ? $educator->details->relocate : []) }}</td>
                                    <td>${{ @number_format(explode("-", $educator->details->least_amount)[0] ) }}</td>
	                                 <td>{{ $educator->details->position->name or '' }}</td>
	                              </tr>
	                        </table>
	                     </div>
	                     <div class="col-md-4"> 
                       <a href="{{ route('employer.educator.view', $educator->id) }}" class="viewmore-link">View More</a> <a href="" class="add-to-cartbutton @if($educator->cart)added @endif" data-id="{{ $educator->id }}">
                       {{  $educator->cart ? "ADDED TO CART" : "ADD TO CART" }}
                       </a> 
                       
                       <!-- <a href="" class="close close-icon"><i class="fa fa-close" aria-hidden="true"></i></a> --> </div>
	                  </div>
	              @empty
    				<p class="search-header">No educators find</p>
	              @endforelse
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

    $(".add-to-cartbutton").click(function(e){
            
            
            e.preventDefault();

            var $this = $(this);
            if($this.is(".added"))
               return false;
            var id =  $this.data("id");
            var url = "{{ route('employer.carts.store') }}";
            loading();
            $.ajax({
               url: url,
               type: 'POST',
               data: { educator_id : id, _token : '{{ csrf_token() }}'  },
               success: function(response) {

                $("#cart-counter").html(function(index, value){
                    return parseInt(value) + 1;
                });

                 $this.addClass("added").html("ADDED TO CART");
               },
               complete : function(res){
                 loaded();
               }
            });
        });

  })
</script>
@endpush