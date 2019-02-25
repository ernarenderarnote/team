
@extends('layouts.employer')

@section('content')
<div class="job_listing_area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="job_listing_inner">
            <div class="jobl_header text-center">
              <h2>PURCHASE CONTACT PACKS</h2>
            </div>
            <div class="applicationcart-page contact-packssection">
              <form method="post" action="#" class="credit-form">
                <p>Contact packs allow you to buy contact information of educators. When you purchase contact information of
                  an educator and they approve, you will be charged 1 credit.
                  </p>
                <h4>1 successful contact = 1 credit</h4>
                <div class="form-group">
                  <div class="radio-main">
                    <label>
                      <input name="optradio" type="radio">
                      10 Credits - $99</label>
                  </div>
                  <div class="radio-main">
                    <label>
                      <input name="optradio" type="radio">
                      50 Credits - $249 </label>
                    <span class="save-offer">Save over 50% per credit!</span></div>
                  <div class="radio-main">
                    <label class="cart-radio">
                      <input name="optradio" type="radio">
                      250 Credits - $999</label>
                  </div>
                  <div class="radio-main">
                    <label class="cart-radio">
                      <input name="optradio" type="radio">
                      1000 Credits - $3,499</label>
                  </div>
                </div>
                <div class="button-group">
                  <button type="button" class="paypalcredit-button"><img src="images/paypalbutton.png" alt="paypal"></button>
                  <button type="button" class="paypalcard-button"> Pay with Card</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection