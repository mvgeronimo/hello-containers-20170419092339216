

<link href='<?=base_url()?>assets/calendar/fullcalendar.css' rel='stylesheet' />
<link href='<?=base_url()?>assets/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?=base_url()?>assets/calendar/moment.min.js'></script>

<script src='<?=base_url()?>assets/calendar/fullcalendar.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

	getEvents();

		function getEvents() {
			
			$.ajax({
				type: "POST",
				url: "<?=base_url()?>Ojl_schedule/get_Events",
				data: {}
			}).done(function(data) {

				var obj = jQuery.parseJSON(data);
				var eSources = [];

				$.each(obj, function(k, v){
					
					var title = v.title;

					var temp = [];
					var temp2 = {
						start: v.start,
						end: v.end,
						title: v.title,
						agenda_id: v.agenda_id,
						status: v.status,
						type: v.type,
						step: v.step,


					};


					temp.push(temp2);

					if(v.type==1) {
						if(v.status == 0) {
							var this_color = '#ffa500';
							var this_font = 'black';
						} else {
							var this_color = '#C71585';
							var this_font = 'white';
						}
						var tmp = {
							events: temp,
				            color: this_color,   // a non-ajax option
				            textColor: this_font, // a non-ajax option
				            className: v.id, 
						};
					} else {
						if(v.status == 0) {
							var this_color = '#ffa500';
							var this_font = 'black';
						} else {
							var this_color = '#ffff4c';
							var this_font = 'black';
						}

						var tmp = {
							events: temp,
				            color: this_color,   // a non-ajax option
				            textColor: this_font, // a non-ajax option
				            className: v.id, 
						};
					}

					

					eSources.push(tmp);


				});

				fullCalendar(eSources);

			});
		}

	$('.btn_create_sched').click(function() {

		window.location = '<?=base_url();?>ojl_schedule/create_new';
	})


	function fullCalendar(data) {

		
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
/*              defaultDate: '2016-06-12',*/
                editable: false,
                eventLimit: true, // allow "more" link when too many events
        		eventSources: data,
                // firstDay: 1,
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent);

                    

                    var title = calEvent.title;

                    var day = calEvent.start.toString();
                    var agenda_id = calEvent.agenda_id;
                    var status = calEvent.status;
                    var step = calEvent.step;

                    // alert(title+' '+status);

                    // if(status == 1) {
                    // 	 window.location = '<?=base_url();?>agenda/agenda_details/'+agenda_id;
                    // } else {
                    // 	 window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;
                    // }
                    
                     check_agenda(agenda_id, step);
                    //window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;
                   
                    //var ctr_string = $(this).attr('class');

                    

                }

            });
        }

        function check_agenda(agenda_id ,step) {
        	$.ajax({
        		type:'post',
        		url:'<?=base_url();?>Ojl_schedule/get_agenda_by_calendar',
        		data:{'agenda_id':agenda_id}
        	}).done(function(result) {
        		//alert(agenda_id+' '+step);
        		var obj = JSON.parse(result);
        		$.each(obj, function(x,y) {
        			// if(y.progress == 'new') {
        				if(y.step == 1) {
        					window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;
        					
        				} else if(step == 2) {
        					window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+agenda_id;
        				} else if(step == 3) {
        					window.location = '<?=base_url();?>Sales_plan_for_the_month?id='+agenda_id;
        				} else if(step == 4) {
        					window.location = '<?=base_url();?>Coverage_performance_monitoring?id='+agenda_id;
        				} else if(step == 6) {
        					window.location = '<?=base_url();?>Ojl_completion?id='+agenda_id;
        				} else if(step == 7) {
        					window.location = '<?=base_url();?>Ojl_completion/product_communication/?id='+agenda_id;
        				} else if(step == 8) {
        					window.location = '<?=base_url();?>Ojl_completion/survey_drugstore_pharmacies?id='+agenda_id;
        				} else if(step == 9) {
        					window.location = '<?=base_url();?>Ojl_completion/competitors_activity_report?id='+agenda_id;
        				} else if(step == 5) {
        					window.location = '<?=base_url();?>Ojl_completion/employee_compentency_development?id='+agenda_id;
        				} else if(step == 10) {
        					window.location = '<?=base_url();?>Ojl_completion/activity_and_starts_monitoring_sheet?id='+agenda_id;
        				} else if(step == 11) {
        					window.location = '<?=base_url();?>Ojl_evaluation?id='+agenda_id;
        				}
        			// } else if(y.progress == 'For Completion') {
        			// 	window.location = '<?=base_url();?>Ojl_completion';
        			// } 
        		})
        	})
        }


        $.ajax({
        	type:'post',
        	url:'<?=base_url();?>Ojl_schedule/get_today_agenda'
        }).done(function(result) {
        	
        	var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();

			var output = d.getFullYear() + '-' +
			    (month<10 ? '0' : '') + month + '-' +
			    (day<10 ? '0' : '') + day;

			    

        	var obj = JSON.parse(result);
        	var htm = '';
        	var htm2 = '';

        	var days = 0;

        	htm += '<div class="col-md-12 pad-0"> <b>Day 1</b> </div>';
        	htm2 += '<div class="col-md-12 pad-0"> <b>Day 2</b> </div>';
        	$.each(obj, function(x,y) {
        		if(y.day1 == output) {
        			days = 1;
        		} else {
        			days = 2;
        		}

        		

        		if(y.day == 1) {
        			htm += '<div class="col-md-12 pad-0">';
        				htm += '<p style="margin-bottom:0px"><b>Name of MD</b></p>';
        				htm += '<p style="margin-bottom:0px">'+y.doctor;+'</p>';
        				htm += '<p style="margin-bottom:0px"><b>Address</b></p>';
        				htm += '<p>'+y.doctor_address+'</p>';



        				// htm += '<div class="col-md-6 pad-0">'
        				// 	htm += y.doctor;
        				// htm += '</div>';

        				// htm += '<div class="col-md-6 pad-0">'
        				// 	htm += y.doctor_address;
        				// htm += '</div>';
        			htm += '</div>';
        		} else {
        			htm2 += '<div class="col-md-12 pad-0">';
        				htm2 += '<div class="col-md-6 pad-0">'
        					htm2 += y.doctor;
        				htm2 += '</div>';

        				htm2 += '<div class="col-md-6 pad-0">'
        					htm2 += y.doctor_address;
        				htm2 += '</div>';
        			htm2 += '</div>';
        		}

        		
        	})
        	
        if(days != 0) {
        	if(days == 1) {
        		$('.for_day1').append(htm);
        	} else {
        		$('.for_day2').append(htm2);
        	}
        }	
        	
        	
        	
        })
})

</script>



<div class="col-md-12 schedule_container" style="background-color:white">


	<div class="col-md-2" style="margin-top:10%">
		<div class="col-md-12">
			<?php $this->load->view('home_button'); ?>
		</div>

		<div class="col-md-12">
			<button class="dark-blue-btn btn_create_sched">Create New</button> 
		</div>
		
		
	</div>


	<div class="col-md-6">
		<p style="color:#ccc;font-size:20px;">OJL SCHEDULE</p>
		<div id="calendar"></div>

		<div class="col-md-12" style="margin-bottom:27px;">
			<p style="margin-top: 12px">
			<span style="background-color:#ffff4c">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>   New Version
			<span style="background-color:#C71585;margin-left:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>   Original Version
			<span style="background-color:#FFA500;margin-left:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>   Draft
		</p>
		</div>	

	</div>

	<div class="col-md-4">
		<p style="color:#012873;font-size:50px;margin-top: 30px;">AGENDA</p>

		<p class="p-blue"><b><?= $date = date('F d, Y'); ?></b></p>

<!-- 		<p><b>9:00 AM - BREAKFAST</b></p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
		<div class="col-md-12 for_day1">

		</div>

		<div class="col-md-12 for_day2">
			
		</div>


	</div>

	<div class="sched_second" style="display:none">
		<div class="col-md-12 progress" style="background-color:#ccc">
			<span class="glyphicon glyphicon-asterisk" aria-hidden="true">
		</div>
	</div>
	
</div>

<style type="text/css">
	.to_home, .btn_create_sched {
		width: 100%;
		margin-bottom: 10px;
	}
	.fc-row {
		background-color: #c0c0c0;

	}

	.dark-blue-btn, .to_home {
		background-color: #012873;
		color: white;
		width: 100%;
		border: none;
		padding-top: 10px;
		padding-bottom: 10px;
		border: none !important;
	}

	.fc-day-header {
		background-color: #012873;
		color: white;
		padding-top: 6px !important;
		padding-bottom: 6px !important;
		font-weight: normal;
	}

	.fc-scroller {
		height: 360px !important;
	}

	.fc-scroller .fc-day-grid .fc-rigid {
		height: 60px !important;
	}
	.fc-left, .fc-right {
		display: none;
	}
	.fc-center {
		
		float: left;
	}

	.fc-center h2 {
		font-size: 50px;
		color: #012873;
	}
	.p-blue {
		color: #012873;
	}
	.fc-more-popover {
		width: 180px;
	}
	.footer-login {
		margin-top: 0.5%;
	}
</style>

