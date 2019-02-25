<!DOCTYPE html>
<html lang="en">
 	@include('educator.common.head')
  <body>
  	
  	@include("educator.common.header")
  	@include("educator.common.subHeader")

  	<main class="job_listing_wrapper">
  		@yield('content')
  		@include('educator.common.footer')
  	</main>
    @stack('modal')
    <div class="load-images loading">
      <img src="/images/loading.gif">
    </div>
  	@include('educator.common.script')
    {{ debug('user') }}
  </body>
</html>
