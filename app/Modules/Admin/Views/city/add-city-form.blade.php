@extends("AdminLte::layouts.adminLte")
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-offset-2 col-md-6">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add New City</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="{{ route('admin.add-city') }}">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Choose State</label>
                <div class="col-sm-10">
                  <select class="form-control" name="state">
                    <option value="">Choose State</option>
                    @foreach($states as $state)
                      <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('state'))
                    <span class="help-block">
                      <strong style="color:red">{{ $errors->first('state') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">City Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" name="city_name" placeholder="City Name">
                  @if ($errors->has('city_name'))
                    <span class="help-block">
                      <strong style="color:red">{{ $errors->first('city_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Save City</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection