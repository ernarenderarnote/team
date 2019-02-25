@extends("AdminLte::layouts.adminLte")
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-offset-2 col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add New State</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{ route('admin.add-state') }}">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Full Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" name="state_name" placeholder="State Full Name">
                  @if ($errors->has('state_name'))
                    <span class="help-block">
                      <strong style="color:red">{{ $errors->first('state_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Short Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" name="state_short_name" placeholder="State Short Name">
                  @if ($errors->has('state_short_name'))
                    <span class="help-block">
                      <strong style="color:red">{{ $errors->first('state_short_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Save State</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection