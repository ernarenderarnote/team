<!DOCTYPE html>
<html lang="en">
 	@include('employer.common.head')
  <body>
  	
  	@include("employer.common.header")
  	@include("employer.common.subHeader")

  	<main class="job_listing_wrapper">
  		@yield('content')
  		@include('employer.common.footer')
  	</main>
    <div class="load-images loading">
      <img src="/images/loading.gif">
    </div>
    @stack('modal')
  	@include('employer.common.script')
    {{ debug('user') }}
  </body>
</html>
