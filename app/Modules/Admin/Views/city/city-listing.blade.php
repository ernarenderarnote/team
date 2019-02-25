@extends("AdminLte::layouts.adminLte")
@section('content')
	<section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box">
		            <div class="box-header">
		              <h3 class="box-title">City Listings</h3>
		              <a style="float:right" href="{{ route('admin.add-city') }}" class="btn btn-success btn-sm">Add City</a>
		            </div>
            		<!-- /.box-header -->
            		<div class="box-body">
              			<table id="example1" class="table table-bordered table-striped">
			                <thead>
				                <tr>
				                  <th>#</th>
				                  <th>State</th>
				                  <th>City</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php $i = 1; ?>
			                	@foreach($cities as $city)
				                	<tr>
				                  		<td>{{ $i }}</td>
				                  		<td>{{ $city->state->name }}</td>
				                  		<td>{{ $city->name }}</td>
				                	</tr>
				                <?php $i++; ?>
				                @endforeach
                			</tbody>
             			 </table>
            		</div>
            		<!-- /.box-body -->
          		</div>
        	</div>
        </div>
    </section>
@endsection

@push('js')
  <script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
@endpush
