@extends('layouts.master.master')
@section('title', 'BARQAAB CV Record')
@section('Heading')

	<h3 class="text-themecolor">Edit CV Detail</h3>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
		
		
	</ol>
	
@stop
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card card-outline-info">
			
				<div class="row">
					<div class="col-lg-2">
					@include('layouts.vButton.cvButton')
					</div>
      	
		        	<div class="col-lg-10">
						 


		                <div class="card-body">

		                    <form id="test" method="post" class="form-horizontal form-prevent-multiple-submits" enctype="multipart/form-data">
		                    @method('PATCH')
		                        {{csrf_field()}}
		                        <div class="form-body">
		                            
		                            <h3 class="box-title">CV Detail</h3>
		                            <hr class="m-t-0 m-b-40">
		                            <!--row 1 -->
		                            <div class="row">
		                                <div class="col-md-3">
		                                 <!--/span 1-1 -->
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Full Name<span class="text_requried">*</span></label><br>
		                                       		<input type="text"  name="full_name" data-validation="required" value="{{old('full_name', $cvId->full_name)}}"  class="form-control" placeholder="Enter Full Name" >
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 1-2 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 ">
		                                        	<label class="control-label">Father Name</label>
		                                        
		                                            <input type="text"  name="father_name" value="{{old('father_name', $cvId->father_name)}}"   class="form-control" placeholder="Enter Father Name" >
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 1-3 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                        	<label class="control-label text-right">CNIC</label>
		                                        
		                                            <input type="text" name="cnic" id="cnic" pattern="[0-9.-]{15}" title= "13 digit Number without dash" value="{{old('cnic', $cvId->cnic)}}" class="form-control" onkeyup='addHyphen(this)'  placeholder="Enter CNIC without dash" >
		                                        </div>
		                                    </div>
		                                </div>
		                                 <!--/span 1-4 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 date_input">
		                                        	<label class="control-label text-right">Date of Birth</label>
		                                        
		                                            <input type="text" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth', $cvId->date_of_birth)}}"  class="form-control " readonly>
													 
		                                            <br>
		                                           <i class="fas fa-trash-alt text_requried"></i> 
		                                        </div>
		                                    </div>
		                                </div>
	                               
		                            </div>
		                             <!--row 2-->
		                            <div class="row">
		                                 <!--/span 2-1 -->
		                                 <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 date_input">
		                                        	<label class="control-label text-right">Job Starting Date<span class="text_requried">*</span></label>
		                                        
		                                            <input type="text" id="job_starting_date" name="job_starting_date" value="{{old('job_starting_date', $cvId->job_starting_date)}}" data-validation="required" class="form-control " placeholder="Enter Date of Birth" readonly>
													 
		                                            <br>
		                                           <i class="fas fa-trash-alt text_requried"></i> 
		                                        </div>
		                                    </div>
		                                </div>

		                                 <!--/span 2-2 -->
		                                <div class="col-md-6">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label ">Address</label><br>
		                                       		<input type="text"  name="address" value="{{old('address', $cvId->cvContact->address)}}"   class="form-control" placeholder="Enter Address" >
		                                        </div>
		                                    </div>
		                                </div>
		                               
		                                <!--/span 2-3 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                        	<label class="control-label text-right">City</label>
		                                        	<select class="form-control" name="city_id" data-placeholder="First Select Province" id="city">
		                                        	<option value=""></option>
														@foreach($cities as $city)
														<option value="{{$city->id}}" {{(old("city_id",$cvId->cvContact->city_id)==$city->id? "selected" : "")}}>{{$city->name}}</option>
                                                    @endforeach 	
                                                    	
                                                    </select>	
		
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		               <!--row 3-->
		                            <div class="row" >

		                              <!--/span 3-1 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                        	<label class="control-label text-right">Province</label>
		                                       		
		                                        	<select class="form-control" name="state_id" data-placeholder="First Select Country" id="state">
		                                        	<option value="">'</option>
       												@foreach($states as $state)
														<option value="{{$state->id}}" {{(old("state_id",$cvId->cvContact->state_id)==$state->id? "selected" : "")}}>{{$state->name}}</option>
                                                    @endforeach 	
       												
                                                    </select>	
		                                       		
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="col-md-3">
		                                	<!--/span 3-2 -->
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Country<span class="text_requried">*</span></label><br>
		                                       		
		                                       		<select  name="country_id" id="country" data-validation="required" class="form-control">
			                                           	<option value=""></option>
			                                        @foreach($countries as $country)
														<option value="{{$country->id}}" {{(old("country_id",$cvId->cvContact->country_id)==$country->id? "selected" : "")}}>{{$country->name}}</option>
                                                    @endforeach 	
                                                    </select> 

		                                       	
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 3-3 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                        	<label class="control-label text-right">Email</label>
		                                        
		                                            <input type="email" name="email" value="{{old('email', $cvId->cvContact->email)}}" class="form-control" placeholder="Enter Email Address " >
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 3-4 -->
		                                 
		                                @foreach ($cvId->cvPhone as $key => $phone)
		                                
		                                <div class="col-md-3 phone" id="phone_1">
		                                	<div class="form-group row">
		                                        <div class="col-md-8">
		                                        	<label class="control-label text-right">Mobile Number<span class="text_requried">*</span></label>
		                                            <input type="text" name="phone[]['{{$phone->id}}']" data-validation="required" value="{{$phone->phone}}"  class="form-control" >

		                                        </div>
												<div class="col-md-4">
		                                        <br>
			                                        <div class="float-right">
			                                        @if($key==0)
			                                        <button type="button" name="add" id="add_phone" class="btn btn-success add" >+</button>
			                                        @else
			                                        <button type="button" name="add" id="add_phone" class="btn btn-danger remove_phone" >X</button>
			                                        @endif
													</div>
		                                        </div>
		                                    </div>
		                                </div>
		                                
		                                @endforeach
		                            </div>

		                             <!--row 4-->
		                        	@foreach($cvId->cvEducation as $key => $education)
		                            <div class="row education" id='edu_1' >
									
		                                <div class="col-md-3">
		                                	<!--/span 4-1 -->
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Name of Degree<span class="text_requried">*</span></label><br>
		                                       			<select  name="degree_name[]" id="degree_name" class="form-control required">
                                                        <option value=""></option>
                                                        @foreach($degrees as $degree)
														<option value="{{$degree->id}}" @if($degree->id == $education->id) selected="selected" @endif>{{$degree->degree_name}}</option>
                                                        @endforeach
                                                      
                                                    </select>

		                                        </div>
		                                    </div>
		                                </div>
									
		                                <!--/span 4-2 -->
		                                <div class="col-md-6">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 ">
		                                        	<label class="control-label">Name of Institut</label>
		                                            <input type="text" name="institute[]" id="institute" value="{{$education->pivot->institute}}"  class="form-control" placeholder="Enter Institute Name" >

		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 4-3 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-8">
		                                        	<label class="control-label text-right">Passing Year</label>
		                                        
		                                            <select  name="passing_year[]" id="passing_year" class="form-control" >

													<option value=""></option>
													@for ($i = 1958; $i <= now()->year; $i++)
    												<option value="{{$i}}" @if($i == $education->pivot->passing_year) selected="selected" @endif>{{ $i }}</option>
													@endfor

													</select>

		                                        </div>
		                                        <div class="col-md-4">
		                                        <br>
			                                        <div class="float-right">
			                                        @if($key==0)
			                                        <button type="button" name="add" id="add" class="btn btn-success add" >+</button>
			                                        @else
			                                        <button type="button" name="add" id="add" class="btn btn-danger remove_edu" >X</button>
			                                        @endif
													</div>
		                                        </div>
												
		                                    </div>
		                                </div>
		                                
		                            </div>
		                        @endforeach
		                             <!--row 5-->
		                        @foreach($cvId->CvExperience as $key => $speciality)
		                            <div class="row specialization" id='spe_1' >
		                                <div class="col-md-3">
		                                	<!--/span 5-1 -->
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Speciality<span class="text_requried">*</span></label><br>

		                                       		<select  name="speciality_name[]" id="speciality_name" class="form-control required" >
                                                         <option value=""></option>
                                                        
                                                        @foreach($specializations as $specialization)
														
														<option value="{{$specialization->id}}" 
														@if($specialization->id == $speciality->cv_specialization_id) selected="selected" @endif>{{$specialization->name}}</option>
                                                        @endforeach   
                                                    </select>
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 5-2 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 ">
		                                        	<label class="control-label">Discipline<span class="text_requried">*</span></label>

		                                        	<select  name="discipline_name[]" data-validation="required" id=discipline_name class="form-control required" >
                                                        <option value=""></option>
                                                        
                                                        @foreach($disciplines as $discipline)

														<option value="{{$discipline->id}}"  
														@if($discipline->id == $speciality->cv_discipline_id) selected="selected" @endif
														>{{$discipline->name}}</option>

                                                        @endforeach
                                                      
                                                    </select>
		                                        
		                                            
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 5-2 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 ">
		                                        	<label class="control-label">Stage of Work<span class="text_requried">*</span></label>

		                                        	<select  name="stage_name[]" data-validation="required" id=stage_name class="form-control required" >
                                                        <option value=""></option>
                                                        
                                                        @foreach($stages as $stage)

														<option value="{{$stage->id}}"  
														@if($stage->id == $speciality->cv_stage_id) selected="selected" @endif
														>{{$stage->name}}</option>

                                                        @endforeach
                                                      
                                                    </select>
		                                        
		                                            
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 5-3 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-8">
		                                        	<label class="control-label text-right">Experience<span class="text_requried">*</span></label>
		                                        
		                                            <select  name="year[]" id="field_year" class="form-control required">

													<option value=""></option>
													@for ($i = 1; $i <= 50; $i++)
    												<option value="{{$i}}" 
														@if($i == $speciality->year) selected="selected" @endif
    												>{{ $i }}</option>
													@endfor
													</select>

		                                        </div>
		                                        <div class="col-md-4">
		                                        <br>
			                                        <div class="float-right">
			                                        @if($key==0)
			                                        <button type="button" name="add" id="add_spe" class="btn btn-success add" >+</button>
			                                        @else
			                                        <button type="button" name="add" id="add_spe" class="btn btn-danger remove_spe" >X</button>
			                                        @endif
													</div>
		                                        </div>
												
		                                    </div>
		                                </div>
		                                
		                            </div>
		                        @endforeach
		                            
		                <!--row 6-->
		                
		                            <div class="row" >
		                             <!--/span 6-1 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                        	<label class="control-label text-right">Foreign Experienc</span></label>
		                                        
		                                            <input type="text" id="foreign_experience" name="foreign_experience" value="{{ old('foreign_experience',$cvId->foreign_experience) }}" class="form-control " >
													 
		                                        </div>
		                                    </div>
		                                </div>
									<!--/span 6-2 -->
		                                <div class="col-md-3">
		                                
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Donor Experience</label><br>
		                                       		<input type="text"  name="donor_experience" value="{{ old('donor_experience', $cvId->donor_experience )}}" class="form-control" >
		                                        </div>
		                                    </div>
		                                </div>
						               
		                                @forelse($cvId->membership as $key => $member)      
		                            	<!--/span 6-3 -->
		                             	<div class="col-md-6 membership" id="membership_1">
		                                    <div class="form-group row">
		                                        <div class="col-md-6">
		                                        	<label class="control-label">Membership</label>
													
		                                        	<select  name="membership_name[]" id=membership_name class="form-control">
                                                        <option value="">'</option>
                                                        
                                                        @foreach($memberships as $membership)
														
														<option value="{{$membership->id}}" @if($membership->id == $member->id) selected="selected" @endif>{{$membership->name}}</option>

                                                        @endforeach
                                                      
                                                    </select>
		                                        </div>
		                                        <div class="col-md-4">
		                                        	<label class="control-label text-right">Number</label>
		                                            <input type="text" name="membership_number[]" value="{{ old('membership_number.0', $member->pivot->membership_number) }}" class="form-control" >
		                                             
                                            
		                                        </div>
		                                        <div class="col-md-2 ">
		                                        	<br>
		                                        	<div class="float-right">
		                                        	@if($key==0)
		                                             <button type="button" name="add" id="add_mem" class="btn btn-success add" >+</button>
		                                             @else
		                                             <button type="button" name="add" id="add_mem" class="btn btn-danger remove_membership" >X</button>
		                                             @endif
                                            		</div>
		                                        </div>
		                                    </div>
		                                </div>
		                               
						               @empty
						                 <!--/span 6-3 -->
		                                <div class="col-md-6 membership" id="membership_1">
		                                    <div class="form-group row">
		                                        <div class="col-md-6">
		                                        	<label class="control-label">Membership</label>

		                                        	<select  name="membership_name[]" id=membership_name class="form-control">
                                                       
                                                        
                                                        @foreach($memberships as $membership)
														 <option value=""></option>
														<option value="{{$membership->id}}" {{(old("membership_name.0")==$membership->id? "selected" : "")}}>{{$membership->membership_name}}</option>

                                                        @endforeach
                                                      
                                                    </select>
		                                        </div>
		                                        <div class="col-md-4">
		                                        	<label class="control-label text-right">Number</label>
		                                            <input type="text" name="membership_number[]" value="{{ old('membership_number.0') }}" class="form-control" >
		                                             
                                            
		                                        </div>
		                                        <div class="col-md-2 "> 
		                                        	<br>
		                                        	<div class="float-right">
		                                             <button type="button" name="add" id="add_mem" class="btn btn-success add" >+</button>
                                            		</div>
		                                        </div>
		                                    </div>
		                                </div>
						                @endforelse

		                 
		                           
		                            </div>
 						
 						<!--row 7-->
		                            <div class="row" >
		                                
		                                <!--/span 7-1 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 ">
		                                        	<label class="control-label">BARQAAB Employee<span class="text_requried">*</span></label>

		                                        	<select  name="barqaab_employment" class="form-control required" >

                                                        <option value="">'</option>
                                                        <option value="1" @if($cvId->barqaab_employment == 1) selected="selected" @endif>Yes</option>
                                                        <option value="0" @if($cvId->barqaab_employment == 0) selected="selected" @endif>No</option>
                                                                                                              
                                                    </select>
		                                        
		                                        </div>
		                                    </div>
		                                </div>
		                                <!--/span 7-2 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12 date_input">
		                                        	<label class="control-label text-right">CV Submision Date</label>
		                                        
		                                            <input type="text" name="cv_submission_date" value="{{ old('cv_submission_date', $cvId->cv_submission_date) }}" class="form-control" readonly>
		                                             <br>
		                                           <i class="fas fa-trash-alt text_requried"></i> 
		                                           
		                                        </div>
		                                    </div>
		                                </div>
		                                 <!--/span 7-3 --> 
		                                 <div class="col-md-6">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Comments</label><br>
		                                       		<input type="text"  name="comments" value="{{ old('comments', $cvId->comments) }}" class="form-control" >
		                                        </div>
		                                    </div>
		                                </div>
		                                
		                            </div>
		                
   								<!--row 8-->
		                            <div class="row" >
		                           
									@foreach($cvId->cvSkill as $key => $skill)
										<!--/span 8-1 -->
		                                <div class="col-md-3 skill" id="skill_1">

		                                    <div class="form-group row">
		                                        <div class="col-md-9">
		                                        	<label class="control-label text-right">Other Skills</label><br>
		                                       		<input type="text"  name="skill_name[]['{{$skill->id}}']" value="{{$skill->skill_name}}" class="form-control" >

		                                        </div>
		                                        <div class="col-md-3">
		                                        <br>
			                                        <div class="float-right">
			                                        @if($key==0)
			                                        <button type="button" name="add" id="add_skill" class="btn btn-success add" >+</button>
			                                        @else
			                                        <button type="button" name="add" id="add_skill" class="btn btn-danger remove_skill" >X</button>
			                                        @endif
													</div>
		                                        </div>
												
		                                    </div>
		                                </div>
		                              @endforeach
		                            </div>
		                     
		                            <!--row 9-->
		                            <div class="row" >
		                           
										<!--/span 9-1 -->
		                                <div class="col-md-3">
		                                    <div class="form-group row">
		                                        <div class="col-md-12">
		                                       		<label class="control-label text-right">Attached CV</label><br>
		                                       		<input type="file"  id="cv" name="cv"  class="form-control" ><span class="text_requried">doc, docx and pdf only</span>
		                                        </div>
		                                    </div>
		                                </div>
		                               
		                            </div>

		              <!-- row-10 -->
		                         <hr>
		                        <div class="form-actions">
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="row"> 
		                                       <div class="col-md-offset-3 col-md-9">
		                                            <button type="submit" id="submit"  class="btn btn-success btn-prevent-multiple-submits"><i class="fa fa-spinner fa-spin" style="font-size:18px"></i>Edit</button>
		                                            
		                                        </div>
		                                     
 

		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </form>
		        		</div>       
		        	</div>
		        </div>
            </div>
        </div>
    </div>
 @push('scripts')
	


<script>
$(document).ready(function(){
$('.fa-spinner').hide();



$('#test').on('submit', function(event){
 	event.preventDefault();
	url="{{route('cv.update',$cvId->id)}}";
	$('.fa-spinner').show();
   	submitForm(this, url);
		 
});































	$('select').chosen();
	// $.validate();
	// $('form').on('submit',function(e){
	// 	$(".required").each(function(){
	// 		if($(this).val()==''){
	// 			alert($(this).closest('div').find('label').text()+' value is missing');
	// 			$(this).closest('div').find('label').append("<br><span style='color:red;'>This Field is required</span>");

	// 			e.preventDefault();
	// 		}else
	// 		{
	// 			return true;
	// 		}
	// 	});
	//  });

		$('#country').change(function(){
        var cid = $(this).val();
        if(cid){
        $.ajax({
           type:"get",
           url: "{{url('country/states')}}"+"/"+cid,

           //url:" url('CV/uploadCv/getStates') /"+cid, **//Please see the note at the end of the post**
           success:function(res)
           {       
               
                if(res)
                {
                   $("#state").empty();
                    $("#state").append('<option value="">Select State</option>');
                    $.each(res,function(key,value){
                        $("#state").append('<option value="'+key+'">'+value+'</option>');
                        
                    });
                     $('#state').chosen('destroy');
                     $('#state').chosen();

                    $("#city").empty();
                    $("#city").append('<option>Select City</option>');
                    $('#city').chosen('destroy');
                    $('#city').chosen();

                }
           }

        });
        }
    });

    $('#state').change(function(){
        var sid = $(this).val();
        if(sid){
        $.ajax({
           type:"get",
            url: "{{url('country/cities')}}"+"/"+sid,
           success:function(res)
           {       
                if(res)
                {
                    $("#city").empty();
                    $("#city").append('<option value="">Select City</option>');
                    $.each(res,function(key,value){
                        $("#city").append('<option value="'+key+'">'+value+'</option>');
                    });
                    $('#city').chosen('destroy');
                    $('#city').chosen();
                }
           }

        });
        }
    }); 	


    




	
	 $("#cv").change(function(){
	 	var fileType = this.files[0].type;
	 	var fileSize = this.files[0].size;

	 	if (fileSize> 2048000){
		        	alert('File Size is bigger than 2MB');
		        	$(this).val('');
		}else{

		    if((fileType!='application/vnd.openxmlformats-officedocument.wordprocessingml.document')&&(fileType!='application/msword')&&(fileType!='application/pdf')){

	 		alert('Only pdf, doc and docx attachment allowed');
	 		$(this).val('');
	 		}
	 	}
	});
		
	 //Make sure that the event fires on input change
		$("#cnic").on('input', function(ev){
			
			//Prevent default
			ev.preventDefault();
			
			//Remove hyphens
			let input = ev.target.value.split("-").join("");
			
			//Make a new string with the hyphens
			// Note that we make it into an array, and then join it at the end
			// This is so that we can use .map() 
			input = input.split('').map(function(cur, index){
				
				//If the size of input is 6 or 8, insert dash before it
				//else, just insert input
				if(index == 5 || index == 12)
					return "-" + cur;
				else
					return cur;
			}).join('');
			
			//Return the new string
			$(this).val(input);
		});
		
		  //Dynamic add phone
		 // Add new element
		 $("#add_phone").click(function(){
		 	
		  // Finding total number of elements added
		  var total_element = $(".phone").length;
		 	
		  // last <div> with element class id
		  var lastid = $(".phone:last").attr("id");
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;
		  var max = 5;
		  // Check total number elements
		  if(total_element < max ){
		   //Clone specialization div and copy
		   	var $clone = $("#phone_1").clone();
		  	$clone.prop('id','phone'+nextindex).find('input:text').val('');
		   	$clone.find("#add_phone").html('X').prop("class", "btn btn-danger remove_phone");
		   	$clone.find('.remove_phone_div').remove();
		   	$clone.insertAfter("div.phone:last");
		  }
		 
		 });
		 // Remove element
		 $(document).on("click", '.remove_phone', function(){
		 $(this).closest(".phone").remove();
		  
 		}); 




		//Dynamic add education
		
		// Add new element
		 $("#add").click(function(){
		 	
		  // Finding total number of elements added
		  var total_element = $(".education").length;
		 	
		  // last <div> with element class id
		  var lastid = $(".education:last").attr("id");
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;
		  var max = 5;
		  // Check total number elements
		  if(total_element < max ){
		   //Clone education div and copy
		   $('.education').find('select').chosen('destroy');
		   	var clone = $(".education:last").clone();
		  	clone.prop('id','edu_'+nextindex).find('#degree_name, #institute, #passing_year').val('');
		   	clone.find("#add").html('X').prop("class", "btn btn-danger remove_edu");
		   	clone.insertAfter("div.education:last");
		   	$('.education').find('select').chosen();

		  }
		 
		});
		 // Remove element
		 $(document).on("click", '.remove_edu', function(){
		 $(this).closest(".education").remove();
 		}); 

		//Dynamic add specialization
		 // Add new element
		 $("#add_spe").click(function(){
		 	
		  // Finding total number of elements added
		  var total_element = $(".specialization").length;
		 	
		  // last <div> with element class id
		  var lastid = $(".specialization:last").attr("id");
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;
		  var max = 5;
		  // Check total number elements
		  if(total_element < max ){
		   //Clone specialization div and copy
		   $('.specialization').find('select').chosen('destroy');
		   	var $clone = $("#spe_1").clone();
		  	$clone.prop('id','spe_'+nextindex).find('#speciality_name, #field_name, #field_year').val('');
		   	$clone.find("#add_spe").html('X').prop("class", "btn btn-danger remove_spe");
		   	$clone.insertAfter("div.specialization:last");
		   	$('.specialization').find('select').chosen();
		  }
		 
		 });
		 // Remove element
		 $(document).on("click", '.remove_spe', function(){
		 $(this).closest(".specialization").remove();
		  
 		}); 


		 //Dynamic add Skill
		 // Add new element
		 $("#add_skill").click(function(){
		 	
		  // Finding total number of elements added
		  var total_element = $(".skill").length;
		 	
		  // last <div> with element class id
		  var lastid = $(".skill:last").attr("id");
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;
		  var max = 5;
		  // Check total number elements
		  if(total_element < max ){
		   //Clone specialization div and copy
		   	var $clone = $("#skill_1").clone();
		  	$clone.prop('id','skill_'+nextindex).find('input:text').val('');
		   	$clone.find("#add_skill").html('X').prop("class", "btn btn-danger remove_skill");
		   	$clone.insertAfter("div.skill:last");
		  }
		 
		 });
		 // Remove element
		 $(document).on("click", '.remove_skill', function(){
		 $(this).closest(".skill").remove();
		  
 		}); 

		 //Dynamic add membership
		 // Add new element
		 $("#add_mem").click(function(){
		 	
		  // Finding total number of elements added
		  var total_element = $(".membership").length;
		 	
		  // last <div> with element class id
		  var lastid = $(".membership:last").attr("id");
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;
		  var max = 5;
		  // Check total number elements
		  if(total_element < max ){
		   //Clone specialization div and copy
		   $('.membership').find('select').chosen('destroy');
		   	var $clone = $("#membership_1").clone();
		  	$clone.prop('id','membership_'+nextindex).find('input:text').val('');
		   	$clone.find("#add_mem").html('X').prop("class", "btn btn-danger remove_membership");
		   	$clone.find('.remove_div').remove();
		   	$clone.insertAfter("div.membership:last");
		   	$('.membership').find('select').chosen();
		  }
		 
		 });
		 // Remove element
		 $(document).on("click", '.remove_membership', function(){
		 $(this).closest(".membership").remove();
		  
 		}); 


	});	

	
</script>

        

    @endpush

@stop