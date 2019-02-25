
@extends('layouts.default')

@section('content')
  <!-- Banner area-->
  <section class="banner_area">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="banner_inner text-center">
                      <h1>Where Opportunities in the Education Industry Find You Anonymously.</h1>
                      
                      <ul>
                          <li class="imeducator"><a href="{{ route('signup.educator.step') }}">I’M AN EDUCATOR</a></li>
                          <li class="imemployer"><a href="{{ route('signup.employer')  }}">I’M AN EMPLOYER</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div><!-- Container End -->
  </section>
  <!-- Banner area End-->
  <!-- Promo area-->
  <section class="promo_area section-padding">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="promo_inner">
                      <div class="section_heading text-center">
                          <h2>What We Offer</h2>
                     </div>
                     <div class="row">
                           <!-- Single offer start -->
                         <div class="col-md-3">
                             <div class="single_offer">
                                  <figure>
                                      <img src="images/proffessional-forum.jpg" alt="Professional Forums">
                                    </figure> 
                                    
                                    <div class="offer_detail">
                                       <div class="offer_detail_left">
                                            <h3>Professional Forums</h3>
                                       </div>
                                       <div class="offer_detail_right">
                                            <a href="#">More >></a>
                                       </div>
                                    </div>
                             </div>
                         </div>
                           <!-- Single offer start -->
                         <div class="col-md-3">
                             <div class="single_offer">
                                  <figure>
                                      <img src="images/education-podcast.jpg" alt="Education podcast">
                                    </figure> 
                                    
                                    <div class="offer_detail">
                                       <div class="offer_detail_left">
                                            <h3>Education podcast</h3>
                                       </div>
                                       <div class="offer_detail_right">
                                            <a href="#">More >></a>
                                       </div>
                                    </div>
                             </div>
                         </div>
                           <!-- Single offer start -->
                         <div class="col-md-3">
                             <div class="single_offer">
                                  <figure>
                                      <img src="images/resume-services.jpg" alt="Resume Services">
                                    </figure> 
                                    
                                    <div class="offer_detail">
                                       <div class="offer_detail_left">
                                            <h3>Resume Services</h3>
                                       </div>
                                       <div class="offer_detail_right">
                                            <a href="#">More >></a>
                                       </div>
                                    </div>
                             </div>
                         </div>
                           <!-- Single offer start -->
                         <div class="col-md-3">
                             <div class="single_offer">
                                  <figure>
                                      <img src="images/search-services.jpg" alt="Search Services">
                                    </figure> 
                                    
                                    <div class="offer_detail">
                                       <div class="offer_detail_left">
                                            <h3>Search Services</h3>
                                       </div>
                                       <div class="offer_detail_right">
                                            <a href="#">More >></a>
                                       </div>
                                    </div>
                             </div>
                         </div>
                         
                     </div> 
                     
                     <div class="look_more text-center">
                         <h3>Looking for current events? <a href="#">Click here.</a></h3>
                     </div>
                  </div>
              </div>
          </div>
      </div><!-- Container End -->
  </section>
  <!-- Banner area End-->
@endsection