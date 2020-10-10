
    <div style="margin-top:10px; margin-right: 10px;">
        <button type="button" onclick="window.location.href='{{route('employee.index')}}'" class="btn btn-info float-right" data-toggle="tooltip" title="Back to List">List of Employees</button>
    </div>
         
    <div class="card-body">
        <form id= "education" method="post" class="form-horizontal form-prevent-multiple-submits" action="{{route('education.update',$data->id)}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
            <div class="form-body">
                    
                <h3 class="box-title">Add Education</h3>
                
                <hr class="m-t-0 m-b-40">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">Name of Degree<span class="text_requried">*</span></label><br>
                                <select id="education_id" name="education_id" data-validation="required" class="form-control">
                                   <option></option>
                                    @foreach($degrees as $degree)
                                    <option value="{{$degree->id}}" {{(old("education_id",$data->education_id)==$degree->id? "selected" : "")}}>{{$degree->degree_name}}</option>
                                    @endforeach   
                                </select>
                                <br>
                                @can('hr edit record')
                                <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#eduModal"><i class="fas fa-plus"></i>
                                </button>
                                @endcan 
 
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">Institute</label>
                                <input type="text" name="institute" id="institute" value="{{ old('institute',$data->institute) }}" class="form-control excempted" data-validation="length" data-validation-length="max190" >
                            </div>
                        </div>
                    </div>
                     
                </div><!--/End Row-->
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Major</label>
                                
                                <input type="text" name="major" id="major" value="{{ old('major',$data->major) }}" class="form-control" data-validation="length" data-validation-length="max190" placeholder="Enter major subjects with comma saperated" >
                            </div>
                        </div>
                    </div>
                     
                </div><!--/End Row-->

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">From</label>
                                
                                
								<select  name="from"  id="from" class="form-control selectTwo" >

                                <option value=""></option>
                                @for ($i = (date('Y')-65); $i < (date('Y')+1); $i++)
                                <option value="{{$i}}" {{(old("from",$data->from)==$i? "selected" : "")}}>{{ $i }}</option>
                                @endfor
                                </select>
								
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">To<span class="text_requried">*</span></label>

                                <select  name="to"  id="to" class="form-control selectTwo" data-validation="required" >
                                    <option value=""></option>
                                    @for ($i = (date('Y')-65); $i < (date('Y')+1); $i++)
                                    <option value="{{$i}}" {{(old("to",$data->to)==$i? "selected" : "")}}>{{ $i }}</option>
                                    @endfor
                                </select>
                                
                               
                            </div>
                        </div>
                    </div>
                     <!--/span-->
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                               	<label class="control-label text-right">Total Marks</label>       
                                <input type="number" step="0.01" id="total_marks" name="total_marks" value="{{ old('total_marks',$data->total_marks) }}" data-validation-allowing="range[1.00;6000.00],float" class="form-control"  >
                            </div>
                        </div>
                    </div>
                      <!--/span-->
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Marks Obtain</label>       
                                <input type="number" step="0.01" id="marks_obtain" name="marks_obtain" value="{{ old('marks_obtain',$data->marks_obtain) }}"  data-validation-allowing="range[1.00;6000.00],float" class="form-control"  >
                            </div>
                        </div>
                    </div>
                      <!--/span-->
                    <div class="col-md-1">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Grade</label>       
                                <input type="text" id="grade" name="grade" value="{{ old('grade',$data->grade) }}" class="form-control"  data-validation="length" data-validation-length="max10">
                            </div>
                        </div>
                    </div>
                      <!--/span-->
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label text-right">Country<span class="text_requried">*</span></label>       
                                <select  name="country_id" id="country" data-validation="required" class="form-control selectTwo">
                                    <option value=""></option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{(old("country_id",$data->country_id)==$country->id? "selected" : "")}}>{{$country->name}}</option>
                                @endforeach     
                                </select> 
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
                                <button type="submit" class="btn btn-success btn-prevent-multiple-submits"><i class="fa fa-spinner fa-spin" style="font-size:18px"></i>Edit Education</button>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	</div> <!-- end card body --> 
        <div class="row">
             <div class="col-md-12 table-container">
           
            
            </div>
        </div>   
    @include('cv.detail.eduModal')
  


<script>
$(document).ready(function(){
    refreshTable("{{route('education.table')}}");
    $('#education_id').chosen();

    
    formFunctions();
   
    $('#marks_obtain, #total_marks').on('change',function(){

        if($(this).val() !=''){
        $(this).attr('data-validation','number');
        }else {
             $(this).removeAttr('data-validation');
        }
    });

    //submit function
     $("#education").submit(function(e) { 
        console.log('it is submitted add education');
        e.preventDefault();
        var url = $(this).attr('action');
        $('.fa-spinner').show(); 
        submitForm(this, url);
        refreshTable("{{route('education.table')}}",1000);
    });



    $('.fa-trash-alt').hide();
    // $('#from, #to').datepicker( {
    // changeMonth: true,
    // changeYear: true,
    // showButtonPanel: true,
    // dateFormat: 'MM yy',
    // onClose: function(dateText, inst) { 
    //     $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    //     $(this).siblings('i').show();
    // }
    // });

    // $(".fa-trash-alt").click(function (){
    //     if(confirm("Are you sure to clear date")){
    //     $(this).siblings('input').val("");
    //     $(this).hide();
    //     $(this).siblings('span').text("");
    //     }
    // });
});

</script>



