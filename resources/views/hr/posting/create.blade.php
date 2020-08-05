
    <div style="margin-top:10px; margin-right: 10px;">
        <button type="button" onclick="window.location.href='{{route('employee.index')}}'" class="btn btn-info float-right" data-toggle="tooltip" title="Back to List">List of Employees</button>
    </div>
         
    <div class="card-body">
        <form id= "formPosting" method="post" class="form-horizontal form-prevent-multiple-submits" action="{{route('posting.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-body">
                    
                <h3 class="box-title">Add Trasnfer/Posting</h3>
                
                <hr class="m-t-0 m-b-40">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Designation<span class="text_requried">*</span></label>
                                 <select  id="hr_designation_id"   name="hr_designation_id" data-validation="required" class="form-control selectTwo">
                                    <option value=""></option>
                                    @foreach($designations as $designation)
                                    <option value="{{$designation->id}}" {{(old("hr_designation_id")==$designation->id? "selected" : "")}}>{{$designation->name}}</option>
                                    @endforeach 
                                </select>
                                
                               
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Project<span class="text_requried">*</span></label>
                                 <select  id="pr_detail_id"   name="pr_detail_id" data-validation="required" class="form-control selectTwo">
                                    <option value=""></option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}" {{(old("pr_detail_id")==$project->id? "selected" : "")}}>{{$project->name}}</option>
                                    @endforeach 
                                </select>
                                
                               
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">Effective Date<span class="text_requried">*</span></label>
                                
                                <input type="text" name="effective_date" value="{{ old('effective_date') }}" class="form-control date_input" data-validation="required" readonly >

                                <br>
                                @can('hr edit record')<i class="fas fa-trash-alt text_requried"></i>@endcan 
                            </div>
                        </div>
                    </div>
                  
                </div><!--/End Row-->

                <div class="row">
                      
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Salary<span class="text_requried">*</span></label>

                                <select  id="hr_salary_id"   name="hr_salary_id" data-validation="required" class="form-control selectTwo">
                                    <option value=""></option>
                                    @foreach($salaries as $salary)
                                    <option value="{{$salary->id}}" {{(old("hr_salary_id")==$salary->id? "selected" : "")}}>{{$salary->total_salary}}</option>
                                    @endforeach
                              
                                </select>

                                @can('hr edit record')
                                <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#salModal"><i class="fas fa-plus"></i>
                                </button>
                                @endcan 
                                                           
                            </div>
                        </div>
                    </div>
                     <!--/span-->
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">HOD<span class="text_requried">*</span></label>
                                 <select  id="hr_manager_id"   name="hr_manager_id" data-validation="required" class="form-control selectTwo" >
                                    <option value=""></option>
                                    @foreach($managers as $manager)
                                    <option value="{{$manager->id}}" {{(old("hr_manager_id")==$manager->id? "selected" : "")}}>{{$manager->first_name}} {{$manager->last_name}}</option>
                                    @endforeach  
                                </select>
                                 
                                
                            </div>
                        </div>
                    </div>
                     <!--/span-->
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">Department<span class="text_requried">*</span></label>
                                 <select  id="hr_department_id"   name="hr_department_id" data-validation="required" class="form-control selectTwo" >
                                    <option value=""></option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{(old("hr_department_id")==$department->id? "selected" : "")}}>{{$department->name}}</option>
                                    @endforeach  
                                </select>
                                    
                                
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Office<span class="text_requried">*</span></label>
                                 <select  id="office_id"   name="office_id" data-validation="required" class="form-control selectTwo" >
                                    <option value=""></option>
                                    @foreach($offices as $office)
                                    <option value="{{$office->id}}" {{(old("office_id")==$office->id? "selected" : "")}}>{{$office->name}}</option>
                                    @endforeach  
                                </select>
                                    
                                
                            </div>
                        </div>
                    </div>



                </div><!--/End Row-->

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Remarks<span class="text_requried">*</span></label>
                                <input type="text"  name="remarks" id="forward_slash" value="{{ old('remarks') }}"  class="form-control" data-validation="required length" data-validation-length="max100" placeholder="Enter Remarks if any">
                                
                               
                            </div>
                        </div>
                    </div>     
                       
                </div><!--/End Row-->
                
               
            </div> <!--/End Form Boday-->

            <hr>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-success btn-prevent-multiple-submits"><i class="fa fa-spinner fa-spin" style="font-size:18px"></i>Save Promotion</button>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
          @include('hr.appointment.salModal')
	</div> <!-- end card body --> 
    <div class="row">
        <div class="col-md-12 table-container">
           
            
        </div>
    </div>      
  

<script>
$(document).ready(function(){
     refreshTable("{{route('posting.table')}}");
    //submit function

        $("#formPosting").submit(function(e) { 
            e.preventDefault();
            var url = $(this).attr('action');
                      
            $('.fa-spinner').show(); 
            submitForm(this, url,1);
            refreshTable("{{route('posting.table')}}",1000);
        });
       

});

</script>



