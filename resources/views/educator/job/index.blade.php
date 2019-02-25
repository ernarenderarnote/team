@extends('layouts.educator')
@section('content')
<div class="job_listing_area @if(request()->flag) job-opurtunityon @endif" >
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center job-opurtutiesadvancedheader">
                  <h2>EDUCATION JOB OPPURTUNITIES <a href="" class="advaced-searchlink">ADVANCED SEARCH <img src="/images/advancedsearch.png" class="job-searchimage"></a></h2>
                  <p class="search-text">There are {{ $jobs->total() }} Results</p>

                  @if(request()->has('type') && request()->type == 'newjob' )
                  <div class="view-all-oppurtunity">
                    <!-- <p>Currently viewing<br> filtered selection. </p> -->
                      <a href="{{ route('educator.jobs.index') }}" class="view-button"> View All</a>
                  </div>
                  @endif
                  <form method="get" action="">
                  <div class="input-group job-searchfields ">
                       
                        <input type="text" class="form-control" placeholder="Search by Job Title, Location, etc." aria-describedby="basic-addon2" name="s" value="{{ request()->s }}">
                        <!-- <button type="submit" class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-search"></span></button> -->
                         <span class="input-group-addon" id="basic-addon2"><button class="glyphicon glyphicon-search search-button"></button></span> 
                  </div>
                  </form>
               </div>
               <div class="job-oppurtunitiesadvanced">
               <div class="container">
                 <div class="col-md-3 job-oppurtunitiesleft ">
                    <div class="reset-filterlink"> <a href="">Reset Filter</a></div>
                    <div class="job-oppurtunitiesadvancedinner">
                      <h2>ADVANCED SEARCH</h2>
                      <form class="job-oppurtunitiesadvancedform" id="advancedsearchtool" action="" method="get">
                        <input type="hidden" name="flag" value="1">
                        <div class="form-group">
                          <label>Keyword(s):</label>
                          <input type="text" class="form-control" name="s" value="{{ request()->s }}" placeholder="Search...">
                        </div>
                        <div class="form-group">
                          <label>Date Range:</label>
                          <select class="form-control" id="date-range" name="range">
                            <option value="">Select date Range</option>
                            <option value="30">Last 30 Days</option>
                            <option value="40">Last 40 Days</option>
                            <option value="60">Last 50 Days</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Salary At Least:</label>
                          <select class="form-control" id="Atleastsalary" name="atleast">
                            <option value="0">Select salary at least</option>
                            <option value="20000">$20,000</option>
                            <option value="30000">$30,000</option>
                            <option value="40000">$40,000</option>
                            <option value="50000">$50,000</option>
                            <option value="60000">$60,000</option>
                            <option value="70000">$70,000</option>
                            <option value="80000">$80,000</option>
                            <option value="90000">$90,000</option>
                            <option value="100000">$100,000+</option>
                          </select>
                        </div>
                        <!-- <div class="distance-fieldmain">
                          <div class="form-group">
                            <label>Distance</label>
                            <select class="form-control distance-field" id="distance">
                              <option value="25">25</option>
                              <option value="45">45</option>
                            </select>
                            <span class="from-list">mi. from</span> </div>
                          <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control">
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label>Job Type:</label>
                          @foreach($jobtypes as $jobtype)
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="jobtypes[]" value="{{ $jobtype->id }}" @if(in_array($jobtype->id, isset(request()->jobtypes)? request()->jobtypes : []))checked="checked" @endif > {{ $jobtype->name }} </label>
                          </div>
                          @endforeach
                        </div>
                        <div class="form-group">
                          <label>Job Category:</label>
                          @foreach($categories as $category)
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="categories[]" value="{{ $category->id }}" @if(in_array($category->id, isset(request()->categories)? request()->categories: []))checked="checked" @endif> {{ $category->name }} </label>
                          </div>
                          @endforeach
                        </div>
                        <div class="form-group">
                          <label>Grade Level:</label>
                          @foreach($grades as $grade)
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="grades[]" value="{{ $grade->id }}" @if(in_array($grade->id, isset(request()->grades)? request()->grades :[])) checked="checked" @endif> {{ $grade->name }} </label>
                          </div>
                          @endforeach
                        </div>
                      </form>
                    </div>
                  </div>
                 <div class="col-md-9 job-oppurtunitiesright">
                    <div class="main-applysection job-oppurtunitiesrightdetails job-list">
                     <!--  <div class="applysearch-header">
                         <label>Sort by:</label>
                         <select id="date">
                            <option value="date">Date</option>
                         </select>
                      </div> -->
                    @include("educator.job.list")

                   </div>
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


      $(".job-list").on("click", ".job-detaillink",function(e)
      {
        $(this).closest(".educate-main-row").addClass("open");
        return false;
      });

      $(".job-list").on("click", ".hidejob-detaillink", function()
      {
        $(this).closest(".educate-main-row").removeClass("open");
         return false;
      });

      $("#datepicker").datepicker();

      $(".advaced-searchlink").click(function(){
          $(".job_listing_area").toggleClass("job-opurtunityon");
          return false;
      }); 


      $('#applyModal').on('show.bs.modal', function (event) {

        var $button = $(event.relatedTarget);
        var id = $button.closest('.educate-main-row').data('row-id');
        $(".apply-button").unbind();


        $(".apply-button").click(function(e){
            e.preventDefault();
            var url = '{{ route('educator.jobs.index') }}'  + '/'+id;
            loading();
            $.ajax({
               url: url,
               type: 'POST',
               data: { action : "apply", _token : '{{ csrf_token() }}', "_method": 'PUT'  },
               success: function(response) {
                
                 $("#applyModal").modal("hide");
                 $button.removeAttr('data-toggle');
                 $button.removeAttr('data-target');
                 $button.closest(".educate-main-row").find(".apply-link").html('applied');
                 $button.attr('href',"javascript:void(0)");
                 $button.closest(".educate-main-row").find(".removeafterapply").remove();
               },
               complete : function(res){
                 loaded();
               }
            });
        });
      });

      $(".job-list").on('click', ".hide-detaillink", function(e)
      {

        e.preventDefault();
        var $this = $(this);
        var main = $this.closest('.educate-main-row')
        var id = main.data('row-id');

        var url = '{{ route('educator.jobs.index') }}'  + '/'+id;
        loading();
        $.ajax({
               url: url,
               type: 'POST',
               data: { action : "hide", _token : '{{ csrf_token() }}', "_method": 'PUT' },
               success: function(response) {
                 main.remove();
               },
                complete: function(){
                  loaded();
               }
            });
      })

      var timer;
      $("#advancedsearchtool").on('change', '[type=checkbox], select, input',function(){

          clearTimeout(timer);
          timer = setTimeout(function(){
              $('#advancedsearchtool').submit();
          }, 1500);
          

      });

      $('#advancedsearchtool').submit(function(event){

        loading();
        $.ajax({
                 url: "",
                 type: 'GET',
                 data: $( this ).serialize(),
                 success: function(response) {
                  $(".job-oppurtunitiesrightdetails").html(response);
                 },
                  complete: function(){
                    loaded();
                 }
              });

        event.preventDefault();
      })

      $(".reset-filterlink a").click(function(e){

          $('[name="s"]').removeAttr('value');

          $('#advancedsearchtool')[0].reset();
          //$('#advancedsearchtool').find("[type=checkbox]").removeAttr("checked");
          $('#advancedsearchtool').submit();
          //window.location.href = '{{ route("educator.jobs.index") }}'
          e.preventDefault();
      })
      
      //educate-main-row
      

    });
  </script>
@endpush


@push('modal')

<div class="modal fade" id="applyModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
          <h2> You’re about to apply for this position. </h2>
          <p>If the employer approves your application, your contact information will be immediately shared with the employer. </p>
          <h5>To move forward, please select Apply now below.</h5>
          <div class="approved-buttons"><a href="" class="apply-button">Apply Now</a> <a href="" class="no-applybutton">DO NOT APPLY</a></div>
       </div>
    </div>
  </div>
</div>

@endpush