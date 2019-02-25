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
      <div class="col-md-12">
         <!-- general form elements -->
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title">Create {{ request()->type }} subject </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.support.subject.update', [request()->type, $subject->id]) }}" method="post">
               {{ csrf_field() }}
               {{ method_field('put') }}
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Subject</label>
                     <input type="text" class="form-control" id="exampleInputEmail1" name="subject" value="{{ old('subject', $subject->subject) }}" placeholder="Enter Subject">
                     @hasErrorMsg('subject')
                  </div>
                  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{ route('admin.support.subject.index', request()->type) }}" class="btn btn-primary">Cancel</a>
               </div>
            </form>
         </div>
         <!-- /.box -->
         <!-- /.box -->
      </div>
   </div>
</section>
@endsection