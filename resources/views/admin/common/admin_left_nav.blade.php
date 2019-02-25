<!-- Left side bar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
	<!-- user panel -->
	<div class="user-panel">
	  <div class="pull-left image">
		<img src="{{ asset('/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
	  </div>
	  <div class="pull-left info">
		<p>Name</p><!-- 
		<a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
	  </div>
	</div>
	<!-- search form -->
	<!-- <form action="#" method="get" class="sidebar-form">
	  <div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Search...">
		  <span class="input-group-btn">
			<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
			</button>
		  </span>
	  </div>
	</form> -->
	<!-- sidebar menu -->
	<ul class="sidebar-menu">
	  <li class="header">MAIN NAVIGATION</li>

	  <li class="active" >
		<a href="{{ url('/admin/dashboard')}}">
		  <i class="fa fa-home"></i> <span>Dashboard</span> <!-- <i class="fa fa-angle-left pull-right"></i> -->
		</a>
		  <!-- <ul class="treeview-menu">
			<li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
			<li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
		  </ul> -->
	  </li>

	   <li class="active" >
		<a href="{{ url('admin/partners')}}">
		  <i class="fa fa-users"></i> <span>Partners</span>
		</a>
	  </li>



	 
	  <!-- <li class="treeview">
		<a href="#">
		  <i class="fa fa-pie-chart"></i>
		  <span>Charts</span>
		  <i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		  <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
		  <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
		  <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
		  <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
		</ul>
	  </li> -->
	</ul>
  </section>
  <!-- closed left side bar -->
</aside>
<script>
	$(document).ready(function ($) {

		<!-- Menu Activation -->
		$(".sidebar").find('a').each(function(){
			var $this = $(this);
			if($this.attr('href') == window.location.href){
				$this.parent().addClass("active");
				var isChild = $this.closest('.treeview-menu');
				if(isChild.length > 0){
					isChild.parent().addClass('active');
				}
			}
		});

	})
</script>