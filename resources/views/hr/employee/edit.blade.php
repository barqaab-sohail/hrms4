@extends('layouts.master.master')
@section('title', 'BARQAAB HR')
@section('Heading')
	<h3 class="text-themecolor">Human Resource</h3>
	
		<h4>{{'Employee Name: '}} {{ucwords($data->first_name)}} {{ ucwords($data->last_name)}}</h4>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
			<div class="row">
		        <div class="col-lg-2">
					@include('layouts.vButton.hrButton')
				</div>
      	
		        <div class="col-lg-10 addAjax">
		            @include('hr.employee.ajax')
		        </div> <!-- end col-lg-10 -->
		    </div> <!-- end row -->
        </div> <!-- end card card-outline-info -->
    </div> <!-- end col-lg-12 -->
</div> <!-- end row -->



@push('scripts')
<script>


$(document).ready(function() {
	
  //must shifted
	$(document).on('click','#hr_salary_id',function(){
		$('.hideDiv').toggle();
	});

    //must shifted
	$(document).on('click','i[id^=add]',function(){
		$('.hideDiv').toggle();
	});

	 //must shifted
	//store if single input without form submit;
	$(document).on('click','i[id^=store]',function(){
		
		var value = $(this).siblings('input').val();
		var name = $(this).siblings('input').attr('name');
		var url = $(this).attr('href');
		var result = [];

		result.push({name: name, value: value});
		if(($(this).siblings('input').val() != '')&&(value>500)){
			submitFormAjax(result, url);
		}
	});


	formFunctions();


	//form submit
	$(document).on('submit','#formEditEmployee', function(event){	
	 	var url = $(this).attr('action');
		
		$('.fa-spinner').show();
		event.preventDefault();
	   	submitFormAjax(this, url);
	}); //end submit




//edit form load through ajax;
	$(document).on('click','a[id^=edit]',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$.ajax({
           url:url,
           method:"GET",
           //dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
               {
        		$(".addAjax").html(data);
        		
        		formFunctions();
        		
               },
            error: function (jqXHR, textStatus, errorThrown){
            	if (jqXHR.status == 401){
            		location.href = "{{route ('login')}}"
            		}      
                          

                    }//end error
    	}); //end ajax	
	});




// Vertical Button function to load page through ajax 
	$('a[id^=add]').click(function(e){
		var url = $(this).attr('href');
		var id = $(this).attr('id');
		e.preventDefault();
		$.ajax({
           url:url,
           method:"GET",
           //dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
               {
        		$(".addAjax").html(data);
        		$('a[id^=add]').css('background-color','');
        		$('#'+id).css('background-color','#737373');
        		formFunctions();
        		
               },
            error: function (jqXHR, textStatus, errorThrown){
            	if (jqXHR.status == 401){
            		location.href = "{{route ('login')}}"
            		}      
                          

                    }//end error
    	}); //end ajax	

	});


	//ajax function
    function submitFormAjax(form, url){
        //refresh token on each ajax request if this code not added than sendcond time ajax request on same page show earr token mismatched
        $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
            var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
            }
        });
 
        var data = new FormData(form)

       // ajax request
        $.ajax({
           url:url,
           method:"POST",
           data:data,
           //dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
               {              	
               	$('#json_message').attr('class','alert alert-success').removeAttr('hidden').find('strong').text(data.message).siblings('i').removeAttr('hidden');
                $('#json_message').find('i').click(function(){$('#json_message').attr('hidden','hidden');});
                $('html,body').scrollTop(0);
                $('.fa-spinner').hide();
               },
            error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401){
            		location.href = "{{route ('login')}}"
            		}      
                    var test = jqXHR.responseJSON // this object have two more objects one is errors and other is message.
                    
                    var errorMassage = '';

                    //now saperate only errors object values from test object and store in variable errorMassage;
                    $.each(test.errors, function (key, value){
                      errorMassage += value ;
                    });
                     
                    $('#json_message').attr('class','alert alert-danger').removeAttr('hidden').find('strong').text(errorMassage).siblings('i').removeAttr('hidden');
                    $('#json_message').find('i').click(function(){$('#json_message').attr('hidden','hidden');});
                    $('html,body').scrollTop(0);
                    $('.fa-spinner').hide();
                                  
                }//end error
   		}); //end ajax
	}
	 

});
</script>



@endpush

@stop