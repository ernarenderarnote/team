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
               <h3 class="box-title">Faq</h3>
            </div>

            <div class="col-xs-12">
               <a class="btn bg-olive" href="{{ route('admin.support.subject.create', request()->type) }}">Create Subject</a>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example2" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Subject</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($subjects as $subject)
                     <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->subject }}</td>
                        <td>
                           <a class="btn bg-olive pull-left" href="{{ route('admin.support.subject.edit', [request()->type, $subject->id ])}}">Edit</a>
                            @deleteBtn('admin.support.subject.destroy', [ request()->type & $subject->id] ) 
                        </td>
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