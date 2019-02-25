@extends('layouts.default')



@section('content') 

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  
  <!-- Content Header (Page header) -->
  
  <section class="content-header">
    <h1> Dashboard <span>REDCONNEX</span> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  
  <!-- Main content -->
  
  <section class="content"> 
    
    <!-- Small boxes (Stat box) -->
    
    <div class="row"> 
      
      <!--User entry table-->
      
      
<div class="col-md-12">
<div class="box"> 

    <table id="grid-data-api" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="{{ route('company-api') }}">
        <thead>
            <tr>
                <th data-column-id="id" data-type="numeric" data-identifier="true">Id</th>
                <th data-column-id="name" data-order="asc">Company Name</th>
                <th data-column-id="tagline">Tagline</th>
                <th data-column-id="email" >Email</th>
                <th data-column-id="revenue">Revenue</th>
                <th data-column-id="employees">Employees</th>
            </tr>
        </thead>
        
    </table>

</div>

</div>
      
      <!--Table--> 
      
      <!--Table--> 
      
      <!--User entry table  ||  End   --> 
    </div>
    
    <!-- /.row --> 
    
    <!-- Main row --> 
    
    <!-- /.row (main row) --> 
    
  </section>
  
  <!-- /.content --> 
  
</div>
@endsection