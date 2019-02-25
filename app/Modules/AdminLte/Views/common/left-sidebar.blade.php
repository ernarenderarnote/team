<!-- Left side bar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
	<!-- user panel -->
	<div class="user-panel">
	  <div class="pull-left image">
		<img src="{{ asset('/adminLte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
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

	  <li class="treeview">
		<a href="#">
		  <i class="fa fa-black-tie"></i>
		  <span>Employer</span>
		  <i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		  <li><a href="{{ route('admin.employer.school.index') }}"><i class="fa fa-graduation-cap"></i> School List </a></li>
		  <li><a href="{{ route('admin.user.index', ['employer']) }}"><i class="fa fa-list"></i> Employer List</a></li>
		  <li><a href="{{ route('admin.faq.index', 'employer') }}"><i class="fa fa-question"></i> Faq </a></li>
		  <li class="treeview">
		  	<a href="#">
		  	<i class="fa fa fa-phone"></i>
			  <span>Supports</span>
			<i class="fa fa-angle-left pull-right"></i>
			</a>
		  	<ul class="treeview-menu">
		  		<li><a href="{{ route('admin.support.subject.index', ['employer']) }}"><i class="fa fa-book"></i> Subjects </a></li>
		  		<li><a href="{{ route('admin.support.index', 'employer') }}"><i class="fa fa-phone"></i> Supports </a></li>
		  		<li><a href="{{ route('admin.support.contact.index', 'employer') }}"><i class="fa fa-phone"></i> Contacts us </a></li>
		  	</ul>
		  </li>
		  <li><a href="{{ route('admin.employer.contactpacks.index') }}"><i class="fa fa-question"></i> Contact Packs </a></li>
		  <!-- <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li> -->
		</ul>
	  </li> 
	  <li class="treeview">
		<a href="#">
		  <i class="fa fa-graduation-cap"></i>
		  <span>Educator</span>
		  <i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
		  <li><a href="{{ route('admin.user.index', ['educator']) }}"><i class="fa fa-list"></i> Educator List</a></li>
		  <li><a href="{{ route('admin.faq.index', 'educator') }}"><i class="fa fa-question"></i> Faq </a></li>
		  <li class="treeview">
		  	<a href="#">
		  	<i class="fa fa fa-phone"></i>
			  <span>Supports</span>
			<i class="fa fa-angle-left pull-right"></i>
			</a>
		  	<ul class="treeview-menu">
		  		<li><a href="{{ route('admin.support.subject.index', ['educator']) }}"><i class="fa fa-book"></i> Subjects </a></li>
		  		<li><a href="{{ route('admin.support.index', 'educator') }}"><i class="fa fa-phone"></i> Supports </a></li>
		  		<li><a href="{{ route('admin.support.contact.index', 'educator') }}"><i class="fa fa-phone"></i> Contacts us </a></li> 
		  	</ul>
		  </li>
		  <!-- <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li> -->
		</ul>
	  </li>
	  
	  <!-- jk -->
	  <li>
		<a href="{{ route('admin.state') }}"><i class="fa fa-diamond"></i> <span>State</span></a>
	  </li>

	  <li>
		<a href="{{ route('admin.city') }}"><i class="fa fa-database"></i> <span>City</span></a>
	  </li>
	  <!-- Closed Jk-->
	</ul>
  </section>
  <!-- closed left side bar -->
</aside>
