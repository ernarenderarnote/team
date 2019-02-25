@extends("AdminLte::layouts.adminLte")
@section('content')
	<section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        		<div class="box">
		            <div class="box-header">
		              <h3 class="box-title">State Listings</h3>
		              <a style="float:right" href="{{ route('admin.add-state') }}" class="btn btn-success btn-sm">Add State</a>
		            </div>
            		<!-- /.box-header -->
            		<div class="box-body">
              			<table id="example1" class="table table-bordered table-striped">
			                <thead>
				                <tr>
				                  <th>#</th>
				                  <th>Short Name</th>
				                  <th>Full Name</th>
				                </tr>
			                </thead>
			                <tbody>
			                	<?php $i = 1; ?>
			                	@foreach($states as $state)
				                	<tr>
				                  		<td>{{ $i }}</td>
				                  		<td>{{ $state->short_name }}</td>
				                  		<td>{{ $state->name }}</td>
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