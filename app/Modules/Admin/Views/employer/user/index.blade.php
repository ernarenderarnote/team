@extends("AdminLte::layouts.adminLte")
@section('content')
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
   <h1>
     Dashboard
     <small>Control panel</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
   </ol>
   </section> -->
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-header">
               <h3 class="box-title">Employer</h3>
            </div>

            <!-- <div class="col-xs-12">
               <a class="btn bg-olive" href="{{ route('admin.faq.create', request()->type) }}">Create</a>
            </div> -->
            
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example2" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>School</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($users as $user)
                     <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->details->school_id }}</td>
                        <td>
                         @deleteBtn('admin.user.destroy', [ request()->type & $user->id] ) 
                        <!-- <a class="btn bg-olive" href="{{ route('admin.user.show', [request()->type, $user->id ])}}">View</a> --></td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="3">Record not found</td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</section>
<!-- /.content -->
@endsection