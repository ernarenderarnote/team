 
@extends('layouts.default')

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
                                  
                                   <form action="" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                       <fieldset>
                                           <label for="region">1. What region do you currently work in?</label>
                                           <select name="region" id="region">
                                               <option value="West">West</option>
                                               <option value="Mid-West">Mid-West</option>
                                               <option value="South">South</option>
                                               <option value="North East">North East</option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="region-relocate">2. What region(s) are you willing to relocate to?</label>
                                           <span>Note: You can select multiple positions.</span>
                                           <select name="relocate[]" id="region-relocate" multiple="multiple">
                                              <?php for($reginNum=1; $reginNum<=20; $reginNum++){?>
                                                <option value="{{ $reginNum }}">{{ $reginNum }}</option>
                                              <?php }?>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="gender">3. What is your gender? </label>
                                           <select name="gender" id="gender">
                                               <option value="m">Male</option>
                                               <option value="f">Female</option>
                                               <option value="blank">Prefer not to answer</option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="campus">4. Do you currently work at the campus or district level? </label>
                                           <select name="campus" id="campus">
                                               <option value="Campus">Campus</option>
                                               <option value="District Level">District Level</option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="classify">5. Which of the following would your classify yourself as?</label>
                                           <select name="classify" id="classify">
                                              @foreach($positions as $position)
                                                  <option value="{{ $position->id }}">{{ $position->name }}</option>
                                              @endforeach   
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="creditable">6. How many years of creditable experience do you have?</label>
                                           <select name="creditable_experience" id="creditable">
                                               <option value="1">1 </option>
                                               <option value="2">2 </option>
                                               <option value="3">3 </option>
                                               <option value="4">4</option>
                                               <option value="5-10">Between 5 and 10 </option>
                                               <option value="11-20">Between 11 and 20 </option>
                                               <option value="20+">More than 20 </option>
                                               <option value="retire">Retire rehire </option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="amount">7. What is the minimum amount that you would accept in order to relocate?</label>
                                           <a target="_blank" href="http://tea.texas.gov/Texas_Educators/Salary_and_Service_Record/Minimum_Salary_Schedule/2017-2018_Minimum_Salary_Schedule/">Click here for current state minimums</a>
                                           <select name="amount_order_to_relocate" id="amount">
                                               <option value="parttime">Part-time min. wage rate on 180 days</option>
                                               <option value="20000-30000">Annually – 20k – 30k</option>
                                               <option value="30000-40000">Annually – 30k – 40k</option>
                                               <option value="40000-50000">Annually – 40k – 50k</option>
                                               <option value="50000-60000">Annually – 50k – 60k</option>
                                               <option value="60000-70000">Annually – 60k – 70k</option>
                                               <option value="70000-80000">Annually – 70k – 80k</option>
                                               <option value="80000-90000">Annually – 80k – 90k</option>
                                               <option value="90000-100000">Annually – 90k – 100k</option>
                                               <option value="100000">Annually - More than 100k </option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="degree">8. Highest degree attained?</label>
                                           <select name="degree_attained" id="degree">
                                              @foreach($degreeAttained as $attained)
                                                <option value="{{ $attained->id }}">{{ $attained->name }}</option>
                                              @endforeach
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="position">9. What is your current position? </label>
                                           <select name="current_position" id="position">
                                                @foreach($positions as $position)
                                                  <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                @endforeach
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="least-amount">10. What is the least amount you would be willing to make?</label>
                                           <select name="least_amount" id="least-amount">
                                               <option value="20000-30000">20k – 30k</option>
                                               <option value="30000-40000">30k – 40k</option>
                                               <option value="40000-50000">40k – 50k</option>
                                               <option value="50000-60000">50k – 60k</option>
                                               <option value="60000-70000">60k – 70k</option>
                                               <option value="70000-80000">70k – 80k</option>
                                               <option value="80000-90000">80k – 90k</option>
                                               <option value="90000-100000">90k – 100k</option>
                                               <option value="100000">More than 100k</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="qualified">11. Select positions you would you accept and are generally qualified for. </label>
                                           <span>Note: You can select multiple positions.</span>
                                           <select name="accept_positions[]" id="qualified" multiple="multiple">
                                              @foreach($categories as $pCategory)
                                              <optgroup label="{{ $pCategory->name }}">
                                                @foreach($pCategory->sub as $sCategory)
                                                  <option value="{{ $sCategory->id }}">{{ $sCategory->name }}</option>
                                                @endforeach
                                              </optgroup>
                                              @endforeach
                                            </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="experience">12. Years’ experience? </label>
                                           <select name="experience" id="experience">
                                               <option value="1">1 </option>
                                               <option value="2">2 </option>
                                               <option value="3">3 </option>
                                               <option value="4">4</option>
                                               <option value="5-10">Between 5 and 10 </option>
                                               <option value="11-20">Between 11 and 20 </option>
                                               <option value="20+">More than 20 </option>
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="certifications">13. What certifications do you have?</label>
                                           <span>Note: You can select multiple certifications.</span>
                                           <select name="certifications[]" id="certifications" multiple="multiple">
                                              @foreach($grades as $pGrade)
                                              <optgroup label="{{ $pGrade->name }}">
                                                @foreach($pGrade->sub as $grade)
                                                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                              </optgroup>
                                              @endforeach
                                           </select>
                                       </fieldset>
                                       
                                       <fieldset>
                                           <label for="certifications">14. Are you willing to consider additional duties</label>
                                           <span>(Bus Driver, Coaching, and academic UIL, club Sponsor ect.)</span>
                                           <select name="is_additional_duties" id="certifications">
                                               <option value="1">Yes</option>
                                               <option value="0">No</option>
                                           </select>
                                       </fieldset>
                                       <fieldset>
                                           <label for="resume">15. Upload Your Resume</label>
                                           <input class="resume-select" type="file" name="resume" />
                                           @if ($errors->has('resume'))
                                               <span style="color:red;" class="err">{{ $errors->first('resume') }}</span>
                                          @endif
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