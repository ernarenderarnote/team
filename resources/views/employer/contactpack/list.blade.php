
@inject("contactPackService", "App\Services\ContactPackService")

<form method="post" action="{{ route('employer.credit.pay') }}" class="credit-form">

{{ csrf_field() }}

@forelse($contactPackService->all() as $contactPack )
<div class="form-group">
<div class="radio-main">
  <label>
    <input name="pack" type="radio" value="{{ $contactPack->id }}">
    {{ $contactPack->credit }} Credits - ${{ number_format($contactPackService->getPriceIfHasOffer($contactPack)) }}</label>
    @if($contactPack->offer_type == "percent")
      <span class="save-offer">Save over {{ $contactPack->offer_value}}% per credit!</span>
    @endif
</div>
</div>
@empty
  No Record
@endforelse

@hasErrorMsg("pack")
  <div class="button-group">
  	<button type="submit" name="type" value="paypal" class="paypalcredit-button"><img src="/images/paypalbutton.png" alt="paypal"></button>
  	<button type="submit" name="type" value="stripe" class="paypalcard-button"> Pay with Card</button>
  </div>
</form>
