@extends('accreditation::layouts.master')

@section('content')
<style type="text/css">
	.req{
		color: red;
	}
</style>
	<h4 class="mb-4">Add an Accreditation</h4>



<form  id="addAccredForm" method="POST">
    @csrf
	<div class="form-group row">
		<label class="col-md-2 col-form-label"> <span class="req">*</span>School</label>
		<div class="col-md-4">
      		<select class="form-control form-control-sm" id="school" name="school" required>
		    	<option disabled selected value> </option>
			    @foreach ($schools as $school)
			      <option value="{{$school->id}}">{{ $school->school_name }}</option>
			    @endforeach
		    </select>
    	</div>

    	<label class="col-md-2 col-form-label"> <span class="req">*</span>Academic Programs</label>
		<div class="col-md-4">
      		<div id='program_choice'>
			 	<select class="form-control form-control-sm " disabled name="program" required> 
			 		<option>--Select school first--</option>
			 	</select>
			 </div>
    	</div>
	    
	</div>

	<div class="form-group row">

		    <label class="col-md-2 col-form-label"><span class="req">*</span>Accreditation Status</label>
		    <div class="col-md-4">
			    <select class="form-control form-control-sm" name="accredStat" required>
			    	<option disabled selected value> </option>
			    @foreach ($accredStats as $accredStat)
			      <option value="{{$accredStat->id}}">{{ $accredStat->accred_status }}</option>
			    @endforeach
			    </select>
			</div>
		
	</div>

  <div class="form-group row">
    <label class="col-md-2 col-form-label"><span class="req">*</span>Visit Date From</label>
    <div class="col-md-4">
      <input class="form-control form-control-sm" type="month" name="visit_date" required>
    </div>

    <label class="col-md-2 col-form-label">Visit Date To</label>
    <div class="col-md-4">
      <input class="form-control form-control-sm" type="month" name="visit_date_to">
    </div>
  </div>

   <div class="form-group row mb-4">
    <label class="col-md-2 col-form-label"><span class="req">*</span>Valid From</label>
    <div class="col-md-4">
      <input class="form-control form-control-sm" type="date" name="from" required>
    </div>

    <label class="col-md-2 col-form-label"><span class="req">*</span>Valid To</label>
    <div class="col-md-4">
      <input class="form-control form-control-sm" type="date" name="to" required>
    </div>
  </div>

  <div class="form-row my-2 mb-4">
			<div class="form-group col-md-6">
			    <label>Remarks</label>
			    <textarea class="form-control form-control-sm" id="remarks" rows="4" name="remarks"></textarea>
			</div>
			
		</div>

	<hr>
   <div class="form-group row mt-4">
   		<label class="col-md-2 col-form-label">FAAP Certificate</label>
	    <div class="col-md-4">
	      <input type="file" name="" class="form-control">
	    </div>
   </div>
   <div class="form-group row">
   		<label class="col-md-2 col-form-label">PACOCUA Certificate</label>
	    <div class="col-md-4">
	      <input type="file" name="" class="form-control">
	    </div>
   </div><div class="form-group row">
   		<label class="col-md-2 col-form-label">PACOCUA Report</label>
	    <div class="col-md-4">
	      <input type="file" name="" class="form-control">
	    </div>
   </div>
 
  <div class="form-group row mt-4">
    <div class="col-md-10">
      <button class="btn bg-ub-red m-2" type="submit">Add Accreditation</button>
		<a class="btn btn-secondary  m-2" href='{{ route("accredIndex") }}'>Back</a>
    </div>
  </div>
</form>

<!-- Modal -->
<div class="modal fade " data-backdrop="static" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
      </div>
      <div class="modal-body">
        Record saved. Add another record?
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" href="{{route('accredIndex')}}">Proceed to Dashboard</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Add Another Record</button>
      </div>
    </div>
  </div>
</div>
	
	

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
    	});
    
    	var token = $("input[name='_token']").val();
		$(document).ready(function(){

		   $('#school').on('change',function(){
		   		var id = $(this).val();

		   		$.ajax({
		            url:"{{route('school_select')}}",
		            method:"POST",
		            data:{
		              id:id,
		              _token:token
		            },
		            success:function(data){
		       
		              $('#program_choice').html(data);
		             
		            }   
		         }); 
			});



		     //Adding
		    $( "#addAccredForm" ).submit(function( event ) {
		        event.preventDefault();

		        $.ajax({
		          url:"{{route('addAccred')}}",
		          method:"POST",
		          data: $("#addAccredForm").serialize(),
		          success:function(data){
		            $("#addAccredForm")[0].reset();
		            $('#success-modal').modal('show');
		            
		          }
		              
		        }); 
		    });  
		});
	</script>
@endsection