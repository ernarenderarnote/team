<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
  <h4>To place an order, you must first add a credit card on file</h4>
  <h5> You will automatically be billed at the end of the month for your total balance due. </h5>
  <div class="order-popupform">
    <form method="post" action="{{ route('employer.cards.index') }}">
      {{ csrf_field() }}
      <input type="hidden" name="type" value="submit"/>
      <h6>Your Details</h6>
      <div class="col-md-6 first-field">
        <div class="form-group">
          <label> First Name</label>
          <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
          @hasErrorMsg("first_name")
        </div>
      </div>
      <div class="col-md-6 second-field">
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
          @hasErrorMsg("last_name")
        </div>
      </div>
      <h6>Your Credit Card Details</h6>
      <div class="form-group card-number">
        <label>Credit Card Number</label>
        <input type="text" class="form-control" name="card_number" value="{{ old('card_number') }}">
        @hasErrorMsg("card_number")
      </div>
      <div class="col-md-4 first-field">
        <label>Expiry Date</label>
        <select class="form-control" id="month" name="expiry_month">
          <option value="">Month</option>
          <option value="01" @if(old('expiry_month') == '01') selected="selected" @endif > January</option>
          <option value="02" @if(old('expiry_month') == '02') selected="selected" @endif > Febuary</option>
          <option value="03" @if(old('expiry_month') == '03') selected="selected" @endif > March</option>
          <option value="04" @if(old('expiry_month') == '04') selected="selected" @endif > Aprail</option>
          <option value="05" @if(old('expiry_month') == '05') selected="selected" @endif > May</option>
          <option value="06" @if(old('expiry_month') == '06') selected="selected" @endif > June</option>
          <option value="07" @if(old('expiry_month') == '07') selected="selected" @endif > July</option>
          <option value="08" @if(old('expiry_month') == '08') selected="selected" @endif > August</option>
          <option value="09" @if(old('expiry_month') == '09') selected="selected" @endif > September</option>
          <option value="10" @if(old('expiry_month') == '10') selected="selected" @endif > October</option>
          <option value="11" @if(old('expiry_month') == '11') selected="selected" @endif > November</option>
          <option value="12" @if(old('expiry_month') == '12') selected="selected" @endif > December</option>
        </select>
        @hasErrorMsg("expiry_month")
      </div>
      <div class="col-md-4">
        <label>Last Name</label>
        <select class="form-control" id="year" name="expiry_year" value="{{ old('expiry_year') }}">
          @for($i = 2017; $i < 2050; $i++)
          <option value="{{ $i }}" @if(old('expiry_year') == $i) selected="selected" @endif>{{ $i }}</option>
          @endfor
        </select>
        @hasErrorMsg("expiry_year")
      </div>
      <div class="col-md-4 second-field">
        <label>CVC</label>
        <input type="text" class="form-control" name="cvc" value="{{ old('cvc') }}">
      </div>
      @hasErrorMsg("cvc");
      <p>
        <img src="/images/lockorder.png">
        &nbsp; &nbsp; Secure Checkout. By Submitting this form you agree to our 
        <a href="">Terms of Service</a>
      </p>
      <div class="orderform-button">
        <button type="submit"  class="addcardsubmitmain">Add Card & Finish</button>
        
      </div>
    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>