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
               <h3 class="box-title">Edit School </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.employer.contactpacks.update', $contactpack->id) }}" method="post">
               {{ csrf_field() }}
               {{ method_field('put') }}
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Credit</label>
                     <input type="text" class="form-control"  name="credit" placeholder="Enter number of credit" value="{{ old('credit', $contactpack->credit) }}">
                     @hasErrorMsg('credit')
                  </div>
               </div>
               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Price</label>
                     <input type="text" class="form-control"  name="price" placeholder="Enter number of price" value="{{ old('price', $contactpack->price) }}">
                      @hasErrorMsg('price')
                  </div>
               </div>

               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Credit Value</label>
                     <input type="text" class="form-control"  name="offer_value" placeholder="Enter number" value="{{ old('offer_value', $contactpack->offer_value) }}">
                      @hasErrorMsg('offer_value')
                  </div>
               </div>

               <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Offer type </label>
                     <select name="offer_type">
                       <option value="">Select offer type</option>
                       <option value="percent" @if(old("offer_type", $contactpack->offer_type) == 'percent') selected="selected" @endif>Percent</option>
                     </select>
                      @hasErrorMsg('offer_type')
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