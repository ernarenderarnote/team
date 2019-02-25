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
               <h3 class="box-title">Edit {{ request()->type }} contact</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.support.update', [ request()->type, $additional->type]) }}" method="post">
               {{ csrf_field() }}
               {{ method_field('put') }}
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="email" class="form-control" name="values[email]" value="{{ $additional->values->email }}" required="required">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Phone</label>
                     <input type="text" class="form-control" name="values[phone]" value="{{ $additional->values->phone }}"  required="required">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Address</label>
                     <textarea class="form-control" name="values[address]">{{ $additional->values->address }}</textarea>
                  </div>
                  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{ route('admin.faq.index', request()->type) }}" class="btn btn-primary">Cancel</a>
               </div>
            </form>
         </div>
         <!-- /.box -->
         <!-- /.box -->
      </div>
   </div>
</section>
@endsection