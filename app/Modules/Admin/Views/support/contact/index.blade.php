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
               <h3 class="box-title"> {{ ucfirst(request()->type) }} support details </h3>
            </div>

             <div class="col-xs-12">
               <a class="btn bg-olive" href="{{ route('admin.support.contact.edit', [request()->type, request()->type.'.support.contact']) }}">Edit Contact</a>
            </div>
            <div class="box-body">
               <table class="table">
                  <tr>
                     <td> Support Email: </td>
                     <td>{{ $supports->values->email }}</td>
                  </tr>
                  <tr>
                     <td> Phone Support: </td>
                     <td>{{ $supports->values->phone }}</td>
                  </tr>
                  <tr>
                     <td> Address </td>
                     <td>{{ $supports->values->address }}</td>
                  </tr>
               </table>
            </div>
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</section>
<!-- /.content -->
@endsection