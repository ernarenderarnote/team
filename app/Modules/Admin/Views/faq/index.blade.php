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
               <a class="btn bg-olive" href="{{ route('admin.faq.create', request()->type) }}">Create</a>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example2" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($faqs as $faq)
                     <tr>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                           <a class="btn bg-olive pull-left" href="{{ route('admin.faq.edit', [request()->type, $faq->id ])}}">Edit</a>
                           @deleteBtn('admin.faq.destroy', [ request()->type & $faq->id] ) 
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