

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

				var obj = JSON.parse(data);
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

					};


					temp.push(temp2);

					if(v.type==1) {
						var tmp = {
							events: temp,
				            color: '#C71585',   // a non-ajax option
				            textColor: 'white', // a non-ajax option
				            className: v.id, 
						};
					} else {
						var tmp = {
							events: temp,
				            color: '#ffff4c',   // a non-ajax option
				            textColor: 'black', // a non-ajax option
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

                    // alert(title+' '+status);

                    if(status == 1) {
                    	 window.location = '<?=base_url();?>agenda/agenda_details/'+agenda_id;
                    } else {
                    	 window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;
                    }
                   
                    //var ctr_string = $(this).attr('class');

                    

                }

            });
        }
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

	</div>

	<div class="col-md-4">
		<p style="color:#012873;font-size:50px;margin-top: 30px;">AGENDA</p>

		<p class="p-blue"><b><?= $date = date('F d, Y'); ?></b></p>

		<p><b>9:00 AM - BREAKFAST</b></p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

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
		height: 425px !important;
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

