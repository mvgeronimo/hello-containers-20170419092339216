<style type="text/css">

	.prog_agenda {

		color:blue;

	}

	.footer1 {
		background-image: url(../assets/images/footer2.png);
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}

	.footer-login {
		margin-top: 0.35%;
	}



	.margintop-10 {

		margin-top:10px;

	}

	.psr, .territory {

		height: 25px !important;

		padding: 0px !important;

	}

	.btn-save, .to_homes {

		border:none;

		padding-top: 5px;

		padding-bottom: 5px;

		padding-right: 20px;

		padding-left: 20px;

	}



	.asterisk {

		color:red;

	}

</style>



<?php if($AgendaType == 2) {





		foreach($agenda as $value) {

	 		$agenda_id = $value->agenda_id;

	 		$dm = $value->dm;



	 		$date_from = $value->date_from;

	 		$datefrom = date_create($date_from);

	 		$day1 = date_format($datefrom, 'F d, Y');

	 		$datefrom = date_format($datefrom, 'F d');

	 		

	 		$date_to = $value->date_to;

	 		$dateto = date_create($date_to);

	 		$day2 = date_format($dateto, 'F d, Y');

	 		$dateto = date_format($dateto, 'd, Y');

	 		

	 		$date_of_ojl = $datefrom.'-'.$dateto;



	 		$psr = $value->psr_name;

	 		$territory = $value->territory_name;

	 		$salary = $value->salary;

	 		$competency = $value->competency_standards;



		 }

	}

?>





<input type="hidden" class="hidden_empid" value="<?=$this->session->userdata('emp_id');?>">

<div class="col-md-12 col-sm-12 create_div" style="background-color:white">

	<input type="hidden" class="input_next_id">

	<?php //include('progress.php'); ?>





	<div class="col-md-2 col-sm-3 progress_div"> <?php include('progress.php'); ?> </div>



	<div class="col-md-10 col-sm-9 pad-0">



		<div class="col-md-12 pad-0 agenda_div"> <!-- div for agenda -->

			<div class="col-md-12 pad-0">

				<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE > CREATE NEW</p>

				<p class="darkblue-font page_title">AGENDA</p>

			</div>



			<div class="col-md-12 pad-0" style="text-align:right">

				<button class="darkblue-bg btn-prev" style="width:20%;border:none">View Previous Agreement</button>

			</div>



			<div class="col-md-12 pad-0">

				<div class="col-md-6 pad-0 margintop-10" style="">

					<div class="col-md-4 pad-0">

						<b>Name of DM: </b>

					</div>



					<div class="col-md-6 pad-0">

						<?php if($AgendaType == 2) { ?>

							<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?=$dm;?></p>

						<?php } else { ?>

							<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?php echo $this->session->userdata('firstname').' '.$this->session->userdata('lastname'); ?></p>

						<?php } ?>



					</div>



					<div class="col-md-2"></div>



					<div class="col-md-4 pad-0 margintop-10">

						<b>Name of PSR: </b> <b class="asterisk">*</b>

					</div>



					<div class="col-md-6 pad-0 margintop-10">

						<select class="form-control psr">

							<option value="">-- Select PSR --</option>

						<!-- 	<?php foreach($psr as $key => $c) { ?>

								<option value="<?= $c->psr_id; ?>"><?= $c->psr_name; ?></option>

							<?php } ?> -->

						</select> 

					</div>



					<div class="col-md-2"></div>



					<div class="col-md-4 pad-0 margintop-10">

						<b>Salary Grade: </b>

					</div>



					<div class="col-md-6 pad-0 margintop-10">

						<b class="salary_grade_b">&nbsp;</b>

					</div>



					<div class="col-md-2"></div>



					<div class="col-md-4 pad-0 margintop-10">

						<b>Territory: </b>

					</div>



					<div class="col-md-6 pad-0 margintop-10">

						<!-- <select class="form-control territory">

							<?php foreach($territory as $key => $c) { ?>

								<option value="<?= $c->territory_id; ?>"><?= $c->territory_name; ?></option>

							<?php } ?>

			

						</select> -->

						<span class="territory"></span> 

					</div>



					<div class="col-md-2"></div>





				</div>



				<div class="col-md-6 pad-0">

					<div class="col-md-2"></div>

					<div class="col-md-4 pad-0 margintop-10">

						<b>Date From: </b>

					</div>



					<div class="col-md-6 pad-0 margintop-10">

						<?php include('date_from.php'); ?>

					</div>



					

					<div class="col-md-2"></div>

					<div class="col-md-4 pad-0 margintop-10">

						<b>Date To: </b>

					</div>

					<input type="hidden" value="1" id="createType" />

					<div class="col-md-6 pad-0 margintop-10">

					 <?php include('date_to.php'); ?>

					</div>



					

					<div class="col-md-2"></div>

					<div class="col-md-4 pad-0 margintop-10">

						<b>Competency Standard: </b><b class="asterisk">*</b>

					</div>



					<div class="col-md-6 pad-0 margintop-10">

						<!-- <input type="text" class="form-control" id="competency_standards"> -->

						<b id="competency_standards"></b>

					</div>



					



				</div>



			</div>



			<!-- div for business people-->



			<div class="col-md-12 pad-0" style="margin-top:25px;">

				<div class="col-md-12 pad-0 margintop-10">



					<div class="col-md-5 darkblue-bg" style="padding:5px">AGENDA</div>



					<div class="col-md-7 darkblue-bg" style="padding:5px">SPECIFIC ACTION PLANS</div>

				</div>



				<div class="col-md-12 pad-0 business_development_cont">



					<div class="col-md-12 pad-0">

						<div class="col-md-5" style="margin-top:15px">

							<div class="col-md-7 pad-0">

								<p class="darkblue-font" style="font-size:16px"><b>BUSINESS DEVELOPMENT</b></p>

							</div>

							

							<div class="col-md-5 pad-0" style="text-align:right">

								<a class="add_agenda darkblue-font" style="cursor:pointer"><b>ADD</b></a> 

							</div>

						</div>



						<div class="col-md-7" style="margin-top:15px">

							

						</div>

					</div>



					<div class="col-md-12">

						<!-- <div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px">

							

						</div> -->

					</div>

					<input type="hidden" id="businessCounter" value="1"/>

						<input type="hidden" id="offSetBusinessCounter" value="0"/>

					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="businessAgendaDraft">

						

					</div>





				<form id="agenda_business_form">

					<div class="agenda_cont">

						<div class="col-md-12 business_1">

							<div class="col-md-5" style="">

								<div class="col-md-10" style="padding:0px">

									<select name="agd_business[]" class="agenda_name form-control agd_1">

									<?php foreach($dropdown as $key => $value) { 

										if ($value->agenda_type == 1) { ?>

									<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>

									<?php } } ?>

									</select>

								</div>



								<div class="col-md-2">

									<a class=" minus_agenda" btn-num="1" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">

										<i>Delete</i>

									</a>

								</div>

							</div>



							<div class="col-md-7" style="">

								<input type="text" name="action_business[]" class="action_text action_plan_1 form-control" placeholder="Action Plan">

							</div>

						</div>



					</div>

				</form>

					<!-- <div class="col-md-12">

						<div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px;text-align:right">

							<button class="btn btn-primary save_businessDraft" data-val="1">Save</button> 

						</div>

					</div> -->



				</div>





				<div class="col-md-12 people_development_cont pad-0" style="margin-top:15px">



					<div class="col-md-12 pad-0">

						<div class="col-md-5" style="margin-top:15px">

							<div class="col-md-7 pad-0"><p class="darkblue-font" style="font-size:16px"><b>PEOPLE DEVELOPMENT</b></p></div>

							<div class="col-md-5 pad-0" style="text-align:right"><a class="add_people_agenda darkblue-font" style="cursor:pointer"><b>ADD</b></a></div>

						</div>



						<div class="col-md-7" style="margin-top:15px">

							

						</div>

					</div>



					<div class="col-md-12">

				<!-- 		<div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px">

							

						</div> -->

					</div>

					<input type="hidden" id="peopleCounter" value="1"/>

					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="peopleAgendaDraft">

						

					</div>

				<form id="agenda_ppl_form">

					<div class="people_cont">

						<div class="col-md-12 ppl_1">



							<div class="col-md-5" style="">

								<div class="col-md-10" style="padding:0px">

									<!--<input type="text" class="agenda_name_people_1 form-control" placeholder="Agenda">!-->

									<select name="agd_ppl[]" class="agenda_name_people_1 form-control">

									<?php foreach($dropdown as $key => $value) { 

										if($value->agenda_type == 2) { ?>

									<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>

									<?php } } ?>

									</select>

								</div>



								<div class="col-md-2">

									<a class="minus_ppl_agenda" btn-num="1" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">

										<i>Delete</i>

									</a>

								</div>

								

							</div>



							<div class="col-md-7" style="">

								<input type="text" name="action_ppl[]" class="people_text action_plan_people_1 form-control" placeholder="Action Plan">

							</div>

						</div>



					</div>

				</form>

					<!-- <div class="col-md-12">

						<div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px;text-align:right;margin-bottom:20px">

							<button class="btn btn-primary save_peopleDraft" data-val="2">Save</button> 

						</div>

					</div> -->





				</div>



				



			</div>



			<!-- end of business people -->

		</div> <!-- end for agenda -->





	</div>



	





	<div class="col-md-12 col-sm-12 hbtn" style="text-align:right; margin-top:20px;margin-bottom:20px">

			<button class="darkblue-bg to_homes" style="margin-right:10px">Home</button> <button class="darkblue-bg btn-save" is-new="0">Next</button> 

		</div>



  <div class="col-md-12" style="text-align:right;display:none">

    <button class="btn btn-primary btn-save">Save</button>

  </div>



</div>





<div class="modal prev_modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog modal-lg" style="width:70%">

    <div class="modal-content">

    	<div class="col-md-12" style="background-color:white">

    		<div class="col-md-12 darkblue-bg darkblue-btn" style="margin-top:25px;"><b>EVALUATION, AGREEMENTS AND DIRECTIONS</b></div>

			

    		<div class="col-md-12 pad-0">

    			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DISTRICT MANAGER'S ACTION PLAN</b></div>



    			<div class="col-md-12 pad-0">

					<textarea style="width:100%" rows="5" class="dm_action_plan" disabled></textarea>

				</div>



				<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> 

				

				<div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);margin-top:10px;">

					<p class="dm_date"></p><p class="dm_to"></p> 



				</div> -->

    		</div>

			



    		<div class="col-md-12 pad-0">

    			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>PSR'S ACTION PLAN</b></div>



    			<div class="col-md-12 pad-0">

					<textarea style="width:100%" rows="5" class="psr_action_plan" disabled></textarea>

				</div>



    			<!-- <div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>DATE RANGE</b></div> 



    			



				<div class="col-md-12 pad-0" style="padding: 15px 0px 0px 0px;border: 1px solid rgb(169, 169, 169);margin-top:10px;">

					<p class="psr_date"></p>



				</div>-->

    		</div>





			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>OM'S REMARKS</b></div>



			<div class="col-md-12 pad-0">

				<textarea style="width:100%" rows="5" class="om_action_plan" disabled></textarea>

			</div>



			<div class="col-md-12 darkblue-bg darkblue-btn" style="background-color:#6c6c6c;margin-top:10px;"><b>ISSUES AND CONCERNS</b></div>



			<div class="col-md-12 pad-0" style="margin-bottom:10px;">

				<textarea style="width:100%" rows="5" class="issues_concerns" disabled></textarea>

			</div>



			<div class="col-md-12 pad-0">

				<table class="table table-responsive" style="padding:5px;text-align:center">

					<tr>

						<td>

							<p class="prev_dm"></p>

							<p><b>Prepared and Approved</b></p>

						</td>

						<td><p class="prev_dm_date"></p><b>Date</b><p></p></td>

					</tr>

					<tr>

						<td>

							<p class="prev_psr"></p>

							<p><b>Submitted</b></p>

						</td>

						<td><p class="prev_psr_date"></p><b>Date</b><p></p></td>

					</tr>

					<tr>

						<td>

							<p class="prev_om"></p>

							<p><b>Acknowledged</b></p>

						</td>

						<td><p class="prev_om_date"></p><b>Date</b><p></p></td>

					</tr>

				</table>

			</div>



			<div class="col-md-12 pad-0" style="margin-bottom:10px;">

				<input type="checkbox" class="agree_check" value=""> I have read the previous agreements. &nbsp;<button class="darkblue-bg btn_close_modal" style="border:none;display:none">Okay</button> 

			</div>



    	</div>

     	

    </div>

  </div>



  <input type="hidden" class="is_agree" value="">

</div>



<script>

 $(document).ready(function() {

 	var empid = $('.hidden_empid').val();





 	$('.agree_check').change(function() {

 		var is_agree_id = $('.is_agree').val();

        if($(this).is(":checked")) {

            $(this).val(1);

            $('#psr_drop_'+is_agree_id).attr('is_agree', 1);

            $('.btn_close_modal').show();

        } else {

        	$(this).val(0);

        	 $('#psr_drop_'+is_agree_id).attr('is_agree', 0);

        	$('.btn_close_modal').hide();

        }

              

    });



 	$('.btn_close_modal').click(function() {

 		$('.prev_modal').modal('toggle');

 	})





 	$('.btn-prev').click(function() {

 		var psr_id = $('.psr').val();

 		var agreed = $('#psr_drop_'+psr_id).attr('is_agree');

 		if(agreed == 1) {

 			$('.agree_check').prop('checked', true);

 		} else {

 			$('.agree_check').prop('checked', false);

 		}

 	})



 	$('.loader').show();

	$.ajax({

	     type:'get',

	     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',

	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid':empid}

	    }).done(function(result) {

	    	var htm = '';

	    	var htm2 = '';

	    	$.each(result, function(x,y) {

	    		$.each(y, function(a,b) {

	    			if (a != 'EmployeeID' && a != 'Fullname' && a != 'Description') {

	    				htm += '<option id="psr_drop_'+b.EmployeeID+'" value="'+b.EmployeeID+'" is_agree="0">'+b.Fullname+'</option>';

	    				//htm2 += '<option value="'+b.EmployeeID+'">'+b.Description+'</option>';

	    			}

	    		})

	    	})

	    	$('.psr').append(htm);

	    	$('.loader').hide();

	    //	$('.territory').append(htm2);

	    })



	    $('.psr').on('change', function() {

	    	var psr_id = $(this).val();





	    	$.ajax({

			     type:'get',

			     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',

			     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid':empid}

			    }).done(function(result) {

			    	var htm = '';

			    	var htm2 = '';

			    	$.each(result, function(x,y) {

			    		$.each(y, function(a,b) {

			    			if (a != 'EmployeeID' && a != 'Fullname' && a != 'Description') {

			    				if(b.EmployeeID == psr_id) {

			    					htm = b.Description;

			    				}

			    				//htm2 += '<option value="'+b.EmployeeID+'">'+b.Description+'</option>';

			    			}

			    			$('.is_agree').val(psr_id);



			    		})

			    	})



			    	

			    	$('.territory').html(htm);

			  

			    })





	    })







	$(document).on('click', '.save_businessDraft', function() {

		// alert($('.agenda_cont').text());

		// alert('a');

	var counter = $('#businessCounter').val();

	var divBusinness = '';

	// var a = 1;

	for(a=1;a<=counter;a++)

	{

		var agd = $('.agd_'+a).val();

		var agdText = $(".agd_"+a+" option[value='"+agd+"']").text()

		

		var actionPlan = $('.action_plan_'+a).val();

		if(actionPlan != '' && typeof actionPlan != 'undefined')

		{

			

			divBusinness += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';

				divBusinness += agdText;

				divBusinness += '</div>';

				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';

				divBusinness += actionPlan;

				divBusinness += '</div>';

			divBusinness += '</div>';

				$('.business_'+a).hide();

		$('.save_businessDraft').hide();

		}

	

			// alert(divBusinness);

	}

	$('#businessAgendaDraft').html(divBusinness);

	

	

	});

	

	

	$(document).on('click', '.save_peopleDraft', function() {

	var counter = $('#peopleCounter').val();

	// var a = 1;

	var divBusinness = '';

	for(a=1;a<=counter;a++)

	{

		var agd = $('.agenda_name_people_'+a).val();

		var agdText = $(".agenda_name_people_"+a+" option[value='"+agd+"']").text()



		var actionPlan = $('.action_plan_people_'+a).val();

		if(actionPlan != '' && typeof actionPlan != 'undefined')

		{

			

			divBusinness += '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';

				divBusinness += agdText;

				divBusinness += '</div>';

				divBusinness += '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">';

				divBusinness += actionPlan;

				divBusinness += '</div>';

			divBusinness += '</div>';

			$('.save_peopleDraft').hide();

			$('.ppl_'+a).hide();

		}

		

	}

	$('#peopleAgendaDraft').html(divBusinness);

			

		

	});

	

	

	$(document).on('click', '.to_itenerarySave', function() {

	var businessAgendaDiv = $('.agenda_cont').text();

	var peopleAgendaDiv = $('.people_cont').text();

	if(businessAgendaDiv.trim() != '' || peopleAgendaDiv.trim() != '')

	{

		alert('Please Save All Pending Agenda First!');

	}

	

	});

	

 });

</script>



<?php include 'custom-js.php'; ?>