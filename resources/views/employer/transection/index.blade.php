
@extends('layouts.employer')

@section('content')
<div class="job_listing_area">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="job_listing_inner">
               <div class="jobl_header text-center">
                  <h2>TRANSACTIONS</h2>
               </div>
               @forelse($mds as $md => $transections)
               <div class="transections-innertop">

                  
                  <div class="transections-innertopheading">
                     <div class="transections-innertopleft">
                        <h4>{{ carbon($md)->format(config('global.date_format')) }} - {{ carbon($md.'-'.carbon($md)->format("t"))->format(config('global.date_format')) }}</h4>
                     </div>
                     @if($loop->first)
                     <div class="transections-innertopright"> <span class="print-link"><a href="" onclick="window.print();return false;"><img src="/images/print.png"></a></span> <span class="calender-link"><a href=""><img src="/images/calendertransection.png"></a></span> <span class="date-value"> Last 3 Months <a href=""> <img src="/images/transection-polygon.png"></a></span> </div>
                     @endif
                  </div>
                 
                  <!-- <div class="transections-innertopmiddle">
                     <h4>Ending balance due: $1080.00</h4>
                  </div> -->
                  <div class="transections-innertoptable">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Date</th>
                              <!-- <th class="description-fields">Description</th> -->
                              <th>Amount(USD)</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($transections  as $transection)
                           <tr>
                              <td>{{ carbon($transection->created_at)->format(config("global.date_format")) }}</td>
                             <!--  <td><a href="">5 Applicants Approved</a></td> -->
                              <td>${{ $transection->amount }}</td>
                           </tr>
                           @empty
                              <tr>
                                 <td colspan="2">Sorry! There is nothing to show here.</td>
                              </tr>
                           @endforelse
                          <!--  <tr>
                              <td>March 11, 2017</td>
                              <td><a href="">1 Applicants Approved</a></td>
                              <td>$20.00</td>
                           </tr>
                           <tr>
                              <td>March 9, 2017</td>
                              <td><a href="">2 Applicants Approved</a></td>
                              <td>$40.00</td>
                           </tr>
                           <tr>
                              <td>March 7, 2017</td>
                              <td><a href="">3 Applicants Approved</a></td>
                              <td>$60.00</td>
                           </tr>
                           <tr>
                              <td>March 6, 2017</td>
                              <td><a href="">2 Applicants Approved</a></td>
                              <td>$40.00</td>
                           </tr>
                           <tr>
                              <td>March 5, 2017</td>
                              <td><a href="">5 Applicants Approved</a></td>
                              <td>$100.00</td>
                           </tr>
                           <tr>
                              <td>March 4, 2017</td>
                              <td><a href="">1 Applicants Approved</a></td>
                              <td>$20.00</td>
                           </tr>
                           <tr>
                              <td></td>
                              <td>
                                 <ul>
                                    <li>John Doe</li>
                                    <li>Chemistry Teacher</li>
                                    <li><a href="">View Contact Information</a></li>
                                 </ul>
                              </td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>March 2, 2017</td>
                              <td><a href="">5 Applicants Approved</a></td>
                              <td>$100.00</td>
                           </tr>
                           <tr>
                              <td>March 1, 2017</td>
                              <td><a href="">5 Applicants Approved</a></td>
                              <td>$100.00</td>
                           </tr> -->
                        </tbody>
                     </table>
                  </div>
                  <div class="transections-innertoplast">
                    <!--  <h4>Starting Balance: $ {{$transections->sum('amount') }}</h4> -->
                     <h4>Total Balance: $ {{$transections->sum('amount') }}</h4>
                  </div>
               </div>
               @empty
                  No Record found
               @endforelse
               <!-- <div class="transections-innermiddle">
                  <div class="transections-innermiddleleft">
                     <h4>FEB 1 2017 - FEB 28 2017</h4>
                  </div>
                  <div class="transections-innermiddleright">
                     <h4>Ending balance due: $500.00</h4>
                  </div>
               </div>
               <div class="transections-innermiddle">
                  <div class="transections-innermiddleleft">
                     <h4>JAN 1 2017 - JAN 31 2017</h4>
                  </div>
                  <div class="transections-innermiddleright">
                     <h4>Ending balance due: $500.00</h4>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
@endsection