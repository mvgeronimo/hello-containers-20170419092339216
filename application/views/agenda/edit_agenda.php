<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<style type="text/css">

	.prog_agenda {

		color:blue;

	}





	.margintop-10 {

		margin-top:10px;

	}

	.psr, .territory {

		height: 25px !important;

		padding: 0px !important;

	}

	.a_disabled {

		pointer-events:none;

	}
	.agenda_cont .agenda_cont2, .people_cont .people_cont2 {
		margin-top: 15px;
	}
	.agenda_cont .agenda_cont2:first-child, .people_cont .people_cont2:first-child{
		margin-top: 0px !important;
	}

	.ui-datepicker-prev, .ui-datepicker-next {
    display: none !important;
  }





</style>





<?php



	// echo '<pre>';

	// print_r($action_plan);





		foreach($agenda as $value) {

	 		$agenda_id = $value->agenda_id;

	 		$dm = $value->dm;

	 		$psr_id = $value->psr_id;



	 		$date_to = $value->date_to;

	 		$date_from = $value->date_from;



	 		$new_version_button = '';

	 		$now = date('Y-m-d');

	 		if($date_from <= $now && $date_to >= $now) {

	 			$new_version_button = 1;

	 		}

	 		

	 		$datefrom = date_create($date_from);

	 		$date_from_edit = date_format($datefrom, 'm/d/Y');

	 		$day1 = date_format($datefrom, 'F d, Y');

	 		$datefrom = date_format($datefrom, 'F d');

	 		$agenda_status = $value->status;



	 		

	 		$dateto = date_create($date_to);

	 		$date_to_edit = date_format($dateto, 'm/d/Y');

	 		$day2 = date_format($dateto, 'F d, Y');

	 		$dateto = date_format($dateto, 'd, Y');



	 		

	 		$date_of_ojl = $datefrom.'-'.$dateto;



	 		$psr = $value->psr_name;

	 		$territory = $value->territory;

	 		$salary = $value->salary;

	 		$competency = $value->competency_standards;



		 }

	

?>





<script type="text/javascript">

$(document).ready(function() {

	$('.i').addClass('activePage');

	$('#date_from').val('<?=$date_from_edit;?>');

	$('#date_to').val('<?=$date_to_edit;?>');

	var hasFocus = $('foo').is(':focus');
	var date = new Date();
	date.setDate(date.getDate() + 1);

	// $('.search_text').keypress(function(e) {
	//     if(e.which == 13) {
	//         alert('You pressed enter!');
	//     // $("#go").click();
	//     }
	// });



	var agenda_id = $('.hidden_agenda').val();

	var count_agenda = $('.hidden_count_agenda').val();

	var count_people = $('.hidden_count_people').val();



	$.ajax({

		type:'post',

		url:'<?=base_url();?>Agenda/check_stat',

		data:{'agenda_id':agenda_id}

	}).done(function(result) {

		var obj = JSON.parse(result);



		$.each(obj, function(x,y) {

			$('.hidden_status').val(y.status);

			if(y.status != 0) {

				

				$("#agenda_form :input").attr("disabled", true);

				$('.btn_new_version').attr("disabled", false);

				$(".minus_agenda").addClass("a_disabled");

				$(".minus_ppl_agenda").addClass("a_disabled");

				$('.add_agenda').addClass("a_disabled");;

				$('.add_people_agenda').addClass("a_disabled");

			}

		})

	})


	 $('#date_from').on('change', function() {
     
       var date1 = $('#date_from').datepicker('getDate');
       var day = date1.getDay();


      var date_from = new Date($(this).val());
      var start = date_from;

      if(day == 5) {
         date_from.setDate(date_from.getDate() + 3);
       } else {
        date_from.setDate(date_from.getDate() + 1);
       }
      
      var span_date_from = date_from.setDate(date_from.getDate());

      var d = new Date();

     if(date_from < d) {
      bootbox.alert('<b>Past date cannot be selected. Please select present or future date.</b>');
      $('#date_from').val($.datepicker.formatDate('mm/dd/yy', d));
      $('#date_to').val($.datepicker.formatDate('mm/dd/yy', d));
     } else {
      $('#date_to').val($(this).val());
      $('.span_date_from').html($.datepicker.formatDate('mm/dd/yy', start));
     }

      
    })

	 $('#date_to').on('change', function() {
      var date1 = $('#date_to').datepicker('getDate');
       var day = date1.getDay();

      var date_to = new Date($(this).val());

      if(day == 1) {
        date_to.setDate(date_to.getDate() - 3);
      } else {
        date_to.setDate(date_to.getDate() - 1);
      }
      

      var d2 = new Date();
      var d = d2.getFullYear()+'-'+(d2.getMonth()+1)+'-'+d2.getDate();  

      //alert($(this).val()+' '+d);

      $.ajax({
        type:'post',
        url: '<?=base_url();?>Ojl_schedule/checktime',
        data:{"date_to":$(this).val(), "date_now":d}
      }).done(function(result) {
         if(result == '1') {
        bootbox.alert('<b>Past date cannot be selected. Please select present or future date.</b>');
        $('#date_to').val($.datepicker.formatDate('mm/dd/yy', date));
       } else if(result == '2') {
          $('#date_from').val($.datepicker.formatDate('mm/dd/yy', d2));
          $('.span_date_to').html($.datepicker.formatDate('M dd yy', d2));
       } else {
          $('#date_from').val($.datepicker.formatDate('mm/dd/yy', date_to));
          $('.span_date_to').html($.datepicker.formatDate('M dd yy', date_to));
       } 
      })
     
     
    })



	$('.btn_new_version').click(function(e) {

		e.preventDefault();

			

		window.location = '<?=base_url();?>ojl_schedule/new_version/'+agenda_id;

	})

		 var somethingChanged = 0; 

		$('input').change(function() { 

	        somethingChanged = 1; 

	   }); 



	$('.btn-save').click(function() {

			$('.loader').show();

			var dm = $('.p_dm').html();

	        var psr_id = $('.psr').val();

	        var salary = $('.salary_grade_b').html();

	        var territory_id = $('.territory').val();

	        var date_from = $('#date_from').val();

	        var date_to = $('#date_to').val();

	        var consistency = $('#competency_standards').html();

	        var hidden_agenda = $('.hidden_agenda').val();



	        var status = $('.hidden_status').val();



	        if(status == 1) {

	        	$.ajax({

	        		type:'post',

	        		url:'<?=base_url();?>Agenda/change_agenda_session',

	        		data:{'agenda_id':hidden_agenda}

	        	}).done(function() {

	        		window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+hidden_agenda;

	        	})



	        	

	        } else {

	        	$.ajax({

		        	type:'post',

		        	url:'<?=base_url();?>Agenda/update_agenda',

		        	data:{"agenda_id": hidden_agenda, "dm":dm, "psr_id":psr_id, "salary":salary, "territory_id":territory_id, "date_from":date_from, "date_to":date_to, "consistency":consistency}

		        }).done(function() {



		        	$.ajax({

		        		type:'post',

		        		url:'<?=base_url();?>Agenda/delete_action_plan',

		        		data:{"table":"ojl_ActionPlan"}

		        	}).done(function(result) {

		        		update_step_2();

		        	})



		        })

	        }

		



		



        

	})



	$('.add_agenda').click(function() {

		var nulls = 0;
        $('.agenda_text2').each(function() {
          if($(this).val() == '') {
            nulls++;
          }
        });

		
		
		if(nulls>0){
			bootbox.alert("<b>Please fill out the missing fields.</b>");
		}
		else{
			$('.loader').show();
			var count_agenda = parseInt($('.hidden_count_agenda').val());

	       if(count_agenda < 3) {
		       	 
		        $('.hidden_count_agenda').val(count_agenda+1);
		        var last_agenda = parseInt($('.agenda_cont > .agenda_cont2:last').attr('attr-val'))+1;
		        //alert(last_agenda);
		   
		        count_agenda++;

		          var htm = '';

				  var select ='';

		          htm += '<div class="col-md-12 agenda_cont2 business_'+last_agenda+'" attr-val="'+last_agenda+'">';

		          htm += '<div class="col-md-5">';

		          htm += '<div class="col-md-10" style="padding:0px">';

		          // htm += '<input type="text" class="agenda_name form-control agd_'+count_agenda+'" placeholder="Agenda">';

				   htm += '<select name="agd_business[]" class="agenda_name form-control agd_'+last_agenda+'"></select>';

		          htm += '</div>';



		          htm += '<div class="col-md-2">';

		          htm += '<a class="minus_agenda" btn-num="'+last_agenda+'" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">';

		          htm += '<i>Delete</i>';

		          htm += '</a></div></div>';



		          htm += '<div class="col-md-7">';

		          htm += '<input type="text" name="action_business[]" class="agenda_text2 action_plan_'+last_agenda+' form-control" placeholder="Action Plan">';

		          htm += '</div></div>';





		          $('.agenda_cont').append(htm); 

					$('#businessCounter').val(count_agenda);

					//$('.hidden_count_people').val(count_agenda);

					$('.save_businessDraft').show();

				   $.ajax({

		                url: '<?php echo base_url(); ?>ojl_schedule/getDataTable',

		                type: 'post',

		                data: { table: 'ojl_agenda_name',where:'is_active = 1' },

		                success:function(msg){

						var obj = JSON.parse(msg);

						$.each(obj,function(a,b){

							if(b.agenda_type == 1) {

								select += '<option value="'+b.agenda_name_id+'">'+b.agenda_name+'</option>';

							}

							

						});

						// alert('agenda_name_people_'+count_people);

						$('.agd_'+last_agenda).append(select);

						



						$('.loader').hide();

						

						

		                }

		            });	



	       } else {
	       		bootbox.alert("<b>A maximum of 3 items per category can be selected.</b>");
	          $('.loader').hide();
	       }
 		}
 		//
    })



 $('.add_people_agenda').click(function() {

 	var nulls = 0;
    $('.people_text2').each(function() {
      if($(this).val() == '') {
        nulls++;
      }
    });

	
	if(nulls>0){
		bootbox.alert("<b>Please fill out the missing fields.</b>");
	}
	else{
 	$('.loader').show();
 	var count_people = parseInt($('.hidden_count_people').val());

		if(count_people < 3) {
			$('.hidden_count_people').val(count_people+1);

			var last_people = parseInt($('.people_cont > .people_cont2:last').attr('attr-val'))+1;
			count_people++;

	          var htm = '';

			  var select = '';

	          htm += '<div class="col-md-12 people_cont2 ppl_'+last_people+'" attr-val="'+last_people+'">';

	          htm += '<div class="col-md-5">';

	          htm += '<div class="col-md-10" style="padding:0px">';

			  htm += '<select name="agd_ppl[]" class="agenda_people agenda_name_people_'+last_people+' ppl_'+last_people+' form-control"></select>';

	          //htm += '<input type="text" class="agenda_name_people_'+count_people+' ppl_'+count_people+' form-control" placeholder="Agenda">';

	          htm += '</div>';



	          htm += '<div class="col-md-2">';

	          htm += '<a class="minus_ppl_agenda" btn-num="'+last_people+'" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">';

	          htm += '<i>Delete</i>';

	          htm += '</a>';

	          htm += '</div></div>';



	          htm += '<div class="col-md-7">';

	          htm += '<input type="text" name="action_ppl[]" class="people_text2 action_plan_people_'+last_people+' form-control" placeholder="Action Plan">';

	          htm += '</div></div>';



	          $('.people_cont').append(htm);

			  $('#peopleCounter').val(count_people);

			  //$('.hidden_count_agenda').val(count_people);

			  $('.save_peopleDraft').show();

			  

			    $.ajax({

	                url: '<?php echo base_url(); ?>ojl_schedule/getDataTable',

	                type: 'post',

	                data: { table: 'ojl_agenda_name',where:'is_active = 1' },

	                success:function(msg){

					var obj = JSON.parse(msg);

					$.each(obj,function(a,b){

						if(b.agenda_type == 2) {

							select += '<option value="'+b.agenda_name_id+'">'+b.agenda_name+'</option>';

						}

					});

					// alert('agenda_name_people_'+count_people);

					$('.agenda_name_people_'+last_people).append(select);



				

					$('.loader').hide();

					

	                }

            });	


		} else {

			bootbox.alert("<b>A maximum of 3 items per category can be selected.</b>");
            $('.loader').hide();

		}       
	}
     //



  })


 	$(document).on('click', '.minus_agenda', function(e) {
	//$('.minus_agenda').click(function(e) {
		var agenda_val = parseInt($('.hidden_count_agenda').val());		

		e.preventDefault();

		var busines_no = $(this).attr('btn-num');

		if($('.action_plan_'+busines_no).val() != '') {
			bootbox.confirm("<b>Are you sure you want to delete this item?", function(r) {

				if(r) {
					if(agenda_val==1){
						$('.agenda_text2').val('');
					}
					else{
						$('.hidden_count_agenda').val(agenda_val-1);
		        		$('.business_'+busines_no).remove();
					}
					
		        }

			})
		} else {
			if(agenda_val != 1) {
				$('.hidden_count_agenda').val(agenda_val-1);
		    	$('.business_'+busines_no).remove();
			}
			
		}

		

		

	})

	$(document).on('click', '.minus_ppl_agenda', function(e) {

	//$('.minus_ppl_agenda').click(function(e) {

		e.preventDefault();

		var people_val = parseInt($('.hidden_count_people').val());	

		var people_no = $(this).attr('btn-num');

		if($('.action_plan_people_'+people_no).val() != '') {
			bootbox.confirm("<b>Are you sure you want to delete this item?", function(r) {
				if(r) {
					if(people_val==1){
						$('.people_text2').val('');
					}
					else{
						$('.hidden_count_people').val(people_val-1);
	            		$('.ppl_'+people_no).remove();
					}
					
	            }
			})
		} else {
			
			if(people_val!=1){
				$('.hidden_count_people').val(people_val-1);
	        	$('.ppl_'+people_no).remove();
	        }
		}

		

		

	})



	function update_step_2() {

		var count_agenda = $('.hidden_count_agenda').val();

		$('.agenda_cont').children('.agenda_cont2').each(function (){
			var agenda_name_id = $(this).find('.agenda_name').val();
			var specific_plans = $(this).find('.agenda_text2').val();
			$.ajax({

    			type:'post',

    			url:'<?=base_url();?>Agenda/update_business',

    			data:{"agenda_name_id":agenda_name_id, "specific_plans":specific_plans,"type":1}

    		}).done(function(result) {

    		})
    		
		});
		update_step_3();
	}



	function update_step_3() {

		//alert(count_people);
		var count_people = $('.hidden_count_people').val();
		$('.people_cont').children('.people_cont2').each(function (){
			var agenda_name_id = $(this).find('.agenda_people').val();
			var specific_plans = $(this).find('.people_text2').val();
			$.ajax({
    			type:'post',
    			url:'<?=base_url();?>Agenda/update_business',
    			data:{"agenda_name_id":agenda_name_id, "specific_plans":specific_plans,"type":2}
    		}).done(function(result) {			

    		})
    	});


		$('.loader').hide();

		var agenda_id = $('.hidden_agenda').val();

		if(somethingChanged == 0) {

			window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+agenda_id;

		} else {
			
			bootbox.alert("<b>Agenda has been successfully updated.</b>", function() {

        		window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+agenda_id;

        	});

		}

       
	}



	



	$(document).on('click', '.save_businessDraft', function() {

		// alert($('.agenda_cont').text());

		// alert('a');

	var counter = $('.hidden_count_people').val();

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

	var counter = $('.hidden_count_people').val();

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



	var empid = $('.hidden_dm').val();

	var ps_r = $('.hidden_psr').val();


	$('.loader').show();
	$.ajax({

	     type:'get',

	     url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',

	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid':empid}

	    }).done(function(result) {

	    	var htm = '';

	    	var htm2 = '';

	    	$.each(result, function(x,y) {

	    		$.each(y, function(a,b) {

	    			if (a != 'EmployeeID' && a != 'Fullname' && a != 'Description') {



	    				if(b.EmployeeID == ps_r) {

	    					htm += '<option value="'+b.EmployeeID+'" selected>'+b.Fullname+'</option>';

	    				} else {

	    					htm += '<option value="'+b.EmployeeID+'">'+b.Fullname+'</option>';

	    				}

	    				

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

			     url:'http://abig.unilab.ph/WebAPI_BiomedisOJL/api/partialterritorialconfig/Get',

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

			    		})

			    	})

			    	$('.territory').html(htm);

			  

			    })





			    $.ajax({

			        type:'post',

			        url:'<?=base_url();?>Ojl_schedule/get_salary',

			        data:{'psr_id':psr_id}

			      }).done(function(result) {

			        var obj = JSON.parse(result);



			        $.each(obj, function(x,y) {

			          

			          $('.salary_grade_b').html(y.salary_grade);

          				$('#competency_standards').html(y.competency);

			        })

			      })









	    })

	





})

</script>

<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>







<input type="hidden" class="hidden_psr" value="<?=$psr_id;?>">

<input type="hidden" class="hidden_dm" value="<?=$this->session->userdata('emp_id');?>">

<input type="hidden" class="hidden_agenda" value="<?=$this->uri->segment(3);?>">

<input type="hidden" class="hidden_status" value="">



<div class="edit_div col-md-12 col-sm-12" style="background-color:white">

	<input type="hidden" class="input_next_id">

	<div class="col-md-2 col-sm-3 progress_div">

		<?php $this->load->view('schedule/progress.php'); ?>

	</div>

	

	<form id = "agenda_form"> <!-- Start of Agenda form -->

		<div class="col-md-10 col-sm-9 agenda_div">

			<div class="col-md-12 pad-0">

				<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE > EDIT AGENDA</p>

				<p class="darkblue-font page_title">AGENDA</p>

			</div>



			<div class="col-md-12">



				<div class="col-md-12 pad-0" style="text-align:right">

					<?php if($agenda_status == 1 && $new_version_button == '') {?>

					<button class="darkblue-bg btn_new_version" style="width:20%;border:none">New Version</button>

					<?php } ?>

				</div>

				



				<div class="col-md-6 pad-0 margintop-10" style="">

						<div class="col-md-4 pad-0">

							<b>Name of DM: </b>

						</div>



						<div class="col-md-6 pad-0">

							<p class="p_dm" dm="<?php echo $this->session->userdata('username'); ?>"><?=$dm;?></p>

						</div>



						<div class="col-md-2"></div>



						<div class="col-md-4 pad-0 margintop-10">

							<b>Name of PSR: </b>

						</div>



						<div class="col-md-6 pad-0 margintop-10">

							<select class="form-control psr">

								

							</select> 

						</div>



						<div class="col-md-2"></div>



						<div class="col-md-4 pad-0 margintop-10">

							<b>Salary Grade: </b>

						</div>



						<div class="col-md-6 pad-0 margintop-10">

							<b class="salary_grade_b"><?=$salary;?></b>

						</div>



						<div class="col-md-2"></div>



						<div class="col-md-4 pad-0 margintop-10">

							<b>Territory: </b>

						</div>



						<div class="col-md-6 pad-0 margintop-10">

							<span class="territory"><?=$territory;?></span>

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

							<b>Competency Standard: </b>

						</div>



						<div class="col-md-6 pad-0 margintop-10">

							<!-- <input type="text" class="form-control" id="competency_standards" value="<?=$competency;?>"> -->

							<b id="competency_standards"><?=$competency;?></b>

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
<!-- 
						<div class="col-md-5" style="margin-top:15px">

							

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



				<?php $x = 1; $count_business = 0;

					foreach($action_plan as $val) { 

						if($val->actionPlanType == 1) { $count_business++; ?>

						<div class="col-md-12 agenda_cont2 business_<?=$x;?>" attr-val="<?=$x;?>">

							<div class="col-md-5">

								<div class="col-md-10" style="padding:0px">



										<select name="agd_business[]" class="agenda_name agenda_name_<?=$x;?> form-control agd_<?=$x;?>">

										<?php foreach($dropdown as $key => $value) { 



											if($value->agenda_type == 1) {





											if($val->agenda_name_id == $value->agenda_name_id) {

												

										?>

											<option value="<?php echo $value->agenda_name_id; ?>" selected><?php echo $value->agenda_name; ?></option>

										<?php } else { ?>

											<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>

										<?php } } }?>

										</select>



									

								</div>



								<div class="col-md-2">

									<a class=" minus_agenda" btn-num="<?=$x?>" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">

										<i>Delete</i>

									</a>

								</div>

							</div>



							<div class="col-md-7">

								<input type="text" name="action_business[]" class="agenda_text2 action_plan_<?=$x;?> form-control" placeholder="Action Plan" value="<?= $val->specific_plans; ?>">

							</div>



							

						</div>



					<?php $x++;}  

						

					} ?>



						<input type="hidden" class="hidden_count_agenda" value="<?=$count_business;?>">



					</div>

				</form>

					<div class="col-md-12">

						<div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px;text-align:right">

							

						</div>
						<!-- <button class="btn btn-primary save_businessDraft" data-val="1">Save</button>  -->
					</div>



				</div>





				<div class="col-md-12 people_development_cont pad-0">



					<div class="col-md-12 pad-0">

						<div class="col-md-5" style="margin-top:15px">

							<div class="col-md-7 pad-0"><p class="darkblue-font" style="font-size:16px"><b>PEOPLE DEVELOPMENT</b></p></div>

							<div class="col-md-5 pad-0" style="text-align:right"><a class="add_people_agenda darkblue-font" style="cursor:pointer"><b>ADD</b></a></div>

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

					<input type="hidden" id="peopleCounter" value="1"/>

					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="peopleAgendaDraft">

						

					</div>

				<form id="agenda_ppl_form">

					<div class="people_cont">

						

			<?php $y = 1; $count_people = 0;

					foreach($action_plan as $val) { 

						if($val->actionPlanType == 2) { $count_people++; ?>

						<div class="col-md-12 people_cont2 ppl_<?=$y;?>" attr-val="<?=$y;?>">

							<div class="col-md-5">

								<div class="col-md-10" style="padding:0px">

									<!--<input type="text" class="agenda_name_people_1 form-control" placeholder="Agenda">!-->

									<select name="agd_ppl[]" class="agenda_people agenda_name_people_<?=$y;?> form-control">

									<?php foreach($dropdown as $key => $value) { 

										if($value->agenda_type == 2) { 

										if($val->agenda_name_id == $value->agenda_name_id) {

											

									?>

										<option value="<?php echo $value->agenda_name_id; ?>" selected><?php echo $value->agenda_name; ?></option>

									<?php } else { ?>

										<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>

									<?php } } } ?>

									</select>

								</div>



								<div class="col-md-2">

									<a class="minus_ppl_agenda" btn-num="<?=$y?>" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">

											<i>Delete</i>

										</a>

								</div>

								

							</div>



							<div class="col-md-7">

								<input type="text" name="action_ppl[]" class="people_text2 action_plan_people_<?=$y;?> form-control" placeholder="Action Plan" value="<?=$val->specific_plans;?>">

							</div>



							

						</div>



						<?php $y++; }  

							

						} ?>



						<input type="hidden" class="hidden_count_people" value="<?=$count_people;?>">



					</div>

				</form>

					<div class="col-md-12">

						<div class="col-md-5" style="margin-top:15px">

							

						</div>



						<div class="col-md-7" style="margin-top:15px;text-align:right">

							<!-- <button class="btn btn-primary save_peopleDraft" data-val="2">Save</button>  -->

						</div>

					</div>





				</div>



				



			</div>



			<!-- end of business people -->



		</div>



	</form> <!-- End of Agenda Form -->





	



	<div class="col-md-12" style="text-align:right;margin-bottom:15px;">

		<?php $this->load->view('home_button'); ?><button class="darkblue-bg darkblue-btn btn-save">Next</button> 

	</div>



    <div class="col-md-12" style="text-align:right;display:none">

    	<button class="btn btn-primary btn-save">Save</button>

    </div>





	

</div>