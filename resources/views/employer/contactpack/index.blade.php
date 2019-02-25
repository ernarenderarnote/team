
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
             
                <p>Contact packs allow you to buy contact information of educators. When you purchase contact information of
                  an educator and they approve, you will be charged 1 credit.
                  </p>
                <h4>1 successful contact = 1 credit</h4>
                
                @include("employer.contactpack.list")
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection