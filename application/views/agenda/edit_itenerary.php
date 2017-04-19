<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>





<script type="text/javascript">

$(document).ready(function() {

	var count_day_1 = $('.hidden_count_day_1').val();

	var count_day_2 = $('.hidden_count_day_2').val();

	var count_label = 1;
	var count_label2 = 1;

	var ite_1 = count_day_1;

	var ite_2 = count_day_2;

		

		$(document).on('keypress', '.search_text', function(e) {
			var data_val = $(this).attr('data-value');
			var day = $(this).attr('day');

		    if(e.which == 13) {
		    	//alert(data_val+' '+day);
		       search_md(data_val, day);
		    }
		});

		$(document).on('click', '.btn_search', function(e) {
			e.preventDefault();
			var btn_number = $(this).attr('data-value');
			var day = $(this).attr('day');

			search_md(btn_number, day);
			
			// /alert(btn_number+' '+day);
			
			// alert(btn_number+' '+day+' '+search);

		})


		function search_md(btn_number, day) {
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
		}

	// $('.i').addClass('activePage');

	// $('.ii').addClass('activePage');



	$('.i').click(function() {

		var agenda_id = $('.hidden_agenda').val();



		 location.href = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;

	})



	var agenda_id = $('.agenda_id').val();









	$('.add_focus_md').click(function() {

		$('.loader').show();

		count_day_1++;

		count_label++;

		ite_1++;



		var htm = '';

		var doctors = '';



		htm += '<div class="col-md-12 daycont day_cont_'+count_day_1+'" data-value="'+count_day_1+'">';

		htm += '<div class="col-md-2">';

		htm += '<label class="label_day_1 itenerary_name_'+count_label+'">Itinerary '+count_label+'</label>';

		htm += '</div>';

		

		htm += '<div class="col-md-5">';

			htm += '<div class="col-md-9 pad-0">';
				htm += '<input type="text" class="form-control search_'+count_day_1+' search_text return-type-a" day="1" placeholder="Search MD" data-value="'+count_day_1+'">';
			htm += '</div>';
							
						
			htm += '<div class="col-md-3 pad-0">';
				htm += '<button class="form-control darkblue-btn darkblue-bg btn_search_'+count_day_1+' btn_search" day="1" data-value="'+count_day_1+'" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>';
			htm += '</div>';	

			htm += '<div class="doctors_'+count_day_1+' doctorsDropdown" data-value="'+count_day_1+'" style="display:none"></div>';


		// htm += '<select class="form-control doctorsDropdown doctors_'+count_day_1+' return-type-a" return-type-a="add" data-value="'+count_day_1+'">';

		// htm += '</select>';

		htm += '</div>';



		htm += '<div class="col-md-3">';

		htm += '<span class="towns_label towns_'+count_day_1+'"></span>';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		//htm += '<select class="form-control hospitals_'+count_day_1+'">';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		htm += 		'<span class="glyphicon glyphicon-remove-circle remove_itenerary remove-icon" btnum="'+count_day_1+'"></span>';

		htm += 	'</div>';



		htm += '</div>';

		$('.itenerary_cont').append(htm);

				

	$('.loader').hide();



	var for_add_doc = $('.doctors_'+count_day_1+' option:selected').html();

	var for_add = '<input type="text" class="for_add'+count_day_1+'" day="1" row_id="'+count_day_1+'" value="'+for_add_doc+'">';

	for_add += '<input type="text" class="for_add_address'+count_day_1+'" row_id="'+count_day_1+'" value="'+for_add_doc+'">';

	$('.for_add').append(for_add);

	var ugh = 1;

	$('.label_day_1').each(function() {
		$(this).html("Itinerary "+ugh);
		ugh++;

	})

		

	})





$('.add_focus_md_2').click(function() {

		$('.loader').show();

		count_day_2++;
		count_label2++;

		ite_2++;



		var htm = '';

		var doctors = '';



		htm += '<div class="col-md-12 day_2_cont_'+count_day_2+'">';

		htm += '<div class="col-md-2">';

		htm += '<label class="label_day_2 itenerary_name2_'+count_day_2+'">Itinerary '+count_label2+'</label>';

		htm += '</div>';

		

		htm += '<div class="col-md-5">';

			htm += '<div class="col-md-9 pad-0">';
			htm += '<input type="text" class="form-control search2_'+count_day_2+' search_text2 return-type-b" day="2" placeholder="Search MD" data-value="'+count_day_2+'">';
			htm += '</div>';
							
						
			htm += '<div class="col-md-3 pad-0">';
				htm += '<button class="form-control darkblue-btn darkblue-bg btn_search2_'+count_day_2+' btn_search return-type-b" day="2" data-value="'+count_day_2+'" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>';
			htm += '</div>';	

			htm += '<div class="doctors2_'+count_day_2+' doctorsDropdown" data-value="'+count_day_2+'" style="display:none"></div>';


		// htm += '<select class="form-control doctorsDropdown2 doctors2_'+count_day_2+' return-type-b" return-type-b="add" data-value="'+count_day_2+'">';

		// htm += '</select>';

		htm += '</div>';



		htm += '<div class="col-md-3">';

		htm += '<span class="towns_label_2 towns2_'+count_day_2+'">';

		htm += '</span></div>';



		htm += '<div class="col-md-1">';

		//htm += '<select class="form-control hospitals2_'+count_day_2+'">';

		htm += '</div>';



		htm += '<div class="col-md-1">';

		htm += 		'<span class="glyphicon glyphicon-remove-circle remove_itenerary2 remove-icon" btnum="'+count_day_2+'"></span>';

		htm += '</div>';

		htm += '</div>';

		$('.itenerary_cont_2').append(htm);


		$('.loader').hide();



		var for_add_doc = $('.doctors2_'+count_day_2+' option:selected').html();

		var for_add = '<input type="text" class="for_add2'+count_day_2+'" day="2" row_id="'+count_day_2+'" value="'+for_add_doc+'">';

		for_add += '<input type="text" class="for_add_address2'+count_day_2+'" row_id="'+count_day_2+'" value="'+for_add_doc+'">';

		$('.for_add').append(for_add);

		var ugh = 1;

		$('.label_day_2').each(function() {
			$(this).html("Itinerary "+ugh);
			ugh++;

		})

	})



$('.btn_cancel2').click(function() {

	bootbox.confirm("<b>Are you sure you want to cancel?</b>", function(r) {

		if(r == true) {

			window.location = '<?=base_url();?>Ojl_schedule';

		}

	})

})





function add_mds(count, type) {

	var psr = $('.hidden_psr').val();

	var dm = $('.hidden_dm').val();

	



	$.ajax({

         type:'get',

         url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/md/search',

         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':'santos'}

        }).done(function(result) {

        	

        	var htm = '';

        		htm += '<option>-- Please Select Doctor --</option>';

        	$.each(result, function(x,y) {



        		var docz = y.Firstname+' '+y.Lastname;



        		htm += '<option value="'+y.Firstname+'">';

        			htm += docz;

        		htm += '</option>';

        	})



        	if(type == 1) {

        		$('.doctors_'+count).append(htm);

        	} else {

        		$('.doctors2_'+count).append(htm);

        	}

        	





        })

}







	$(document).on('click', '.remove_itenerary', function() {



		var row_id = $(this).attr('btnum');	

		bootbox.confirm("<b>Are you sure you want to remove this record?", function(r) {

			if(r) {


				if(ite_1 == 1) {
					$('.search_text').val('');
					$('.towns_label').html('');
					//bootbox.alert("<b>You need to select atleast 1 itinerary for Day 1</b>");

				} else {

					ite_1--;

					

					var for_delete_id = $('.hidden_doc_'+row_id).attr('data-id');

					$('.day_cont_'+row_id).remove();

					var ugh = 1;
					$('.label_day_1').each(function() {
						$(this).html("Itinerary "+ugh);
						ugh++;

					})

					if(for_delete_id != undefined) {

						

						var del = '<input type="text" class="for_delete_id for_delete_'+row_id+'" value="'+for_delete_id+'">';

						$('.for_delete').append(del);

					} else {

						$('.for_add'+row_id).remove();

						$('.for_add_address'+row_id).remove();

						var ugh = 1;
						$('.label_day_1').each(function() {
							$(this).html("Itinerary "+ugh);
							ugh++;

						})

						var yy = 0;
						$('.label_day_1').each(function() {
							yy++;
							//$(this).html('Itinerary '+yy);
							

						})

						count_label = yy;
					}


				}


			}

		})



		

	})



	$(document).on('click', '.remove_itenerary2', function() {

		var row_id = $(this).attr('btnum');

		bootbox.confirm("<b>Are you sure you want to remove this record?", function(r) {

			if(r) {



				if(ite_2 == 1) {



					
					$('.search_text2').val('');
					$('.towns_label_2').html('');


					//bootbox.alert("<b>You need to select atleast 1 itinerary for Day 2</b>");

				} else {

					ite_2--;



					var for_delete_id = $('.hidden_doc2_'+row_id).attr('data-id');

					$('.day_2_cont_'+row_id).remove();

					var ugh = 1;
						$('.label_day_2').each(function() {
							$(this).html("Itinerary "+ugh);
							ugh++;

						})



					if(for_delete_id != undefined) {

						var del = '<input type="text" class="for_delete_id for_delete2_'+row_id+'" value="'+for_delete_id+'">';

						$('.for_delete').append(del);

					} else {

						$('.for_add2'+row_id).remove();

						$('.for_add_address2'+row_id).remove();

						var ugh = 1;
						$('.label_day_2').each(function() {
							$(this).html("Itinerary "+ugh);
							ugh++;

						})

						var yy = 0;
						$('.label_day_2').each(function() {
							yy++;
							//$(this).html('Itinerary '+yy);
							

						})

						count_label2 = yy;

					}



					

			

				}

				

			}

		})

		

	})



	$('.prog_itenerary').css({'color':'blue'});



	$('.btn_sumbit2').click(function() {

		var type = $(this).attr('btype');

		if(type == 0) {
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



				var current_step = $('.hidden_step').val();



				if(type == 1) {

					var next_step = 3;



						$.ajax({

							type:'post',

							url:'<?=base_url();?>Ojl_schedule/step',

							data:{'step':next_step}

						}).done(function() {

							
							var dfrom = $('.hidden_date_from').val();
							var dto = $('.hidden_date_to').val();

								$.ajax({

									type:'post',

									url:'<?=base_url();?>Ojl_schedule/submit_agenda',

									data:{"stat":type, "datefrom":dfrom, "dateto":dto}

								}).done(function(result) {

									if(result != 'error') {
										var dell = 1;
										
										if($('.for_delete_id').length == 0) {
											insert_itinerary(type);
										}  else {
											$('.for_delete_id').each(function() {
												var id = $(this).val();

												$.ajax({
													type:'post',
													url:'<?=base_url();?>Agenda/delete_itinerary',
													data:{"itenerary_id":id}
												}).done(function() {

												})
												if(dell == $('.for_delete_id').length) {

													insert_itinerary(type);

												}

												dell++;

											})

										}

									} else {
										bootbox.alert('There is an ojl already for this dates');
									}

								})		


						})	

				} else {

					
					$.ajax({

						type:'post',

						url:'<?=base_url();?>Ojl_schedule/submit_agenda',

						data:{"stat":'0'}

					}).done(function(result) {


			



						var dell = 1;



						if($('.for_delete_id').length == 0) {

							insert_itinerary(0);
						}  else {

							$('.for_delete_id').each(function() {

								var id = $(this).val();

								$.ajax({

									type:'post',

									url:'<?=base_url();?>Agenda/delete_itinerary',

									data:{"itenerary_id":id}

								}).done(function() {

								})

								if(dell == $('.for_delete_id').length) {

									insert_itinerary(0);

								}

								dell++;

							})

						}

					})	

				}


			}

		})
		} else {

			bootbox.alert("<b>Please fill the missing fields</b>");


		}
		//

	})



		function insert_itinerary(type) {

			var agenda_id = $('.hidden_agenda').val();

			// $('.return-type-a option:selected').each(function() {
			$('.return-type-a').each(function() {
				
				var docs = $(this).val();

				var address = $(this).attr('address');

				var day = 1;

				insert_ite(docs, address, day);

		

			})



			// $('.return-type-b option:selected').each(function() {
			$('.return-type-b').each(function() {
				
				var docs = $(this).val();

				var address = $(this).attr('address');

				var day = 2;

				insert_ite(docs, address, day);

			})



			if(type == 0) {

				bootbox.alert("<b>The record is successfully updated</b>", function() {

					window.location = '<?=base_url();?>Ojl_schedule';

				});

			} else {

				bootbox.alert("<b>The record is successfully submitted</b>", function() {

					window.location = '<?=base_url();?>Sales_plan_for_the_month?id='+agenda_id;

				});

			}

			

		}



		function insert_ite(docs, address, day) {

			$.ajax({

				type:'post',

				url:'<?=base_url();?>Agenda/insert_ite',

				data:{'docs':docs, 'address':address, 'day':day}

			}).done(function() {



			})

		}



		function update_step_2(type) {

			



			for(to_day_1=1;to_day_1<=count_day_1;to_day_1++) {

				var doctor_id = $('.doctors_'+to_day_1+' option:selected').html();

				var doctor_address = $('.towns_'+to_day_1).html();



				if(doctor_id != undefined) {

					$.ajax({

						type:'post',

						url:'<?=base_url();?>Agenda/update_itenerary',

						data:{"doctor_id":doctor_id, "doctor_address":doctor_address, "day":1}

					}).done(function(result) {

						

					})

				}

				

			}

			update_step_3(type);



		}



		function update_step_3(type) {

			

			var agenda_id = $('.hidden_agenda').val();

			for(to_day_2=1;to_day_2<=count_day_2;to_day_2++) {

				var doctor_id = $('.doctors2_'+to_day_2+' option:selected').html();

				var doctor_address = $('.towns2_'+to_day_2).html();

				if(doctor_id != undefined) {

					$.ajax({

						type:'post',

						url:'<?=base_url();?>Agenda/update_itenerary',

						data:{"doctor_id":doctor_id, "doctor_address":doctor_address, "day":2}

					}).done(function(result) {

						

					})

				}

			}

			

			if(type == 0) {

				bootbox.alert("<b>The record is successfully saved as draft.</b>");

				window.location = '<?=base_url();?>ojl_schedule';

			} else {

				bootbox.alert('<b>The record is successfully submitted.</b>');

				window.location = '<?=base_url();?>Sales_plan_for_the_month?id='+agenda_id;

			}

			

		}





	

			// for(z=1;z<=count_day_1;z++) {
			// 	append_mds(z, 1);
			// }



			// for(aa=1;aa<=count_day_2;aa++) {
			// 	append_mds(aa, 2);
			// }

			

		

		function append_mds(ctr, what) {

			$('.loader').show();

			var psr = $('.hidden_psr').val();

			var dm = $('.hidden_dm').val();



			if (what == 1) {

				var this_doctor = $('.hidden_doc_'+ctr).val();

			} else {

				var this_doctor = $('.hidden_doc2_'+ctr).val();

			}

			



			$.ajax({

		         type:'get',

		         url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/md/search',

		         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':'santos'}

		        }).done(function(result) {

		        	

		        	var htm = '';

		        	$.each(result, function(x,y) {



		        		var docz = y.Firstname+' '+y.Lastname;



		        		if(docz == this_doctor) {

		        			htm += '<option value="'+y.Firstname+'" selected>';

		        		} else {

		        			htm += '<option value="'+y.Firstname+'">';

		        		}



		        		

		        			htm += docz;

		        		htm += '</option>';

		        	})



		        	if(what == 1) {

		        		$('.doctors_'+ctr).append(htm);

		        		$('.loader').hide();

		        	} else {

		        		$('.doctors2_'+ctr).append(htm);

		        		$('.loader').hide();

		        	}

		        	



		        	// if(type == 1) {

		        	// 	$('.doctors_'+count_itenerary).append(htm);

		        	// } else {

		        	// 	$('.doctors2_'+count_itenerary).append(htm);

		        	// }	

		        	



		        })

		}





		$(document).on('change', '.doctorsDropdown', function() {

			var firstname = $(this).val();

			var psr = $('.hidden_psr').val();

			var dm = $('.hidden_dm').val();

			var dval = $(this).attr('data-value');



			onchange_doctors(1, firstname, psr, dm, dval);

		})



		$(document).on('change', '.doctorsDropdown2', function() {

			var firstname = $(this).val();

			var psr = $('.hidden_psr').val();

			var dm = $('.hidden_dm').val();

			var dval = $(this).attr('data-value');



			onchange_doctors(2, firstname, psr, dm, dval);

		})



		function onchange_doctors(what, firstname, psr, dm, dval) {

		$.ajax({

	         type:'get',

	         url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/md/search',

	         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':'santos'}

	        }).done(function(result) {

	        

	        	var htm = '';

	        	

	        	$.each(result, function(x,y) {



	        		if(y.Firstname == firstname) {

	        			if(what == 1) {

							$('.towns_'+dval).html(y.Address1);

							$('.for_add'+dval).val($('.doctors_'+dval+' option:selected').html());

							$('.doctors_'+dval+' option:selected').attr('address', y.Address1);

							$('.for_add_address'+dval).val(y.Address1);

	        			} else {

	        				$('.towns2_'+dval).html(y.Address1);

	        				$('.for_add2'+dval).val($('.doctors2_'+dval+' option:selected').html());

	        				$('.doctors2_'+dval+' option:selected').attr('address', y.Address1);

							$('.for_add_address2'+dval).val(y.Address1);

	        			}

	        			

	        		}

	        	})	



	        	



	        })

	}





	$.ajax({

		type:'post',

		url:'<?=base_url();?>Agenda/check_stat',

		data:{'agenda_id':agenda_id}

	}).done(function(result) {

		var obj = JSON.parse(result);



		$.each(obj, function(x,y) {

			//$('.hidden_status').val(y.status);

			

			if(y.status != 0) {

				

				$("#itinerary_form :input").attr("disabled", true);

				$('.search_text2').attr("disabled", true);
				$('.searchss_2').attr("disabled", true);

				$('.doctorsDropdown2').attr("disabled", true);

				$('.btn_sumbit2').hide();

				$('.btn_next2').show();

				$('.add_focus_md').hide();

				$('.add_focus_md_2').hide();

				$('.remove_itenerary').hide();

				$('.remove_itenerary2').hide();



			}

		})

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
		} else {
			$('.search2_'+row).val(doctor_name);
			$('.towns2_'+row).html(address_div);
			$('.doctors2_'+row).hide();
		}
		
	})


	function append_md(number, type, search, day) {



		$('.loader').show();
		var psr = $('.hidden_psr').val();
		var dm = $('.hidden_dm').val();
		$.ajax({
	         type:'get',
	         url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/md/search',
	         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'q':search}
	        }).done(function(result) {

	        	if(result.length == 0) {
	        		bootbox.alert("<b>No Record found.</b>");
	        	}

	        	


	        	var htm = '';
	        	$.each(result, function(x,y) {

	        		var address = $.trim(y.Address1);

		        		if(address == '') {
		        			address = 'N/A';
		        		}
	        		if(day == 1) {
	        			htm += '<div class="md_list" day="1" row="'+number+'" address="'+address+'">'+y.Firstname+' '+y.Lastname+'</div>';
	        			$('.search_'+number).attr('address', y.Address1);
	        		} else {
	        			htm += '<div class="md_list" day="2" row="'+number+'" address="'+address+'">'+y.Firstname+' '+y.Lastname+'</div>';
	        			$('.search2_'+number).attr('address', y.Address1);
	        		}
	        	})

	        	if(day == 1) {
	        		$('.doctors_'+number).html(htm);
	        		$('.loader').hide();
	        	} else {
	        		$('.doctors2_'+number).html(htm);
	        		$('.loader').hide();
	        	}	

	        })

	}




		

	

})

</script>



<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>





<style type="text/css">

.btn_cancel2, .btn_sumbit2, .btn_next2 {

	float:right;

	width:31%;

	text-align:center;

}



.a_disabled {

	pointer-events:none;

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

</style>



<input type="hidden" class="hidden_dm" value="<?= $this->session->userdata('emp_id'); ?>">

<input type="hidden" class="hidden_psr" value="<?= $this->session->userdata('agenda_psr'); ?>">

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="agenda_id" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">

<input type="hidden" class="hidden_date_from" value="<?=$dfrom;?>">
<input type="hidden" class="hidden_date_to" value="<?=$dto;?>">


<div class="itenerary_container col-md-12 col-sm-12" style="background-color:white">

	<div class="col-md-2 col-sm-3 progress_div">

		<?php $this->load->view('schedule/progress'); ?>

	</div>



	<div class="col-md-10 col-sm-9 pad-0">

		<div class="col-md-12 pad-0">

			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE > EDIT AGENDA</p>

			<p class="darkblue-font page_title">ITINERARY</p>

		</div>



		<div class="col-md-12 itenerary_day1 pad-0">
			<div id="itinerary_form">
				<div class="col-md-2 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;">
					<b>Day 1 :</b> <span class="date_from"><?= $date_from;  ?></span>
				</div>

				<div class="col-md-5 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">
					<b> Name of MD </b>
				</div>

				<div class="col-md-3 pad-0" style="text-align:left;margin-top:10px;margin-bottom:10px;text-align:center">
					<b> Address </b>
				</div>



				<div class="col-md-2 pad-0" style="text-align:right;margin-top:10px;margin-bottom:10px;">
					<?php if($status != 1) { ?>
						<a class="add_focus_md darkblue-font" style="width:20%;"><b>ADD FOCUS MD</b></a>
					<?php } ?>
				</div>



				<div class="col-md-12 itenerary_cont">
					<?php $x=1; $count_day_1 = 0; $count_day_2 = 0; foreach($itenerary as $val) { 
						if($val->day == 1) {
						?>
						<div class="col-md-12 day_cont_<?=$x;?>">
							<div class="col-md-2">
								<label class="label_day_1 itenerary_name_<?=$x;?>">Itinerary <?=$x;?></label>
							</div>



							<div class="col-md-5">
								<input type="hidden" class="hidden_doc_<?=$x?>" data-id="<?=$val->itenerary_id;?>" value="<?=$val->doctor;?>">
								<div class="col-md-9 pad-0">
									<input type="text" title="<?=$val->doctor;?>" class="form-control search_<?=$x;?> search_text return-type-a" day="1" return-type-a="exist" placeholder="Search MD" data-value="<?=$x;?>" value="<?=$val->doctor;?>">
								</div>

								<div class="col-md-3 pad-0">
									<button class="form-control darkblue-btn darkblue-bg btn_search_<?=$x;?> btn_search" day="1" data-value="<?=$x;?>" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
								</div>
						
								<div class="doctors_<?=$x;?> doctorsDropdown" data-value="<?=$x;?>" style="display:none"></div>
								
							</div>

							<div class="col-md-3" style="text-align:center">
								<span class="towns_label towns_<?=$x;?>"><?=$val->doctor_address;?></span>
							</div>

							<div class="col-md-1"></div>

							<div class="col-md-1">
								<?php if($status != 1) { ?>
									<span class="glyphicon glyphicon-remove-circle remove_itenerary remove-icon" btnum="<?=$x;?>"></span>
								<?php } ?>
							</div>
						</div>

					<?php $x++; $count_day_1++;}  } 



						if($count_day_1 == 0) {

					 ?>



					 	<div class="col-md-12 day_cont_<?=$x;?>">
							<div class="col-md-2">
								<label class="label_day_1 itenerary_name_1">Itinerary 1</label>
							</div>

							<div class="col-md-5">
								<input type="hidden" class="hidden_doc_1" value="">
								<div class="col-md-9 pad-0">
									<input type="text" class="form-control search_1 search_text return-type-a" placeholder="Search MD" data-value="1">
								</div>

								<div class="col-md-3 pad-0">
									<button class="form-control darkblue-btn darkblue-bg btn_search_1 btn_search" day="1" data-value="1" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
								</div>
								
								<div class="doctors_1 doctorsDropdown" data-value="1" style="display:none"></div>

							</div>

							<div class="col-md-3">
								<span class="towns_label towns_1"><?=$val->doctor_address;?></span>
							</div>

							<div class="col-md-1"></div>

							<div class="col-md-1">
								<?php if($status != 1) { ?>
									<span class="glyphicon glyphicon-remove-circle remove_itenerary remove-icon" btnum="1"></span>
								<?php } ?>
							</div>
						</div>

					 <?php $count_day_1++; }  ?>
				</div>
				<input type="hidden" class="hidden_count_day_1" value="<?=$count_day_1;?>">
			



			<?php if($dfrom != $dto) { ?>

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
				<?php if($status != 1) { ?>
				<a class="add_focus_md_2 darkblue-font" style="width:20%;"><b>ADD FOCUS MD</b></a>
				<?php } ?>
			</div>

					<div class="col-md-12 itenerary_cont_2" style="">
						


						<!-- <div class="col-md-12 day_2_cont_1"> -->
						<?php $y=1; $count_day_2 = 0; foreach($itenerary as $val) { 

							if($val->day == 2) {

							?>

							<div class="col-md-12 day_2_cont_<?=$y;?>">

								<div class="col-md-2">

									<label class="label_day_2 itenerary_name2_<?=$y;?>">Itinerary <?=$y;?></label>

								</div>



								<div class="col-md-5">

									<input type="hidden" class="hidden_doc2_<?=$y?>" data-id="<?=$val->itenerary_id;?>" value="<?=$val->doctor;?>">

									<div class="col-md-9 pad-0">
										<input type="text" title="<?=$val->doctor;?>" class="form-control search2_<?=$y;?> search_text2 return-type-b" day="2" return-type-b="exist" placeholder="Search MD" data-value="<?=$y;?>" value="<?=$val->doctor;?>">
									</div>

									<div class="col-md-3 pad-0">
										<button class="form-control darkblue-btn darkblue-bg btn_search2_<?=$y;?> btn_search searchss_2" day="2" data-value="<?=$y;?>" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
									</div>
									
									
									<div class="doctors2_<?=$y;?> doctorsDropdown" data-value="<?=$y;?>" style="display:none">

									</div>
								</div>



								<div class="col-md-3" style="text-align:center">

									<span class="towns_label_2 towns2_<?=$y;?>"><?=$val->doctor_address;?></span>

								</div>



								<div class="col-md-1">

								</div>



								<div class="col-md-1">

									<?php if($status != 1) { ?>

										<span class="glyphicon glyphicon-remove-circle remove_itenerary2 remove-icon" btnum="<?=$y;?>"></span>

									<?php } ?>

								</div>

							</div>

							

						<?php $y++; $count_day_2++; }  }  



							if($count_day_2 == 0) { 

						?>



							<div class="col-md-12 itenerary_day2 pad-0">


						<!-- 	<div class="col-md-12 itenerary_cont_2"> -->
								<div class="col-md-12 day_2_cont_1">

									<div class="col-md-2">
										<label class="label_day_2 itenerary_name2_1">Itinerary 1</label>
									</div>



									<div class="col-md-5">

										<div class="col-md-9 pad-0">
											<input type="text" class="form-control search2_1 search_text2 return-type-b" placeholder="Search MD" data-value="1">
										</div>

										<div class="col-md-3 pad-0">
											<button class="form-control darkblue-btn darkblue-bg btn_search2_1 btn_search" day="2" data-value="1" style="margin-bottom:5px"><span class="glyphicon glyphicon-search"></span></button>
										</div>
										
										
										<div class="doctors2_1 doctorsDropdown" data-value="1" style="display:none">

										</div>

									</div>



									<div class="col-md-3 towns">
										<span class="towns_label_2 towns2_1"></span>
									</div>



									<div class="col-md-1"></div>

									<div class="col-md-1">
										<span class="glyphicon glyphicon-remove-circle remove_itenerary2 remove-icon" btnum="1"></span>
									</div>
								</div>
							</div>

						<!-- </div> -->



						<?php $count_day_2++; }  ?>





					<!-- </div> -->

				</div>



			<?php } ?>



			


			</div>


			

			



			<input type="hidden" class="hidden_count_day_2" value="<?=$count_day_2;?>">

			</div>

			<div class="col-md-12 div_buttons pad-0" style="margin-top:20px;">

				<!-- <a href="<?=base_url();?>Ojl_schedule" class="darkblue-bg darkblue-btn btn_cancel2" style="text-align:center">Cancel</a> -->
 
				<div class="col-md-6 pad-0">
					<p style="margin-bottom:0px"><i>Submit - submit the entire plan </i></p>
					<p><i>Save as draft - save the entire plan as draft</i></p>
				</div>

				<div class="col-md-6 pad-0">
					<a class="darkblue-bg darkblue-btn btn_cancel2" style="">Cancel</a>
					<button class="darkblue-bg darkblue-btn btn_sumbit2" style="margin-right:5px;" btype="0">Save as Draft</button>
					<a class="darkblue-bg darkblue-btn btn_sumbit2" btype="1" style="margin-right:5px;">Submit</a>

					<?php if($status != 0) { ?>
						<a href="<?=base_url();?>sales_plan_for_the_month?id=<?=$this->session->userdata('agenda_id');?>" class="darkblue-bg darkblue-btn btn_next2" btype="1" style="margin-right:5px;display:none">Next</a>
					<?php } else { ?>
						<a href="<?=base_url();?>sales_plan_for_the_month" class="darkblue-bg darkblue-btn btn_next2" btype="1" style="margin-right:5px;display:none">Next</a>
					<?php } ?>
				</div>

				

				

			</div>



			<div class="col-md-6 for_add" style="display:none">



			</div>



			<div class="col-md-6 for_delete" style="display:none">



			</div>





		</div>

	</div>



</div>