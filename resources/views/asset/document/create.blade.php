<div style="margin-top:10px; margin-right: 10px;">
    <button type="button"  id ="hideButton"  class="btn btn-info float-right">Add Document</button>
</div>


<div class="card-body">

    <form method="post" class="form-horizontal form-prevent-multiple-submits" id="formDocument" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-body">
            
            <h3 class="box-title" id="formHeading">Document</h3>
            <hr class="m-t-0 m-b-40">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label text-right">Document Description</label>
                            <input type="hidden" name="as_document_id" id="as_document_id">
                            <input type="text" id="description" name="description" value="{{ old('description') }}" class="form-control" data-validation="required" placeholder="Enter Document Detail" >
                        </div>
                    </div>
                </div>
            </div>
                
            <!--/row-->
             <div class="row">
                <div class="col-md-8 pdfView">
                    <embed id="pdf" src=""  type="application/pdf" height="300" width="100%" />
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
                     

                    
                    <div class="form-group row">
                        <center >
                        <img src="{{asset('Massets/images/document.png')}}" class="img-round picture-container picture-src"  id="wizardPicturePreview"  title="" width="150" >
                        
                        </input>
                        <input type="file"  name="document" id="view" data-validation="required" class="" required hidden>
                                                                        

                        <h6 id="h6" class="card-title m-t-10">Click On Image to Add Document<span class="text_requried">*</span></h6>
                
                        </center>
                       
                    </div>
                   


                </div>
                                                        
            </div>
            
                                               
        </div>
         <hr>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                       
                            <button type="submit" class="btn btn-success btn-prevent-multiple-submits"><i class="fa fa-spinner fa-spin" id="saveBtn" style="font-size:18px"></i>Save</button>
                                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <div class="col-md-12 table-container">
                 
    </div>
   
</div>
        
<script>
    $(document).ready(function(){

        formFunctions();

        $('#formDocument').hide();

        

//start function
$(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('asDocument.create') }}",
        columns: [
            {data: "description", name: 'description'},
            {data: 'document', name: 'document'},
            {data: 'Edit', name: 'Edit', orderable: false, searchable: false},
            {data: 'Delete', name: 'Delete', orderable: false, searchable: false},

        ],
        order: [[ 1, "desc" ]]
    });

    $('#hideButton').click(function(){
            $('#formDocument').toggle();
             $('#formDocument').trigger("reset");
    });

    $('body').unbind().on('click', '.editManager', function () {
      var as_document_id = $(this).data('id');

      $('#json_message_modal').html('');
      $.get("{{ url('hrms/asset/asDocument') }}" +'/' + as_document_id +'/edit', function (data) {
          $('#formHeading').html("Edit Document");
          $('#saveBtn').val("edit-Document");
          $('#as_document_id').val(data.as_document_id);
          //$('#hr_manager_id').trigger('change');
          //$('#effective_date').val(data.effective_date);
          console.log(data);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
         
        $.ajax({
          data: $('#formDocument').serialize(),
          url: "{{ route('asDocument.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#managerForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
        
          },
          error: function (data) {
              console.log(data.responseJSON.errors);
              var errorMassage = '';
              $.each(data.responseJSON.errors, function (key, value){
                errorMassage += value + '<br>';  
                });
                 $('#json_message_modal').html('<div id="message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+errorMassage+'</strong></div>');

              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteManager', function () {
     
        var employee_manager_id = $(this).data("id");
        var con = confirm("Are You sure want to delete !");
        if(con){
          $.ajax({
            type: "DELETE",
            url: "{{ route('manager.store') }}"+'/'+employee_manager_id,
            success: function (data) {
                table.draw();
                if(data.error){
                  $('#json_message').html('<div id="json_message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+data.error+'</strong></div>');    
                }
  
            },
            error: function (data) {
                console.log('Error:', data);
            }
          });
        }
    });
     
  });// end function









      
        //submit function
        $("#formDocument").submit(function(e) { 
            e.preventDefault();
            //var url = "{{route('cvDocument.store')}}";
            $('.fa-spinner').show(); 
            submitForm(this, url,1);
            $('#wizardPicturePreview').attr('src',"{{asset('Massets/images/document.png')}}").attr('width','150');
             $('#pdf').attr('src','');
            $('#h6').text('Click On Image to Add Document');
            refreshTable("{{route('cvDocument.table')}}",900);
        });

        $( "#pdf" ).hide();
            // Prepare the preview for profile picture
        $("#view").change(function(){
                var fileName = this.files[0].name;
                var fileType = this.files[0].type;
                var fileSize = this.files[0].size;
                //var fileType = fileName.split('.').pop();
                console.log(fileType);
            //Restrict File Size Less Than 2MB
            if (fileSize> 4096000){
                alert('File Size is bigger than 4MB');
                $(this).val('');
            }else{
                //Restrict File Type
                if ((fileType =='image/jpeg') || (fileType=='image/png')){
                    $( "#pdf" ).hide();
                    readURL(this);
                    document.getElementById("h6").innerHTML = "Image is Attached";
                }else if(fileType=='application/pdf')
                {
                readURL(this);// for Default Image
                
                document.getElementById("pdf").src="{{asset('Massets/images/document.png')}}";  
                $( "#pdf" ).show();
                }else if ((fileType=='application/vnd.openxmlformats-officedocument.wordprocessingml.document')||(fileType=='application/msword')){
                    readURL(this);
                    document.getElementById("h6").innerHTML = "Document File is Attached";
                    $('embed').remove();
                    
                }else{
                    alert('Only PDF, JPG and PNG Files Allowed');
                $(this).val('');
                }
            }
            
        });
    });//end document ready
        function readURL(input) {
            var fileName = input.files[0].name;
            var fileType = input.files[0].type;
            //var fileType = fileName.split('.').pop();
                                
            if ((fileType =='image/jpeg')||(fileType =='image/png')){
            //Read URL if image
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                        reader.onload = function (e) {
                            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow').attr('width','100%');
                        }
                        reader.readAsDataURL(input.files[0]);
                }
                    
            }else{
               
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                        reader.onload = function (e) {
                            $('embed').attr('src', e.target.result.concat('#toolbar=0&navpanes=0&scrollbar=0'));
                        }
                        reader.readAsDataURL(input.files[0]);
                }   
                document.getElementById("wizardPicturePreview").src="{{asset('Massets/images/document.png')}}"; 
                document.getElementById("h6").innerHTML = "PDF File is Attached";
                 $('#wizardPicturePreview').attr('width','150');
            }           
        }
            
        $("#wizardPicturePreview" ).click (function() {
           $("input[id='view']").click();
        });
      
            
            
</script>