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
               <h3 class="box-title">Create  Faq </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.faq.store', request()->type) }}" method="post">
               {{ csrf_field() }}
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Question</label>
                     <input type="text" class="form-control" id="exampleInputEmail1" name="question" value="{{ old('question') }}" placeholder="Enter Question">
                     @hasErrorMsg('question')
                  </div>

                  <div class="form-group">
                     <label for="exampleInputPassword1">Answer</label>
                     <textarea name="answer" class="form-control">{{ old('answer') }}</textarea>
                     @hasErrorMsg('answer')
                  </div>
                  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
         <!-- /.box -->
         <!-- /.box -->
      </div>
   </div>
</section>
@endsection