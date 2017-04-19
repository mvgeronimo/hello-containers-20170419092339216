	<style type="text/css">

	.title-bar {

		background-color: #4f81bd;

		border: 3px solid #385d8a;

		color: white;

		height: 40px;

		font-size: 18px;

		padding-top: 5px;

	}

	.btn_cancel, .btn_sumbit, .btn_draft, .btn_cancel2, .btn_sumbit2, .btn_draft2 {

		width: 31%;

		float: right;

		margin-right: 5px;

	}

	.pad-0 {

		padding: 0px;

	}

	.md_list {
		cursor: pointer;
	}

	.md_list:hover {
		background: #ccc;
	}

	.doctorsDropdown {
		display: block;
	    overflow: hidden;
	    overflow-y: auto;
	    max-height: 70px;
	    position: relative;
	    width: 100%;
	}

	.towns {
		text-align: center;
	}
	.inactive-remove-button {
		pointer-events: none;
	}

</style>



<script type="text/javascript">

$(document).ready(function() {

	var count_itenerary = 1;

	var count_itenerary2 = 1;

	var count_label = 1;
	var count_label2 = 1;

	$('.i').addClass('activePage');

	$('.ii').addClass('activePage');

	

	$('.biomedis-logo').attr('src', '../assets/images/biomedis-logo.png');



    $('.footer-login img').attr('src', '../assets/images/biomedis-footer.png');	



    $('.i').click(function() {

    	var agenda_id = $('.hidden_agenda').val();

    	window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;

    })



	$('.add_focus_md').click(function() {

		//$('.loader').show();

		count_itenerary++;
		count_label++;


		var htm = '';

		var doctors = '';



		htm += '<div class="col-md-12 day_cont_'+count_itenerary+'">';

		htm += '<div class="col-md-2">';

		htm += '<label class="label_day_1 itenerary_name_'+count_label+'">Itinerary '+count_label+'</label>';

		htm += '</div>';

		

		htm += '<div class="col-md-5">';

			htm += '<div class="col-md-9 pad-0">';
				htm += '<input type="text" class="form-control search_'+count_itenerary+' search_text" placeholder="Search MD" data-value="'+count_itenerary+'">';
			htm += '</div>';
							
						
			htm += '<div class="col-md-3 pad-0">';
				htm += '<button class="form-control darkblue-btn darkblue-bg btn_search_'+count_itenerary+' btn_search" day="1" data-value="'+count_itenerary+'" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>';
			htm += '</div>';	

			htm += '<div class="doctors_'+count_itenerary+' doctorsDropdown" data-value="'+count_itenerary+'" style="display:none"></div>';

					
							
						

		//htm += '<select class="form-control doctorsDropdown doctors_'+count_itenerary+'" data-value="'+count_itenerary+'" style="display:none">';

		// htm += '<option value="n/a">-- Please Select Doctor --</option>';

		// htm += '</select></div>';

		htm += '</div>';

		htm += '<div class="col-md-3 towns">';

		htm += '<span class="towns_label towns_'+count_itenerary+'"></span>';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		//htm += '<select class="form-control hospitals_'+count_day_1+'">';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		htm += 		'<span class="glyphicon glyphicon-remove-circle remove_itenerary remove-icon" btnum="'+count_itenerary+'"></span>';

		htm += 	'</div>';



		htm += '</div>';

		$('.itenerary_cont').append(htm);



		//append_md(count_itenerary, 1);



		

		

	})



	$(document).on('click', '.remove_itenerary', function() {

		var row_id = $(this).attr('btnum');

		bootbox.confirm("<b>Are you sure you want to remove this record?</b>", function(r) {

			if(r) {

				
				if(count_label == 1) {
					$('.search_text').val('');
					$('.towns_label').html('');
				} else {
					$('.day_cont_'+row_id).remove();
				}
				

				var yy = 0;
				$('.label_day_1').each(function() {
					yy++;
					$(this).html('Itinerary '+yy);
					

				})

				count_label = yy;

			}

		})

	})

	





//////////////for day 2//////////////////

$('.add_focus_md_2').click(function() {

	

		count_itenerary2++;
		count_label2++;



		var htm = '';

		var doctors = '';



		htm += '<div class="col-md-12 day_2_cont_'+count_itenerary2+'">';

		htm += '<div class="col-md-2">';

		htm += '<label class="label_day_2 itenerary_name2_'+count_label2+'">Itinerary '+count_label2+'</label>';

		htm += '</div>';

		

		htm += '<div class="col-md-5">';

		htm += '<div class="col-md-9 pad-0">';
			htm += '<input type="text" class="form-control search2_'+count_itenerary2+' search_text2" placeholder="Search MD" data-value="'+count_itenerary2+'">';
			htm += '</div>';
							
						
			htm += '<div class="col-md-3 pad-0">';
				htm += '<button class="form-control darkblue-btn darkblue-bg btn_search2_'+count_itenerary2+' btn_search" day="2" data-value="'+count_itenerary2+'" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>';
			htm += '</div>';	

			htm += '<div class="doctors2_'+count_itenerary2+' doctorsDropdown" data-value="'+count_itenerary2+'" style="display:none"></div>';

					

		// htm += '<select class="form-control doctorsDropdown2 doctors2_'+count_itenerary2+'" data-value="'+count_itenerary2+'">';

		// htm += '<option value="n/a">-- Please Select Doctor --</option>';

		// htm += '</select></div>';

		htm += '</div>';



		htm += '<div class="col-md-3 towns">';

		htm += '<span class="towns_label_2 towns2_'+count_itenerary2+'">';

		htm += '</span></div>';



		htm += '<div class="col-md-1">';

		//htm += '<select class="form-control hospitals2_'+count_day_2+'">';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		htm += 		'<span class="glyphicon glyphicon-remove-circle remove_itenerary2 remove-icon" btnum="'+count_itenerary2+'"></span>';

		htm += '</div>';

		htm += '</div>';

		$('.itenerary_cont_2').append(htm);



		//append_md(count_itenerary2, 2);

	})



	$(document).on('click', '.remove_itenerary2', function() {

		var row_id = $(this).attr('btnum');

		bootbox.confirm("<b>Are you sure you want to remove this record?</b>", function(r) {

			if(r) {

				if(count_label2 == 1) {
					$('.search_text2').val('');
					$('.towns_label_2').html('');
				} else {
					$('.day_2_cont_'+row_id).remove();
				}

				var yy = 0;
				$('.label_day_2').each(function() {
					yy++;
					$(this).html('Itinerary '+yy);
					

				})

				count_label2 = yy;

			}

		})

		

	})



	$('.btn_sumbit2').click(function() {

		var btype = $(this).attr('btype');

		if(btype == 0) {
			var message = 'save';
		} else {
			var message = 'submit';
		}

		var blank_1 = 0
		var blank_2 = 0;

		$('.search_text').each(function() {
			var bl = $(this).val();
			if(bl == '') {
				blank_1++;
			}
		})

		$('.search_text2').each(function() {
			var bla = $(this).val();
			if(bla == '') {
				blank_2++;
			}
		})

		if(blank_1 == 0 && blank_2 == 0) {
			bootbox.confirm("<b>Are you sure you want to "+message+" this record? </b>", function(r) {

				if(r) {
					var errors = 0;
					var error_ctr = Math.max(count_itenerary, count_itenerary2);

					for(x=1;x<=error_ctr;x++) {
						if($('.doctors_'+x).val() == 'n/a') {
							$('.doctors_'+x).css({'border-color':'red'});

							errors++;

						} else {
							$('.doctors_'+x).css({'border-color':'#ccc'});
						}



						if($('.doctors2_'+x).val() == 'n/a') {
							$('.doctors2_'+x).css({'border-color':'red'});
							errors++;

						} else {

							$('.doctors2_'+x).css({'border-color':'#ccc'});
						}

					}


					if(errors != 0) {
						bootbox.alert("<b>Please select PSR</b>");
					} else {
						//submit_agenda(btype);
						var current_step = $('.hidden_step').val();
						if(btype == 1) {
							var next_step = 3;
							$.ajax({
								type:'post',
								url:'<?=base_url();?>Ojl_schedule/step',
								data:{'step':next_step}
							}).done(function() {
								var date_from = $('.date_from_hidden').val();
								var date_to = $('.date_from_to').val();
								$.ajax({
									type:'post',
									url:'<?=base_url()?>Ojl_schedule/submit_agenda',
									data:{stat:btype,date_from:date_from,date_to:date_to}
								}).done(function(result) {
									if(result != 'error') {
											for(a=1;a<=count_itenerary;a++) {
												var itenerary_name = $('.itenerary_name_'+a).html();
												// var doctor_id = $('.doctors_'+a+' option:selected').html();
												var doctor_id = $('.search_'+a).val();
												var town_id = $('.towns_'+a).html();
												var hospital_id = $('.hospitals_'+a).val();
												var status = $(this).attr('btype');

												if(doctor_id != undefined) {
													$.ajax({
													    url: '<?php echo base_url(); ?>Ojl_schedule/insert_itenerary',
													    type: "POST",
													    data: { itenerary_name: itenerary_name, doctor_id: doctor_id, town_id : town_id, hospital_id:hospital_id, status:status, day:1},

													    success: function (result) {
																$('.loader').hide();

													    },

													    error: function (xhr, status, p3, p4) {
													        var err = "Error " + " " + status + " " + p3;
													        if (xhr.responseText && xhr.responseText[0] == "{")
													            err = JSON.parse(xhr.responseText).message;
													        //alert(err);

													    }

													});

												}

											}

										submit_day2(btype);

										

									} 

									



								})	

							})	





						} else {

							for(a=1;a<=count_itenerary;a++) {

								var itenerary_name = $('.itenerary_name_'+a).html();

								// var doctor_id = $('.doctors_'+a+' option:selected').html();
								var doctor_id = $('.search_'+a).val();


								var town_id = $('.towns_'+a).html();

								var hospital_id = $('.hospitals_'+a).val();

								var status = $(this).attr('btype');

								

								if(doctor_id != undefined) {

									$.ajax({

									    url: '<?php echo base_url(); ?>Ojl_schedule/insert_itenerary',

									    type: "POST",

									    data: { itenerary_name: itenerary_name, doctor_id: doctor_id, town_id : town_id, hospital_id:hospital_id, status:status, day:1},

									    success: function (result) {

												$('.loader').hide();

										

												//alert("Successfully Saved!");

											

												

									    },

									    error: function (xhr, status, p3, p4) {

									        var err = "Error " + " " + status + " " + p3;

									        if (xhr.responseText && xhr.responseText[0] == "{")

									            err = JSON.parse(xhr.responseText).message;

									        alert(err);

									    }

									});

								}

								

							}



							submit_day2(btype);

						}
					}

				}

			})


		} else {

			bootbox.alert("<b>Please fill the missing fields</b>");


		}

		



		

			

	})





	// append_md(count_itenerary, 1);

	// append_md(count_itenerary2, 2);





	function append_md(number, type, search, day) {



		$('.loader').show();

		var psr = $('.hidden_psr').val();

		var dm = $('.hidden_dm').val();

		$.ajax({

	         type:'get',

	         url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/md/search',

	         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':search}

	        }).done(function(result) {

	        

	        	var htm = '';

	        	if(result.length == 0) {
	        		bootbox.alert("<b>No Record is Found</b>");

	        	} else {
	        		$.each(result, function(x,y) {



		        		var address = $.trim(y.Address1);

		        		if(address == '') {
		        			address = 'N/A';
		        		}

		        		if(day == 1) {
		        			htm += '<div class="md_list" day="1" row="'+number+'" address="'+address+'">'+y.Firstname+' '+y.Lastname+'</div>';
		        		} else {
		        			htm += '<div class="md_list" day="2" row="'+number+'" address="'+address+'">'+y.Firstname+' '+y.Lastname+'</div>';
		        		}
		        		
		        		// htm += '<option value="'+y.Firstname+'">';

		        		// 	htm += y.Firstname+' '+y.Lastname;

		        		// htm += '</option>';

		        	})
	        	}

	        	



	        	if(day == 1) {

	        		$('.doctors_'+number).html(htm);

	        		$('.loader').hide();

	        	} else {

	        		$('.doctors2_'+number).html(htm);

	        		$('.loader').hide();

	        	}	

	        	



	        })

	}



	$(document).on('change', '.doctorsDropdown', function() {

		var firstname = $(this).val();
		var row = $(this).attr('data-value');
		var this_name = $('.doctors_'+row+' option:selected').html();

		var psr = $('.hidden_psr').val();

		var dm = $('.hidden_dm').val();

		



		onchange_doctors(1, firstname, psr, dm, row, this_name);

	})



	$(document).on('change', '.doctorsDropdown2', function() {

		var firstname = $(this).val();
		var row = $(this).attr('data-value');
		var this_name = $('.doctors2_'+row+' option:selected').html();

		var psr = $('.hidden_psr').val();

		var dm = $('.hidden_dm').val();

		



		onchange_doctors(2, firstname, psr, dm, row, this_name);

	})





	$('.btn_cancel2').click(function() {

		bootbox.confirm("<b>Are you sure you want to cancel?</b>", function(r) {

			if(r == true) {

				window.location = '<?=base_url();?>Ojl_schedule';

			}

		})

	})







	function onchange_doctors(what, firstname, psr, dm, row, name) {

		$('.loader').show();

		$.ajax({

	         type:'get',

	         url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/md/search',

	         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':name}

	        }).done(function(result) {

	        

	        	var htm = '';

	        	

	        	$.each(result, function(x,y) {



	        		if(y.Firstname == firstname) {

	        			if(what == 1) {

							$('.towns_'+row).html(y.Address1);

							$('.loader').hide();

	        			} else {

	        				$('.towns2_'+row).html(y.Address1);

	        				$('.loader').hide();

	        			}

	        			

	        		}

	        	})	



	        })

	}



	// $(document).on('click', '.remove_itenerary2', function() {

	// 	var row_id = $(this).attr('btnum');

	// 	if()
	// 	$('.day2_cont_'+row_id).remove();

	// })



	function submit_agenda(stat) {

		

		





		

	}



	function submit_day2(stat) {

		

				

			



		for(a=1;a<=count_itenerary2;a++) {

				var itenerary_name = $('.itenerary_name2_'+a).html();

				// var doctor_id = $('.doctors2_'+a+' option:selected').html();
				var doctor_id = $('.search2_'+a).val();

				var town_id = $('.towns2_'+a).html();

				var hospital_id = $('.hospitals2_'+a).val();

				

				if(doctor_id != undefined) {

					$.ajax({

					    url: '<?php echo base_url(); ?>Ojl_schedule/insert_itenerary',

					    type: "POST",

					    data: { itenerary_name: itenerary_name, doctor_id: doctor_id, town_id : town_id, hospital_id:hospital_id, status:status, day:2},

					    success: function (result) {

								$('.loader').hide();

						

								

							

						

					    },

					    error: function (xhr, status, p3, p4) {

					        var err = "Error " + " " + status + " " + p3;

					        if (xhr.responseText && xhr.responseText[0] == "{")

					            err = JSON.parse(xhr.responseText).message;

					        alert(err);

					    }

					});



				}

			}











			if(stat == 0) {

				bootbox.alert("<b>The record is successfully saved as draft.</b>", function() {

					window.location = '<?=base_url();?>Ojl_schedule';

				});

				

			} else {

				submit_email();

				

			}



							



			

	}



	function submit_email() {

		var hids_agenda = $('.hidden_agenda').val();

		$.ajax({

			type:'post',

			url:'<?=base_url();?>Agenda/sendMail',

			data:{'agenda_id':hids_agenda}

		}).done(function(result) {

			bootbox.alert("<b>The record is successfully submitted.</b>", function() {

				window.location = '<?=base_url();?>sales_plan_for_the_month?id='+hids_agenda;

			});

			

		})

	}



	$(document).on('click', '.btn_search', function() {
		var btn_number = $(this).attr('data-value');
		var day = $(this).attr('day');
		

		if(day == 1) {
			var search = $('.search_'+btn_number).val();
			search = $.trim(search);
			if(search.length>1){
				append_md(btn_number, 1, search, day);
				$('.doctors_'+btn_number).show();
			}

			
		} else {
			var search = $('.search2_'+btn_number).val();
			search = $.trim(search);
			if(search.length>1){
				append_md(btn_number, 1, search, day);
				$('.doctors2_'+btn_number).show();
			}
		}
		//alert(btn_number+' '+day+' '+search);

	})

	$(document).on('click', '.md_list', function() {
		var address_div = $(this).attr('address');
		var doctor_name = $(this).html();
		var day = $(this).attr('day');
		var row = $(this).attr('row');

		if(day == 1) {
			$('.search_'+row).val(doctor_name);
			$('.towns_'+row).html(address_div);
			$('.doctors_'+row).hide();
			//alert($('.remove_itenerary[btnum="'+row+'"]').attr('btnum'));
			$('.remove_itenerary[btnum="'+row+'"]').removeClass('inactive-remove-button');
		} else {
			$('.search2_'+row).val(doctor_name);
			$('.towns2_'+row).html(address_div);
			$('.doctors2_'+row).hide();
			$('.remove_itenerary2[btnum="'+row+'"]').removeClass('inactive-remove-button');
		}
		
	})

	



})

</script>



<input type="hidden" class="hidden_dm" value="<?= $this->session->userdata('emp_id'); ?>">

<input type="hidden" class="hidden_psr" value="<?= $this->session->userdata('agenda_psr'); ?>">

<input type="hidden" class="hidden_agenda" value="<?= $this->session->userdata('agenda_id'); ?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">

<div class="col-md-12 col-sm-12 itenerary_container" style="background-color:white">

	<div class="col-md-2 col-sm-3 progress_div">

		<?php include('progress.php'); ?>

	</div>



	<div class="col-md-10 col-sm-9 pad-0">

		<div class="col-md-12 pad-0">

			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE > CREATE NEW</p>

			<p class="darkblue-font page_title">ITINERARY</p>

		</div>



		<div class="col-md-12 itenerary_day1 pad-0">



			<div class="col-md-2 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;">

				<b>Day 1 :</b> <span class="date_from"><?= $date_from; ?></span>

			</div>

			<input type="hidden" class="date_from_hidden" value="<?= $date_from; ?>">

			<div class="col-md-5 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">

				<b> Name of MD </b>

			</div>



			<div class="col-md-3 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">

				<b> Address </b>

			</div>



			<div class="col-md-2 pad-0" style="text-align:right;margin-top:10px;margin-bottom:10px;">

				<a class="add_focus_md darkblue-font" style="width:20%;"><b>ADD FOCUS MD</b></a>

			</div>



			<div class="col-md-12 itenerary_cont">

				<div class="col-md-12 day_cont_1">

					<div class="col-md-2">

						<label class="label_day_1 itenerary_name_1">Itinerary 1</label>

					</div>



					<div class="col-md-5">
						<div class="col-md-9 pad-0">
							<input type="text" class="form-control search_1 search_text" placeholder="Search MD" data-value="1">
						</div>

						<div class="col-md-3 pad-0">
							<button class="form-control darkblue-btn darkblue-bg btn_search_1 btn_search" day="1" data-value="1" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
						</div>
						
						
						<div class="doctors_1 doctorsDropdown" data-value="1" style="display:none">

						</div>
					<!-- 	<select class="form-control doctors_1 doctorsDropdown" data-value="1" style="display:none;">

						<option value="n/a">-- Please Select Doctor --</option>

						

						</select> -->

					</div>



					<div class="col-md-3 towns">

						<span class="towns_1 towns_label"></span>

						<!-- <select class="form-control towns_1">

						</select> -->

					</div>



					<div class="col-md-1">

						<!-- <select class="form-control hospitals_1">

						</select> -->

					</div>



					<div class="col-md-1">

						<span class="glyphicon glyphicon-remove-circle remove_itenerary remove-icon inactive-remove-button" btnum="1"></span>

					</div>

				</div>

			</div>



	<!-- 		<div class="col-md-12 div_buttons pad-0" style="margin-top:20px;">

				<button class="btn btn-primary btn_cancel">Cancel</button>

				<button class="btn btn-primary btn_sumbit" btype="2">Save as Draft</button>

				<button class="btn btn-primary btn_sumbit" btype="1">Submit</button>

				

			</div> -->



		</div>

		<?php if($date_from != $date_to) { ?>

			<div class="col-md-12 itenerary_day2 pad-0" style="margin-top:20px;">

				<div class="col-md-2 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;">

					<b>Day 2 :</b> <span class="date_to"><?= $date_to; ?></span>

				</div>

				<input type="hidden" class="date_to_hidden" value="<?= $date_to; ?>">

				<div class="col-md-5 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">

					<b> Name of MD </b>

				</div>



				<div class="col-md-3 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">

					<b> Address </b>

				</div>



				<div class="col-md-2 pad-0" style="text-align:right;margin-top:10px;margin-bottom:10px;">

					<a class="add_focus_md_2 darkblue-font" style="width:20%;"><b>ADD FOCUS MD</b></a>

				</div>



				<div class="col-md-12 itenerary_cont_2">

					<div class="col-md-12 day_2_cont_1">

						<div class="col-md-2">

							<label class="label_day_2 itenerary_name2_1">Itinerary 1</label>

						</div>



						<div class="col-md-5">

							<div class="col-md-9 pad-0">
								<input type="text" class="form-control search2_1 search_text2" placeholder="Search MD" data-value="1">
							</div>

							<div class="col-md-3 pad-0">
								<button class="form-control darkblue-btn darkblue-bg btn_search2_1 btn_search" day="2" data-value="1" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
							</div>
							
							
							<div class="doctors2_1 doctorsDropdown" data-value="1" style="display:none">

							</div>

							<!-- <select class="form-control doctors2_1 doctorsDropdown2" data-value="1">

							<option value="n/a">-- Please Select Doctor --</option>

						

							</select> -->

						</div>



						<div class="col-md-3 towns">

							<span class="towns2_1 towns_label_2"></span>

						</div>



						<div class="col-md-1">

							

						</div>



						<div class="col-md-1">

							<span class="glyphicon glyphicon-remove-circle remove_itenerary2 remove-icon inactive-remove-button" btnum="1"></span>

						</div>

					</div>

				</div>







				



			</div>

	

				<?php } ?>



				<div class="col-md-12 div_buttons pad-0" style="margin-top:20px;">

					<div class="col-md-6 pad-0">
						<i>Submit - submit the entire plan <br />Save as Draft - save the entire plan as draft</i>
					</div>

					<div class="col-md-6 pad-0">
						<button class="darkblue-btn darkblue-bg btn_cancel2">Cancel</button>
						<button class="darkblue-btn darkblue-bg btn_sumbit2" btype="0">Save as Draft</button>
						<button class="darkblue-btn darkblue-bg btn_sumbit2" btype="1">Submit</button>
					</div>

					

					

				</div>

		

	</div>



	



	

</div>