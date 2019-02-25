<!-- Sub menu area-->
<div class="header_bottom_area">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="hb_inner">
                  <div class="hbi_left aplicationleftsection">
                      <ul>
                          <li>Welcome Back {{ auth()->user()->name }}!</li>
                          {{--<li> auth()->user()->details->school->values->school_name </li>--}}
                          {{--<li> carbon()->now()->format(config('global.date_format'))</li>--}}
                          {{--<li>{{ carbon()->now()->format(config('global.time_format')) }}</li>--}}
                      </ul>
                  </div>
                  <div class="hbi_right aplicationrightsection">
                      <div class="buy-creditsection">You have <span id="credit-score">{{ auth()->user()->getUser()->details->credit }}</span> credits left | <a href="{{ route('employer.buy.credit') }}">Buy Credits</a> </div>
                      <div class="hb_cart">
                          <a href="{{ route('employer.carts.index') }}"><img src="/images/cart-icon.png" alt=""> CART (<span id="cart-counter">{{ $commonService->cart()->count() }}</span>)</a>
                      </div>
                      @if($commonService->cart()->count() > 0 && auth()->user()->getUser()->details->credit > 0)
                      <div class="hb_checkout" >
                          <a href="{{ route('employer.place.order') }}">Checkout</a>
                      </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@include("common.success")