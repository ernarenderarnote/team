
@extends('layouts.employer')

@section('content')
<div class="job_listing_area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="job_listing_inner">
            <div class="jobl_header text-center">
              <h2>APPLICANT CART</h2>
            </div>
            <div class="applicationcart-page">
              <div class="application-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Order#</th>
                      <th>Added By</th>
                      <th>Description</th>
                      <th>Amount(Credits)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($carts as $cart)
                    <tr>
                      <td>#{{ $cart->id }}</td>
                      <td>{{ $cart->addedBy->name }}</td>
                      <td><a href="#">{{  $cart->count_addby }} Applicants Pending</a></td>
                      <td>{{ $cart->count_addby }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4">Sorry! There is nothing to show here.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
               <!--  <div class="total-cartrate">
                  <h5>Total Due: 13 Credits</h5>
                  <p>You have 10 credits in your account.</p>
                </div> -->
                @if(auth()->user()->getUser()->details->credit >= $needCredit && $carts->count() > 0 )
                  <div class="place-orderlink"> <a href="{{ route('employer.place.order') }}">Place Order</a> </div>
                @elseif($carts->count() > 0)
                  <div class="place-orderlink"> <a data-toggle="modal" href="#not-enoughcredit" >Place Order</a> </div>
                @endif
                <div class="note-order">
                  <p>Note: Credits will not be debited from your account until the applicant approves your contact request.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('modal')
<!--order-modal start here-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h4>To place an order, you must first add a credit card on file</h4>
        <h5> You will automatically be billed at the end of the month for your total balance due. </h5>
        <div class="order-popupform">
          <form method="post" action="">
            <h6>Your Details</h6>
            <div class="col-md-6 first-field">
              <div class="form-group">
                <label> First Name</label>
                <input type="text" class="form-control" name="firstname">
              </div>
            </div>
            <div class="col-md-6 second-field">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname">
              </div>
            </div>
            <h6>Your Credit Card Details</h6>
            <div class="form-group card-number">
              <label>Credit Card Number</label>
              <input type="text" class="form-control" name="cardnumber">
            </div>
            <div class="col-md-4 first-field">
              <label>Expiry Date</label>
              <select class="form-control" id="month">
                <option value="month">Month</option>
                <option value="january">January</option>
                <option value="febuary">Febuary</option>
                <option value="march">March</option>
                <option value="aprail">Aprail</option>
                <option value="may">May</option>
                <option value="june">June</option>
                <option value="july">July</option>
                <option value="august">August</option>
                <option value="september">September</option>
                <option value="october">October</option>
                <option value="november">November</option>
                <option value="december">December</option>
              </select>
            </div>
            <div class="col-md-4">
              <label>Last Name</label>
              <select class="form-control" id="year">
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
              </select>
            </div>
            <div class="col-md-4 second-field">
              <label>CVC</label>
              <input type="text" class="form-control">
            </div>
            <p><img src="/images/lockorder.png">&nbsp; &nbsp; Secure Checkout. By Submitting this form you agree to our <a href="">Terms of Service</a></p>
            <div class="orderform-button"> <a href="">Add Card & Finish</a></div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--order-modal end here--> 

<div class="modal fade not-enoughcartcontent" id="not-enoughcredit" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          <h5>Sorry, you do not have enough credits to complete this purchase. </h5>
          <h5>Please buy a credit pack below.</h5>
          <h4>1 successful contact = 1 credit</h4>
          @include("employer.contactpack.list")
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endpush

@push('js')

<script type="text/javascript">
  
  $(function(){

    var hasModalOpen =  "{{ $errors->has('pack') }}";
    if( hasModalOpen ) { $("#not-enoughcredit").modal("show"); }

  });

</script>

@endpush



