
<div class="card-body">
  <button type="button" class="btn btn-info"  id ="createNewManager" data-toggle="modal" >Add New HOD</button>
  <br>
  <table class="table table-bordered data-table">
    <thead>
      <tr>
          <th>HOD</th>
          <th>Effective Date</th>
          <th>Edit</th>
          <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach($managers as $manager)
        <tr>
            <td>{{$manager->hrEmployee->first_name}} {{$manager->hrEmployee->last_name}}</td>
            <td>{{$manager->effective_date}}</td>
            <td>
                <a class="btn btn-info btn-sm" id="editManager{{$manager->id}}"href="{{route('manager.edit',$manager->id)}}"  title="Edit">Edit</a>
            </td>
            <td>
                 @role('Super Admin')
                 <form  id="formDeleteManager{{$manager->id}}" action="{{route('manager.destroy',$manager->id)}}" method="POST">
                 @method('DELETE')
                 @csrf
                 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure to Delete')" href= data-toggle="tooltip" data-original-title="Delete">Delete</button>
                 </form>
                 @endrole
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
              <div id="json_message_modal" align="left"><strong></strong><i hidden class="fas fa-times float-right"></i> </div>
                <form id="managerForm" name="manageForm" action="{{route('manager.store')}}"class="form-horizontal">
                   <input type="hidden" name="hr_manager_id" id="hr_manager_id">
                   <input type="hidden" name="hr_employee_id" id="hr_employee_id" value="{{session('hr_employee_id')}}">
                    <div class="form-group">
                        <label class="control-label text-right">HOD<span class="text_requried">*</span></label><br>
                          <select  name="hod_id"  id="hod_id" class="form-control selectTwo" data-validation="required">
                              <option value=""></option>
                              @foreach ($employees as $employee)
                              <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}} - {{$employee->employee_no}}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label text-right">Effective Date<span class="text_requried">*</span></label>
                                
                                <input type="text" name="effective_date" id="effective_date" value="{{ old('effective_date') }}" class="form-control date_input" data-validation="required" readonly >

                                <br>
                                @can('hr edit record')<i class="fas fa-trash-alt text_requried"></i>@endcan 
                    </div>
                    
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  
    $('#createNewManager').click(function(){
        $('#managerForm').trigger("reset");
        $('#hod_id').val('');
        $('#hod_id').trigger('change');
        $('#ajaxModel').modal('show');
        $('#modelHeading').html("Create New HOD");
    });

    //submit form
    $("#managerForm").submit(function(e) { 
            e.preventDefault();
            var url = $(this).attr('action');
            $('.fa-spinner').show(); 

          $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
            var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
            }
          });

          $.ajax({
           url:url,
           method:"POST",
           data:new FormData(this),
           //dataType:'JSON',
           contentType: false,
           cache: false,
           processData: false,
            success:function(data){
              var editUrl='{{route("manager.edit",":id")}}';
                          editUrl= editUrl.replace(':id', data[0]['id']);
              var deleteAction='{{route("manager.destroy",":id")}}';
                          deleteAction= deleteAction.replace(':id', data[0]['id']);

                      $(".data-table tbody").append('<tr><td>'+data[0]['hr_employee']['first_name']+' '+data[0]['hr_employee']['last_name']+
                        '</td><td>'+data[0]['effective_date']+
                        '</td><td>'+'<button class="btn btn-info btn-sm" id="editManager'+data[0]['id']+' href='+editUrl+ ' title="Edit">Edit</button>'
                        +'</td><td><form id=formDeleteManager'+data[0]['id']+' action='+deleteAction+
                        ' method="POST">@csrf<button type="submit" onclick="return confirm(\'Are you Sure to Delete\')" class="btn btn-danger btn-sm" href= data-toggle="tooltip" data-original-title="Delete">Delete</button></form></td></tr>'); 
              console.log(data[0]['hr_employee']['first_name']);
              
              resetForm();
              $('#ajaxModel').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown){
                             
                    
            }//end error
          }); //end ajax

            //submitForm(this, url);
            
    }); //end submit form

    $('a[id^=editManager]').click(function (e){

        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
           url:url,
           method:"GET",
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
               {        
                console.log(data[0]['hr_employee_id']);
              $('#managerForm').trigger("reset");
              $('#modelHeading').html("Edit HOD");
              $('#hr_manager_id').val(data[0]['id']);
              $('#hod_id').val(data[0]['hod_id']);
              $('#hod_id').trigger('change');
              $('#effective_date').val(data[0]['effective_date']);
              $('#ajaxModel').modal('show');

               },
            error: function (jqXHR, textStatus, errorThrown){
                if (jqXHR.status == 401){
                    location.href = "{{route ('login')}}"
                    }      
                          

                }//end error
        }); //end ajax  

      });

   $("form[id^=formDeleteManager]").submit(function(e) { 
    //$(document).on('submit','form[id^=formDeleteManager]',function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    $('.fa-spinner').show(); 
    submitForm(this, url);
    $(this).closest('tr').remove();
     
    });



  // $(function () {
  //     $.ajaxSetup({
  //         headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         }
  //   });
  //   var table = $('.data-table').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       ajax: "{{ route('inputMonth.create') }}",
  //       columns: [
  //           {data: 'hod_id', name: 'hod_id'},
  //           {data: 'effective_date', name: 'effective_date'},
  //           {data: 'action', name: 'action', orderable: false, searchable: false},

  //       ],
  //   });
  //   $('#createNewManager').click(function () {
  //       $('#json_message_modal').html('');
  //       $('#saveBtn').val("create-HOD");
  //       $('#hr_manager_id').val('');
  //       $('#managerForm').trigger("reset");
  //       $('#modelHeading').html("Create New HOD");
  //       $('#ajaxModel').modal('show');
  //   });
  //   $('body').on('click', '.editManager', function () {
  //     var manager_id = $(this).data('id');
  //     $('#json_message_modal').html('');
  //     $.get("{{ url('manager') }}" +'/' + manager_id +'/edit', function (data) {
  //         $('#modelHeading').html("Edit HOD");
  //         $('#saveBtn').val("edit-HOD");
  //         $('#ajaxModel').modal('show');
  //         $('#hr_manager_id').val(data.id);
  //         $('#hod_id').val(data.hod_id);
  //         $('#effective_date').val(data.effective_date);
  //     })
  //  });
  //   $('#saveBtn').click(function (e) {
  //       e.preventDefault();
  //       $(this).html('Save');
    
  //       $.ajax({
  //         data: $('#managerForm').serialize(),
  //         url: "{{ route('manager.store') }}",
  //         type: "POST",
  //         dataType: 'json',
  //         success: function (data) {
     
  //             $('#managerForm').trigger("reset");
  //             $('#ajaxModel').modal('hide');
  //             table.draw();
         
  //         },
  //         error: function (data) {
  //             console.log(data.responseJSON.errors);
  //             var errorMassage = '';
  //             $.each(data.responseJSON.errors, function (key, value){
  //               errorMassage += value + '<br>';  
  //               });
  //                $('#json_message_modal').html('<div id="message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>'+errorMassage+'</strong></div>');

  //             $('#saveBtn').html('Save Changes');
  //         }
  //     });
  //   });
    
  //   $('body').on('click', '.deleteManager', function () {
     
  //       var hr_manager_id = $(this).data("id");
  //       confirm("Are You sure want to delete !");
      
  //       $.ajax({
  //           type: "DELETE",
  //           url: "{{ route('manager.store') }}"+'/'+hr_manager_id,
  //           success: function (data) {
  //               table.draw();
  //           },
  //           error: function (data) {
  //               console.log('Error:', data);
  //           }
  //       });
  //   });
     
  // });
});
</script>
