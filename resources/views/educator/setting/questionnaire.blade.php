 
@extends('layouts.educator')

@section('content') 
  <!-- Breadcumb area-->
   <div class="breadcumb_area">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="bc_inner">
                       <p><span>Educator</span> Questionnaire</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
   
   <!-- Login area-->
   <main class="login_container signup quetionnarre">
       <div class="container">
           <div class="row">
                <div class="col-md-12">
                    <div class="signup_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login_inner">
                                   <form action="" method="post">
                                        {{ csrf_field() }}
                                       <fieldset>
                                           <label for="region">1. What region do you currently work in?</label>
                                           <select name="region" id="region">
                                               <option value="West" @if($details->region == "West") checked @endif>West</option>
                                               <option value="Mid-West" @if($details->region == "Mid-West") checked @endif>Mid-West</option>
                                               <option value="South" @if($details->region == "South") checked @endif>South</option>
                                               <option value="North East" @if($details->region == "North East") checked @endif>North East</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="region-relocate">2. What region(s) are you willing to relocate to?</label>
                                           <span>Note: You can select multiple positions.</span>
                                           <select name="relocate[]" id="region-relocate" multiple="multiple">
                                               @php $relocate = is_array($details->relocate)? $details->relocate : [] @endphp
                                               <option value="West" @if(in_array('West', $relocate)) selected @endif >West</option>
                                               <option value="Mid-West" @if(in_array('Mid-West', $relocate)) selected @endif >Mid-West</option>
                                               <option value="South" @if(in_array('South', $relocate)) selected @endif >South</option>
                                               <option value="North East" @if(in_array('North East', $relocate)) selected @endif >North East</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="gender">3. What is your gender? </label>
                                           <select name="gender" id="gender">
                                               <option value="m" @if($details->gender == 'm') selected @endif >Male</option>
                                               <option value="f" @if($details->gender == 'f') selected @endif >Female</option>
                                               <option value="blank" @if($details->gender == 'blank') selected @endif>Prefer not to answer</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="campus">4. Do you currently work at the campus or district level? </label>
                                           <select name="campus" id="campus">
                                               <option value="Campus" @if($details->campus == 'Campus') selected @endif >Campus</option>
                                               <option value="District Level" @if($details->campus == 'District Level') selected @endif>District Level</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="classify">5. Which of the following would your classify yourself as?</label>
                                           <select name="classify" id="classify">
                                              @foreach($positions as $position)
                                                  <option value="{{ $position->id }}" @if($details->classify == $position->id) selected @endif>{{ $position->name }}</option>
                                              @endforeach   
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="creditable">6. How many years of creditable experience do you have?</label>
                                           <select name="creditable_experience" id="creditable">
                                               <option value="1" @if($details->creditable_experience == 1) selected @endif>1 </option>
                                               <option value="2" @if($details->creditable_experience == 2) selected @endif>2 </option>
                                               <option value="3" @if($details->creditable_experience == 3) selected @endif>3 </option>
                                               <option value="4" @if($details->creditable_experience == 4) selected @endif>4</option>
                                               <option value="5-10" @if($details->creditable_experience == "5-10") selected @endif>Between 5 and 10 </option>
                                               <option value="11-20" @if($details->creditable_experience == "11-20") selected @endif>Between 11 and 20 </option>
                                               <option value="20+" @if($details->creditable_experience == "20+") selected @endif>More than 20 </option>
                                               <option value="retire" @if($details->creditable_experience == "retire") selected @endif>Retire rehire </option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="amount">7. What is the minimum amount that you would accept in order to relocate?</label>
                                           <a href="#">Click here for current state minimums</a>
                                           <select name="amount_order_to_relocate" id="amount">
                                               <option value="parttime" @if($details->amount_order_to_relocate == "parttime") selected @endif>Part-time min. wage rate on 180 days</option>
                                               <option value="20000-30000" @if($details->amount_order_to_relocate == "20000-30000") selected @endif>Annually – 20k – 30k</option>
                                               <option value="30000-40000" @if($details->amount_order_to_relocate == "30000-40000") selected @endif>Annually – 30k – 40k</option>
                                               <option value="40000-50000" @if($details->amount_order_to_relocate == "40000-50000") selected @endif>Annually – 40k – 50k</option>
                                               <option value="50000-60000" @if($details->amount_order_to_relocate == "50000-60000") selected @endif>Annually – 50k – 60k</option>
                                               <option value="60000-70000" @if($details->amount_order_to_relocate == "60000-70000") selected @endif>Annually – 60k – 70k</option>
                                               <option value="70000-80000" @if($details->amount_order_to_relocate == "70000-80000") selected @endif>Annually – 70k – 80k</option>
                                               <option value="80000-90000" @if($details->amount_order_to_relocate == "80000-90000") selected @endif>Annually – 80k – 90k</option>
                                               <option value="90000-100000" @if($details->amount_order_to_relocate == "90000-100000") selected @endif>Annually – 90k – 100k</option>
                                               <option value="100000" @if($details->amount_order_to_relocate == "100000") selected @endif>Annually - More than 100k </option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="degree">8. Highest degree attained?</label>
                                           <select name="degree_attained" id="degree">
                                              @foreach($degreeAttained as $attained)
                                                <option value="{{ $attained->id }}" @if($details->degree_attained == $attained->id) selected @endif>{{ $attained->name }}</option>
                                              @endforeach
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="position">9. What is your current position? </label>
                                           <select name="current_position" id="position">
                                                @foreach($positions as $position)
                                                  <option value="{{ $position->id }}" @if($details->current_position == $position->id) selected @endif>{{ $position->name }}</option>
                                                @endforeach
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="least-amount">10. What is the least amount you would be willing to make?</label>
                                           <select name="least_amount" id="least-amount">
                                               <option value="20000-30000" @if($details->least_amount == "20000-30000") selected @endif>20k – 30k</option>
                                               <option value="30000-40000" @if($details->least_amount == "30000-40000") selected @endif>30k – 40k</option>
                                               <option value="40000-50000" @if($details->least_amount == "40000-50000") selected @endif>40k – 50k</option>
                                               <option value="50000-60000" @if($details->least_amount == "50000-60000") selected @endif>50k – 60k</option>
                                               <option value="60000-70000" @if($details->least_amount == "60000-70000") selected @endif>60k – 70k</option>
                                               <option value="70000-80000" @if($details->least_amount == "70000-80000") selected @endif>70k – 80k</option>
                                               <option value="80000-90000" @if($details->least_amount == "80000-90000") selected @endif>80k – 90k</option>
                                               <option value="90000-100000" @if($details->least_amount == "90000-100000") selected @endif>90k – 100k</option>
                                               <option value="100000" @if($details->least_amount == "100000") selected @endif>More than 100k</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="qualified">11. Select positions you would you accept and are generally qualified for. </label>
                                           <span>Note: You can select multiple positions.</span>
                                           <select name="accept_positions[]" id="qualified" multiple="multiple">
                                              @php $accept_positions = is_array($details->accept_positions)? $details->accept_positions : [] @endphp
                                              @foreach($categories as $pCategory)
                                              <optgroup label="{{ $pCategory->name }}">
                                                @foreach($pCategory->sub as $sCategory)
                                                  <option value="{{ $sCategory->id }}" @if(in_array($sCategory->id, $accept_positions)) selected @endif>{{ $sCategory->name }}</option>
                                                @endforeach
                                              </optgroup>
                                              @endforeach
                                            </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="experience">12. Years’ experience? </label>
                                           <select name="experience" id="experience">
                                               <option value="1" @if($details->experience == "1") selected @endif>1 </option>
                                               <option value="2" @if($details->experience == "2") selected @endif>2 </option>
                                               <option value="3" @if($details->experience == "3") selected @endif>3 </option>
                                               <option value="4" @if($details->experience == "4") selected @endif>4</option>
                                               <option value="5-10" @if($details->experience == "5-10") selected @endif>Between 5 and 10 </option>
                                               <option value="11-20" @if($details->experience == "11-20") selected @endif>Between 11 and 20 </option>
                                               <option value="20+" @if($details->experience == "20+") selected @endif>More than 20 </option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="certifications">13. What certifications do you have?</label>
                                           <span>Note: You can select multiple certifications.</span>
                                           <select name="certifications[]" id="certifications" multiple="multiple">
                                              @foreach($grades as $pGrade)
                                              <optgroup label="{{ $pGrade->name }}">
                                                @foreach($pGrade->sub as $grade)
                                                  <option value="{{ $grade->id }}" @if(in_array($grade->id, $details->certifications)) selected @endif>{{ $grade->name }}</option>
                                                @endforeach
                                              </optgroup>
                                              @endforeach
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="certifications">14. Are you willing to consider additional duties</label>
                                           <span>(Bus Driver, Coaching, and academic UIL, club Sponsor ect.)</span>
                                           <select name="is_additional_duties" id="certifications">
                                               <option value="1" @if($details->is_additional_duties) selected @endif>Yes</option>
                                               <option value="0" @if(!$details->is_additional_duties) selected @endif>No</option>
                                           </select>
                                       </fieldset>
                                       <input type="submit" value="Submit Questionnaire" name="submit">
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
   </main>
@endsection