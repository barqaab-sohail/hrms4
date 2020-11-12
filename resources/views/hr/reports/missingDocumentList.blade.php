@extends('layouts.master.master')
@section('title', 'BARQAAB HR')
@section('Heading')
	<h3 class="text-themecolor">Missing Document List</h3>
@stop
@section('content')
<div class="card">
	<div class="card-body">	
		<h4 class="card-title">Missing Document List</h4>

		<div class="table-responsive m-t-40">	
			<table id="myTable" class="table table-bordered table-striped"  style="width:100%" >
				<thead>
				<tr>
					<th>Id</th>
					<th>Employee Name</th>
					<th>CNIC Front</th>
					<th>Appointment Letter</th>
					<th>HR Form</th>
					<th>Division</th>
					<th>Engineering Degree</th>
					<th>Educational Documents</th>
					<th>Mobile</th>
					
					<th class="text-center"style="width:5%">Edit</th> 
					<th class="text-center"style="width:5%">Delete</th>

					
				</tr>
				</thead>
				<tbody>
					@foreach($employees as $employee)
						<tr>
							<td>{{$employee->id}}</td>
							<td>{{$employee->first_name}} {{$employee->last_name}}</td>
							<td class="text-center">{{$employee->cnicFront->first()->laravel_through_key??'Missing'}}</td>
							<td class="text-center">{{$employee->appointmentLetter->first()->laravel_through_key??'Missing'}}</td>
							<td class="text-center">{{$employee->hrForm->first()->laravel_through_key??'Missing'}}</td>
							<td class="text-center">{!!getDivision(substr($employee->employee_no,0,2))!!}</td>
							<td class="text-center">{{$employee->engineeringDegree->first()->laravel_through_key??'Missing'}}</td>
							<td class="text-center">{{$employee->educationalDocuments->first()->laravel_through_key??'Missing'}}</td>
							<td class="text-center">{{$employee->hrContactMobile->mobile??''}}</td>
							
							
							<td class="text-center">
								<a class="btn btn-info btn-sm" href="{{route('employee.edit',$employee->id)}}"  title="Edit"><i class="fas fa-pencil-alt text-white "></i></a>
							</td>
							<td class="text-center">
								 @role('Super Admin')
								 <form  id="formDeleteContact{{$employee->id}}" action="{{route('employee.destroy',$employee->id)}}" method="POST">
								 @method('DELETE')
								 @csrf
								 <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure to Delete')" href= data-toggle="tooltip" data-original-title="Delete"> <i class="fas fa-trash-alt"></i></button>
								 </form>
								 @endrole
								 </td>
														
						</tr>
					@endforeach
				
				</tbody>
			</table>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {


	
            $('#myTable').DataTable({
                stateSave: false,
        
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4,5,6,7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4,5,6,7]
                        }
                    }, {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4,5,6,7]
                        }
                    },
                ],
                scrollY:        "300px",
      			scrollX:        true,
        		scrollCollapse: true,
        		paging:         false,
        		fixedColumns:   {
            		leftColumns: 1,
            		rightColumns:2
        		}
            });
            
        });
</script>

@stop