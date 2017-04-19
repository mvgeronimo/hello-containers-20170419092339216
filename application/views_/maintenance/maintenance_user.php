<script type="text/javascript">

$(document).ready(function() {

	var edit_id = '';
	var active_page = '';
	var first_number = 1;
    var last_number = 0;
	var limit = 0;
    var current_first_users = 1;
    var current_page_users = 1;
    var current_last_users = 5;
    var default_page_show =5;
	var page = 1;

	load_data(default_page_show,page,'load1');
	load_data(default_page_show,page,'load2');

	$(document).on('click','.pagenum',function() {

		page = $(this).val();
		onchange(page,'load1');

		$('.pagenum').removeClass('active1');
		$(this).addClass('active1');
		$('.prev').val(parseInt(page)-1);
		$('.next').val(parseInt(page)+1);

	});

	$(document).on('click','.next',function() {

		page = $(this).val();
		if(page <= parseInt($('.last-page').val())){
			onchange(page,'load1');
			$(this).val(parseInt(page)+1);
			$('.prev').val(parseInt(page)-1);
			if(page > 3){
				onchange(page,'load2');
			}

			$('.pagenum').removeClass('active1');
			$('.num_'+page).addClass('active1');
		}
	});

	$(document).on('click','.prev',function() {

		page = $(this).val();
		if(page >0){
			onchange(page,'load1');
			$(this).val(parseInt(page)-1);
			$('.next').val(parseInt(page)+1);
			if(parseInt($('.f-page').val()) > page){
				onchange(page,'load2');
			}

			$('.pagenum').removeClass('active1');
			$('.num_'+page).addClass('active1');
		}
	});

	$(document).on('click','.prevnext',function() {

		page = $(this).val();
		alert(page);
		onchange(page,'load1');
  		onchange(page,'load2');	

	});

	function onchange(page,loadme){

	  	var default_page_show = '5';
	  	load_data(default_page_show,page,loadme);

	}

	function load_data(default_page_show,page,loadme) {

		var search = $('#search_id').val();
    	var role = $('#role-filter').val();
    	var status = $('#status-filter').val();
    	var keyword = $('#keyword-filter').val();
    	var filter_by = $('#filter_keyword-filter').val();
    	var sorted_by = $('#sorted_by-filter').val();
    	var jobname = $('#jobname-filter').val();
    	var territory = $('#territory-filter').val();
		var sort = $('input[name="sort"]:checked').val();
		var filter = {'role': role, "status": status, "keyword": keyword, "filter_by": filter_by, "sorted_by": sorted_by, "jobname": jobname, "territory": territory, "sort": sort };



		$.ajax({
		  	type: 'post',
		    url: '<?=base_url();?>maintenance/load_data',
		    data: { "t":new Date().getTime(),'limit':default_page_show, 'filter':filter, 'page':page, 'loadme':loadme,'table':'ojl_user_maintenance'}
		  }).done(function(data){

		  	if(loadme=='load1'){
				if (!$.trim(data)){   
					var htm ='';
				    	htm += '<tr>';
						htm += '<td colspan="12" style="pointer-events: none;cursor: default;"class="ctd">No records to show.</td>';
						htm += '</tr>';
							$('.tbody_logs').html('');
			 				$('.tbody_logs').append(htm);
				} else {
		  			$(".tbody_logs").html(data);
		  		}
		  	} else {
		    	$(".pagination_div").html(data);
		    	$('.pagenum').removeClass('active1');
				$('.num_'+page).addClass('active1');	
		    }
		  });
	}  

    function show_page_itemsusers() {

    		$('.page_num_users').hide();
    		l = current_first_users;
    		while(l<=current_last_users){
    			$('.page_item_users'+l).show();
    			l++;
    		}
    }

    $(document).on('click', '.page_num_users', function() {
    	var page_number_users = $(this).val();
    	first_number = page_number_users;
    	$('.page').hide();
        $('.page_'+first_number).show();
        $('.page_num_users').removeClass('active1');
        $('.page_item_users'+page_number_users).addClass('active1');
        current_page_users = page_number_users;
    })

   $(document).on('click', '.btnResetUser', function() {

   		$("select").each(function() { this.selectedIndex = 0 });
   		$("input.sorting").each(function() { $(this).prop('checked', false); });
   		$("input").each(function() { $(this).val(""); });
   		$('.second-filter').val("");
   		$('.sorted_by_check').css('border','0px solid #ccc');
		$('#sorted_by-filter').css('border','1px solid #ccc');
		$('.error-sort').hide();
		$('.error-sort-by').hide();
   		load_data(5,1,'load1');
		load_data(5,1,'load2');

    })

   $(document).on('click', '.btnCreateUser', function() {

   		$("select").each(function() { this.selectedIndex = 0 });
   		$("input.sorting").each(function() { $(this).prop('checked', false); });
   		$("input").each(function() { $(this).val(""); });
   		$('.second-filter').val("");
   		$('#user_add').show();
   		$('#user_list').hide();
   		$('.page_title').html("");
   		$('.page_title').html("Create User");

    })

   $(document).on('click', '.btnCancelUser', function() {
   		
		bootbox.confirm("<b>Are you sure you want to leave this page?</b>", function(e) {
		  if(e) {
		    // window.location = '<?=base_url();?>home'
		    $('#modal-user-maintenance').modal('hide');
	   		$('#user_add').hide();
	   		$('#user_list').show();
	   		$('.page_title').html("");
	   		$('.page_title').html("User");
			$('.inputs').each(function(){
			              $(this).next().hide();
			              $(this).css('border','1px solid #ccc');	
			});

		 }
		})
    })

    $(document).on('click', '.successdata', function() {
   		
		  
		    //window.location = '<?=base_url();?>maintenance/user';
		    $('#modal-user-maintenance').modal('hide');
	   		$('#user_add').hide();
	   		$('#user_list').show();
	   		$('.page_title').html("");
	   		$('.page_title').html("User");
			$('.inputs').each(function(){
			              $(this).next().hide();
			              $(this).css('border','1px solid #ccc');	
			});
 
    })

    $(document).on('click', '.btnSaveUser', function() {

    	var role = $('#role').val();
    	var empID = $('#empID').val();
    	var unilabemail = $('#unilabemail').val();
    	var firstname = $('#firstname').val();
    	var middlename = $('#middlename').val();
    	var lastname = $('#lastname').val();
    	var jobname = $('#jobname').val();
    	var lpd = $('#lpd').val(); 
    	var territory = $('#territory').val();
    	var username = $('#username').val();
    	var counter = 0; 
		$('.inputs').each(function(){
			var input = $(this).val();
			if (input.length == 0) {
					  $(this).css('border','1px solid red');
		              $(this).next().show();
		              counter++;
		    }else{
		              $(this).next().hide();
		              $(this).css('border','1px solid #ccc');
			}
		});

		if(counter == 0){
			if(validateEmail(unilabemail)) {
			      $.ajax({
			        type:'post',
			        url:'<?=base_url();?>Maintenance/insert_user',
			        data:{'username':username,'lpd':lpd,'territory':territory,'role':role,'empID':empID,'unilabemail':unilabemail,'firstname':firstname,'middlename':middlename,'lastname':lastname,'jobname':jobname}
			      }).done(function(result) {

						if(result == 1 ){
							bootbox.alert('<b style="color:#000000">Successsfully Added!</b>');
							load_data(5,1,'load1');
							load_data(5,1,'load2');
							$('.successdata').click();
						} else {
							bootbox.alert('<b style="color:red">'+result+'</b>');
						}	      	
			      })

			} else {
					bootbox.alert('<b style="color:red">Please enter a valid Email.</b>');
					$('#unilabemail').css('border','1px solid red');
			}

		} else {
			bootbox.alert('<b style="color:red">Please fill out all the required fields!</b>');
		}
    })

    $( "#lpd" ).datepicker();

    $(document).on('click', '.user-edit-icon', function() {

	      var user_id = $(this).attr('data-id');
	      $.ajax({
	        type:'post',
	        url:'<?=base_url();?>Maintenance/get_user',
	        data:{'user_id':user_id}
	      }).done(function(result) {

	      	  var htm = "";
	          var obj = JSON.parse(result);
	          var check = "";
	          $.each(obj, function(x,y) {

	           if(y.is_active > 0){
				check = "checked";
			   }

	          		htm 	+=	'<div class="col-md-12 modal-user-details pad-0">';
	          		htm 	+=	'<div class="col-md-12 modal-user pad-0">';			
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Username:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="hidden" class="form-control" id="userid-modal" value="'+y.user_id+'"  required>';
					htm 	+=	'    	<input type="text" class="form-control edit_inputs" id="username-modal" value="'+y.username+'"  required><span class = "er-msg-modal">User Name should not be empty *</span>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Employee ID:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control" id="empid-modal" value="'+y.empid+'"  required>';
					htm 	+=	'    	<input type="hidden" class="form-control" id="empid-modal-hidden" value="'+y.empid+'"  required>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">First Name:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control edit_inputs" id="firstname-modal" value="'+y.firstname+'"  required><span class = "er-msg-modal">First Name should not be empty *</span>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Middle Name:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control" id="middlename-modal" value="'+y.middlename+'"  required>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Last Name:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control edit_inputs" id="lastname-modal" value="'+y.lastname+'"  required><span class = "er-msg-modal">Last Name should not be empty *</span>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Email Address:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control edit_inputs" id="email-modal" value="'+y.email+'"  required><span class = "er-msg-modal">Email should not be empty *</span>&nbsp;<span id="email_err" class="error"></span>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Job Name:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					//htm 	+=	'    	<input type="text" class="form-control" id="jobname-modal" value="'+y.jobname+'"  required>';
					htm 	+=	'				<select name="job_name[]" class="job_name form-control" id="jobname-modal"> ';
					htm 	+=	'				<?php foreach($dropdown as $key => $value) { if ($value->is_active == 1) { ?>';
					htm 	+=	'					<option value="<?php echo $value->job_id; ?>"><?php echo $value->job_name; ?></option>';
					htm 	+=	'				<?php } } ?>';
					htm 	+=	'				</select>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Last Promotion Date:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    	<input type="text" class="form-control" id="lpd-modal" value="'+y.last_promotion_date+'"  required>';
					htm 	+=	'    </div></div>';					
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Territory:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					//htm 	+=	'    	<input type="text" class="form-control" id="territory-modal" value="'+y.territory+'"  required>';
					htm 	+=	'				<select name="territory[]" class="territory_name form-control" id="territory-modal">';
					htm 	+=	'				<?php foreach($territory as $key => $value) { if ($value->is_active == 1) { ?>';
					htm 	+=	'					<option value="<?php echo $value->territory_id; ?>"><?php echo $value->territory_name; ?></option>';
					htm 	+=	'				<?php } } ?>';
					htm 	+=	'				</select>';
					htm 	+=	'    </div></div>';					
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Role:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					// htm 	+=	'    	<input type="text" class="form-control" id="role-modal" value="'+y.role+'"  required>';
					htm 	+=	'				<select name="role_name[]" class="role_name form-control edit_inputs" id="role-modal">';
					htm 	+=	'				<?php foreach($role as $key => $value) { if ($value->is_active == 1) { ?>';
					htm 	+=	'						<option value="<?php echo $value->role_id; ?>"><?php echo $value->role_name; ?></option>';
					htm 	+=	'				<?php } } ?>';
					htm 	+=	'				</select><span class = "er-msg-modal">Role should not be empty *</span>';
					htm 	+=	'    </div></div>';
					htm 	+=	'<div class="col-md-12 modal-user pad-0">';	
					htm 	+=	'  	<div class="col-md-4 pad-0">';
					htm 	+=	'    	<label for="username" class="control-label">Is Active:</label>';
					htm 	+=	'    </div>';
					htm 	+=	'    <div class="col-md-8">';
					htm 	+=	'    <input type="checkbox" id="isactive-modal" value="'+y.is_active+'"  '+check+'>';
					htm 	+=	'    </div></div>';															
					htm 	+=	'<div class="col-md-12 btn-usersave-modal" style="">';		
					htm 	+=	'  <button class="btnUpdateUser abt btn-info btn btn-user-update">Save</button>';		
					htm 	+=	'  <button  class="btnCancelUser abt btn-info btn btn-user-update">Cancel</button>';//data-dismiss="modal"		
					htm 	+=	'</div>';		
	          		htm 	+=	'</div>';

			        $('#user-maintenance-content').html('');
			        $('#user-maintenance-content').html(htm);

			        			jQuery('#modal-user-maintenance').modal({
								    backdrop: 'static',
								    keyboard: false
								});

								$( "#lpd-modal" ).datepicker();
								$('#jobname-modal option[value='+y.jobname+']').attr('selected','selected');
								$('#territory-modal option[value='+y.territory+']').attr('selected','selected');
								$('#role-modal option[value='+y.role+']').attr('selected','selected');
			          })
	      })
    })

    $(document).on('click', '.btnUpdateUser', function() {

    	var role = $('#role-modal').val();
    	var empID = $('#empid-modal').val();
    	var empIDold = $('#empid-modal-hidden').val();
    	var unilabemail = $('#email-modal').val();
    	var firstname = $('#firstname-modal').val();
    	var middlename = $('#middlename-modal').val();
    	var lastname = $('#lastname-modal').val();
    	var jobname = $('#jobname-modal').val();
    	var lpd = $('#lpd-modal').val(); 
    	var territory = $('#territory-modal').val();
    	var username = $('#username-modal').val();
    	var id = $('#userid-modal').val();

		if($("#isactive-modal").is(':checked')){
		     var isactive = 1;
		} else {
		     var isactive = 0;
		}
		var counter = 0;

		$('.edit_inputs').each(function(){
			var input = $(this).val();
			if (input.length == 0) {
					  $(this).css('border','1px solid red');
		              $(this).next().show();
		              counter++;
		    }else{
		              $(this).next().hide();
		              $(this).css('border','1px solid #ccc');
			}
		});
		
		if(counter == 0){
		if(validateEmail(unilabemail)) {
		      $.ajax({
		        type:'post',
		        url:'<?=base_url();?>Maintenance/update_user',
		        data:{'isactive':isactive,'id':id,'username':username,'lpd':lpd,'territory':territory,'role':role,'empID':empID,'unilabemail':unilabemail,'firstname':firstname,'middlename':middlename,'lastname':lastname,'jobname':jobname,'empIDold':empIDold}
		      }).done(function(result) {
					if(result == 1){
						bootbox.alert('<b style="color:#000000">Successsfully Updated!</b>');
						page = parseInt($('.active1').val());
						load_data(5,page,'load1');
						load_data(5,page,'load2');
						$('.successdata').click();     	
					} else if(result == 0){
						bootbox.alert('<b style="color:red">Something went wrong, please change one of the following field or click cancel.</b>');
					} else{
						bootbox.alert('<b style="color:red">'+result+'</b>');
					}
		      })
			} else {
					bootbox.alert('<b style="color:red">Please enter a valid Email.</b>');
					$('#email-modal').css('border','1px solid red');
			}
		} else {
			bootbox.alert('<b style="color:red">Please fill out all the required fields!</b>');
		}
    })

    $(document).on('click', '.btnFilterUser', function() {	
    
        var sorted_by = $('#sorted_by-filter').val();
		var sort = $('input[name="sort"]:checked').val();
		
		if(sorted_by != '' && sort == undefined){
			    $('.sorted_by_check').css('border','1px solid red');
			    $('.error-sort').show();
			    $('.error-sort-by').hide();
			    $('#sorted_by-filter').css('border','1px solid #ccc');
		} else if(sort != undefined && sorted_by == ''){
				$('#sorted_by-filter').css('border','1px solid red');
				$('.error-sort-by').show();
				$('.error-sort').hide();
				$('.sorted_by_check').css('border','0px solid #ccc');
		} else {
				$('.sorted_by_check').css('border','0px solid #ccc');
				$('#sorted_by-filter').css('border','1px solid #ccc');
				$('.error-sort').hide();
				$('.error-sort-by').hide();
				load_data(5,1,'load1');
				load_data(5,1,'load2');
		} 


    })

/* Validation */

	$('#unilabemail, #email-modal').keyup(function() {
	    $('span.email_err').remove();
	    var inputVal = $(this).val();
	    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	    if(!emailReg.test(inputVal)) {
	    	$('.required_email').hide();
	    	$('#unilabemail').css('border','1px solid red');
	        $(this).after('<span class="error email_err">Invalid Email Format.</span>');
	    } else {
	    	$('#unilabemail').css('border','1px solid #ccc');	
	    }
	}); 

	$('#username, #firstname, #lastname, #role, #firstname-modal, #lastname-modal, #role-modal, #username-modal').keyup(function() {
		if($(this).val() != ''){
			$(this).css('border','1px solid #ccc');	
			$(this).next().hide();
		} else {
			$(this).css('border','1px solid red');
			$(this).next().show();
		}
	}); 

	$('#role, #role-modal, #sorted_by-filter').change(function() {
		if($(this).val() != ''){
			$(this).css('border','1px solid #ccc');	
			$(this).next().hide();
		} else {
			$(this).css('border','1px solid red');
			$(this).next().show();
		}
	}); 

	function validateEmail(email) {
	    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	    if (filter.test(email)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}

	$("#empID").on("keyup keydown keypress change paste", function(e){	    
	    if (e.type == "paste") $(this).change();	      
	    var newValue = $(this).val();    	    
	    if (isNaN(newValue) === true) {	   
	        $(this).val(lastValue);	 
	        $("#int_err").html("Numbers Only").show();
	        $('#empID').css('border','1px solid red');
	    } else {	    
	         lastValue = newValue;	
	    	$("#int_err").html("Numbers Only").hide("slow"); 
	    	$('#empID').css('border','1px solid #ccc');	 
	    };

	});
/* End of validation */

})

</script>





<div class="col-sm-12 col-md-12 col-lg-12  user_list pad-0" id="user_list">
	<div class="col-sm-12 col-md-12 col-lg-12 top pad-0"> 
		<div class="col-md-12 user-search-div pad-0">

			<div class="col-md-7 filer-by-div pad-0">
				<div class"col-md-12 filter-title pad-0" id="filter-title"> Filtered By </div>
				<div class="col-md-12 pad-0">

								<div class="col-md-4 pad-0 filtered-by">
									<select name="job_name[]" class="job_name form-control second-filter" id="jobname-filter">
										<option value="">All Job Names</option>
										<?php foreach($dropdown as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->job_id; ?>"><?php echo $value->job_name; ?></option>
										<?php } } ?>
									</select>
								</div>

								<div class="col-md-4 pad-0 filtered-by">
									<select name="job_status[]" class="job_status form-control second-filter" id="status-filter">
										<option value="">All Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>

								<div class="col-md-4 pad-0 filtered-by">
									<input type="text" placeholder="Keyword" class="form-control keyword second-filter" id="keyword-filter"></input>
								</div>		

								<div class="col-md-4 pad-0 filtered-by">
									<select name="territory[]" class="territory_name form-control second-filter" id="territory-filter">
											<option value="">All Territories</option>
										<?php foreach($territory as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->territory_id; ?>"><?php echo $value->territory_name; ?></option>
										<?php } } ?>
									</select>
								</div>

								<div class="col-md-4 pad-0 filtered-by">
									<select name="role_name[]" class="role_name form-control second-filter" id="role-filter">>
										<option value="">All Roles</option>
										<?php foreach($role as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->role_id; ?>"><?php echo $value->role_name; ?></option>
										<?php } } ?>
									</select>
								</div>

								<div class="col-md-4 pad-0 filtered-by">
									<select name="filter_keyword[]" class="filter_keyword form-control second-filter" id="filter_keyword-filter">
										<option value="">Filter by Keyword</option>
										<option value="username">Username</option>
										<option value="empid">Employee ID</option>
										<option value="firstname">First Name</option>
										<option value="middlename">Middle Name</option>
										<option value="lastname">Last Name</option>
										<option value="email">Email Address</option>
										<option value="jobname">Job Name</option>
										<option value="last_promotion_date">Last Promotion Date</option>
										<option value="territory">Territory</option>
										<option value="role">Role</option>
									</select>
								</div>
				</div>
			</div>

			<div class="col-md-1"></div>
			<div class="col-md-4 sorted-by-div pad-0">
				<div class"col-md-12 filter-title pad-0" id="filter-title"> Sorted By </div>
								<div class="col-md-5 pad-0 filtered-by">
									<select name="sorted_by[]" class="filter_keyword form-control second-filter"  id="sorted_by-filter">
										<option value=""></option>
										<option value="username">Username</option>
										<option value="empid">Employee ID</option>
										<option value="firstname">First Name</option>
										<option value="middlename">Middle Name</option>
										<option value="lastname">Last Name</option>
										<option value="email">Email Address</option>
										<option value="jobname">Job Name</option>
										<option value="last_promotion_date">Last Promotion Date</option>
										<option value="territory">Territory</option>
										<option value="role">Role</option>
									</select>
									<span class = "er-msg error-sort-by">Sorted by should not be empty *</span>
								</div>	
								<div class="col-md-12 pad-0 sorted_by_check">
								    <div class="radio">
								      <label>
								        <input type="radio" class="sorting" name="sort" value="ASC" required>
								        Ascending
								      </label>
								    </div>
								    <div class="radio">
								      <label>
								        <input type="radio" class="sorting" name="sort" value="DESC" required>
								        Descending
								      </label>
								    </div>
								    <span class = "er-msg error-sort">Please check one of the following *</span>
								</div>		
			</div>
		</div>

		  <div class="col-md-12 btn-user-action" style="">
			  <button class="btnFilterUser abt btn-info btn btn-user ">Filter</button>
			  <button class="btnResetUser abt btn-info btn btn-user">Reset</button>
			  <button class="btnCreateUser abt btn-info btn btn-user">Create User</button>
		  </div>

		<div class="col-md-12 front-page pad-0">
			<div class="col-md-10 chead m-dataItem" style="padding:0px"><label class="content_header"></label></div>
			<div class="user-table-responsive">
			<table class="table border-top-blue center-txt" >
				<thead class="table-green">
			        <th class="ctd">Username</th>
			        <th class="ctd">Employee ID</th>
			        <th class="ctd">First Name</th>
			        <th class="ctd">Midlle Name</th>
			        <th class="ctd">Last Name</th>
			        <th class="ctd">Email Address</th>
			        <th class="ctd">Job Name</th>
			        <th class="ctd">Last Promotion Date</th>
			        <th class="ctd">Territory</th>
			        <th class="ctd">Role</th>
			        <th class="ctd">Is Active</th>
			        <th class="ctd">Action</th>
				</thead>
				<tbody class="tbody_logs"></tbody>
			</table>
			</div>

			<div class="col-md-12 pagination_div no-padding"></div>
		</div>
  	</div>
</div>

<div class="col-sm-12 col-md-12 col-lg-12  user_add pad-0" id="user_add" style="display:none;">
	<div class="col-sm-12 col-md-12 col-lg-12 top pad-0 user_add_border"> 
		<div class="col-sm-12 create_user">
			<div class="col-md-12 create-user-title pad-0">USER INFORMATION</div>
			<div id="submit-user" class="col-md-12 user-info-div pad-0">
				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="username" class="control-label">User Name:<span class="required">*</span></label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control inputs" id="username"  required>
				    	<span class = "er-msg-modal">Username should not be empty *</span>
				    </div>
				  </div>
				</div>
				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="empID" class="control-label">Employee ID:</label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control" id="empID"  required>
				    	<span id="int_err" class="error"></span>
				    </div>
				  </div>
				</div>
				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="unilabemail" class="control-label">Unilab Email:<span class="required">*</span></label>
				    </div>
				    <div class="col-md-8">
				    	<input type="email" class="form-control inputs" id="unilabemail"  data-error="Email address is invalid" required>
				    	<span class = "er-msg required_email">Email should not be empty *</span>
				    	&nbsp;<span id="email_err" class="error"></span>
				    </div>
				  </div>
			  	</div>
				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="firstname" class="control-label">First Name:<span class="required">*</span></label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control inputs" id="firstname"  required>
				    	<span class = "er-msg">First Name should not be empty *</span>
				    </div>
				  </div>
				</div>

				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="middlename" class="control-label">Middle Name:</label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control" id="middlename"  required>
				    </div>
				  </div>
				</div>

				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="lastname" class="control-label">Last Name:<span class="required">*</span></label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control inputs" id="lastname"  required>
				    	<span class = "er-msg">Last Name should not be empty *</span>
				    </div>
				  </div>
			  	</div>

				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="jobname" class="control-label">Job Name:</label>
				    </div>
				    <div class="col-md-8">
				    				<select name="job_name[]" class="jobname form-control" id="jobname">
										<option value="">Choose One</option>
										<?php foreach($dropdown as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->job_id; ?>"><?php echo $value->job_name; ?></option>
										<?php } } ?>
									</select>
				    </div>
				  </div>
				</div>

				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="lpd" class="control-label">Last Promotion Date</label>
				    </div>
				    <div class="col-md-8">
				    	<input type="text" class="form-control" id="lpd"  required>
				    </div>
				  </div>
				</div>				

				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="territory" class="control-label">Territory:</label>
				    </div>
				    <div class="col-md-8">
				    				<select name="territory[]" class="territory_name form-control" id="territory">
										<option value="">Choose One</option>
										<?php foreach($territory as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->territory_id; ?>"><?php echo $value->territory_name; ?></option>
										<?php } } ?>
									</select>
				    </div>
				  </div>
				</div>
				</div> <!-- user-info-div -->

				<div class="col-md-12 user-info-div pad-0">
				<div class="col-md-4 pad-0 user-data">
				  <div class="form-group">
				  	<div class="col-md-4 pad-0">
				    	<label for="role" class="control-label">Role:</label>
				    </div>
				    <div class="col-md-8">
				    				<select name="role_name[]" class="inputs role_name form-control" id="role">
										<option value="">Choose One</option>
										<?php foreach($role as $key => $value) { 
											if ($value->is_active == 1) { ?>
												<option value="<?php echo $value->role_id; ?>"><?php echo $value->role_name; ?></option>
										<?php } } ?>
									</select>
									<span class = "er-msg">Role should not be empty *</span>
				    </div>
				  </div>
				</div>
				</div>
		</div>
	</div>

			  <div class="col-md-12 btn-usersave-action" style="">
				  <button class="btnSaveUser abt btn-info btn btn-user-save">Save</button>
				  <button class="btnCancelUser abt btn-info btn btn-user-save">Cancel</button>
			  </div>
</div>


<!-- Modal -->

<div class="modal fade" id="modal-user-maintenance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-edit" style = "border-radius:0px">
      <div class="modal-header txt-right" style = "padding: 25px 10px; background:transparent">
      	<div class="col-md-12 pad-0">
      		<div class="col-md-6 pad-0">
      	<h4 class="modal-title" id="myModalLabel">UPDATE USER</h4> </div><div class="col-md-6" style="    text-align: right;">
        <a style="display:none;" class = "close-video" data-dismiss="modal" aria-label="Close">[<span aria-hidden="true">&times;</span>]Close</a></div>
        </div>
      </div>
      <div  class="modal-body" style = "padding:0px; background:#fff">
      	<div class="col-md-12" id="user-maintenance-content" style = "padding:10px;">
      	</div>
      </div>
    </div>
  </div>
</div>
<div class="successdata"></div>


<!-- End of modal -->