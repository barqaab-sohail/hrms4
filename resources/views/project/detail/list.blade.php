@extends('layouts.master.master')
@section('title', 'BARQAAB HR')
@section('Heading')
	<h3 class="text-themecolor">List of Projects</h3>
@stop
@section('content')
<div class="card">
	<div class="card-body">	
		@can('Super Admin')
		<div class="container" id='hideDiv'>
   			<h3 align="center">Import Excel File</h3>

			<form method="post" enctype="multipart/form-data" action="{{route('project.import')}}">
			{{ csrf_field() }}
			    <div class="form-group">
				    <table class="table">
					    <tr>
					    	<td width="40%" align="right"><label>Select File for Upload</label></td>
					       	<td width="30">
					        <input type="file" name="select_file" />
					       	</td>
					       	<td width="30%" align="left">
					        <input type="submit" name="upload" class="btn btn-info" value="Upload">
					       	</td>
					    </tr>
					    <tr>
					       	<td width="40%" align="right"></td>
					       	<td width="30"><span class="text-muted">.xls, .xslx Files Only</span></td>
					       	<td width="30%" align="left"></td>
					    </tr>
				    </table>
			    </div>
			</form>
	
		</div>


		<hr>
		@endcan

		<h4 class="card-title">List of Projects</h4>

		<div class="table-responsive m-t-40">	
			<table id="myTable" class="table table-bordered table-striped"  style="width:100%" >
				<thead>
				<tr>
					<th>Project Name</th>
					<th>Commencement Date</th>
					<th class="text-center"style="width:5%">Edit</th> 
					<th class="text-center"style="width:5%">Delete</th>	
				</tr>
				</thead>
				<tbody>
					@foreach($projects as $project)
						<tr>
							<td>{{$project->name}}</td>
							<td>{{$project->commencement_date}}</td>
														
							<td class="text-center">
								<a class="btn btn-info btn-sm" href="{{route('project.edit',$project->id)}}"  title="Edit"><i class="fas fa-pencil-alt text-white "></i></a>
							</td>
							<td class="text-center">
								 @role('Super Admin')
								 <form  id="formDeleteProject{{$project->id}}" action="{{route('project.destroy',$project->id)}}" method="POST">
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
                            columns: [ 0, 1, 2,3]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3]
                        }
                    }, {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2,3]
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