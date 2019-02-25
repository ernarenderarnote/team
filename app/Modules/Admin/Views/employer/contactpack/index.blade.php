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
               <h3 class="box-title">Contact Packs</h3>
            </div>

            <div class="col-xs-12">
               <a class="btn bg-olive" href="{{ route('admin.employer.contactpacks.create') }}">Create Contact Pack</a>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example2" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Credit Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($contactpacks as $contactpack)
                     <tr>
                        <td>{{ $contactpack->id }}</td>
                        <td>{{ $contactpack->credit }}</td>
                        <td>{{ number_format($contactpack->price) }}</td>
                        <td>{{ $contactpack->offer_value }}</td>
                        <td>{{ $contactpack->offer_type }}</td>
                        <td>
                           <a class="btn bg-olive pull-left" href="{{ route('admin.employer.contactpacks.edit', [ $contactpack->id ])}}">Edit</a>
                           @deleteBtn('admin.employer.contactpacks.destroy', [ $contactpack->id] ) 
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="6">Record not found</td>
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