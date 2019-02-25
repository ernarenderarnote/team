<!-- Sub menu area-->
<div class="header_bottom_area">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="hb_inner">
                  <div class="hbi_left">
                      <ul>
                          <li>Welcome Back {{ auth()->user()->name }}!</li>
                          {{--<li>{{ carbon()->now()->format(config('global.date_format')) }}</li>
                          <li>{{ carbon()->now()->format(config('global.time_format')) }}</li>--}}
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@include("common.success")
