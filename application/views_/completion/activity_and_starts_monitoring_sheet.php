
<style type="text/css">
	.remove-icon {
		padding-bottom: 9px;
	}
</style>
<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">

<div class="col-md-12 col-sm-12" style="background-color:white">



	<div class="col-md-2 col-sm-3 progress_div">

		<?php  $this->load->view('schedule/progress.php'); ?>

	</div>

	<!-- <div class="tab-paging">

	<ol class="flex-control-nav flex-control-paging" style="clear:both;float:none">

			<li > <a class="v">1</a></li>

			<li > <a class="vi">2</a></li>

			<li > <a class="vii">3</a></li>

			<li > <a class="viii">4</a></li>

			<li > <a class="ix">5</a></li>

			<li > <a class="x">6</a></li>

	</ol>

	</div>

	 -->

	<div class="data-Container col-sm-9 col-md-10 pad-0">



	<div class="col-md-12 pad-0">

		<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL COMPLETION</p>

		<p class="darkblue-font title_completion" style="font-size:50px"></p>

				

	</div>



	<div class="col-md-12 content-item no-padding">

		<?= $table ?>

	</div>

	<div class="col-md-12 no-padding">

		<div class="col-md-6" style="margin-bottom:15px">
			<b>S.T.A.R.S. noted: Care, Grow, Integrate, Execute, Transform</b>
		</div>

	

		<div class="col-md-6 no-padding" style="text-align:right;margin-bottom:15px">
			<button class="competency_addline darkblue-bg darkblue-btn" style="float:right;pointer-events:none">
				Add Line
			</button>

			<select class="stars_drp form-control" style="width:35%;margin-right:5px;float:right;">
				<option value="all">Select Competency</option>
				<option value="1">Care</option>''
				<option value="2">Grow</option>
				<option value="3">Integrate</option>
				<option value="4">Execute</option>
				<option value="5">Transform</option>


			</select>

			
		</div>

		<div class="col-md-12 no-padding competency_tables">
			
		</div>

	</div>

	<div class="col-md-12 no-padding" style="margin-bottom:15px;margin-top:15px;">

	    <div class="col-sm-6 col-md-6 col-lg-6"> </div>

        <div class="col-sm-6 col-md-6 col-lg-6 margin-top-50px;"> 
       	<button class="darkblue-bg darkblue-btn btn-nexteval right" style="margin-left:5px;display:none"> NEXT </button> 
        <button class="darkblue-bg darkblue-btn AddLine btn-submit right" btnum="2" aria-type="PITPlanned" style="margin-left:5px"> SUBMIT </button> 
        <button class="darkblue-bg darkblue-btn AddLine right btn_skip" aria-type="PITPlanned" style="margin-left:5px"> SKIP </button> 
        <button class="darkblue-bg darkblue-btn AddLine btn-submit right" btnum="1" aria-type="PITPlanned" style="margin-left:5px"> SAVE AS DRAFT </button> 
        <button class="darkblue-bg darkblue-btn AddLine right cancel_activity" aria-type="PITPlanned" style="margin-left:5px"> CANCEL </button> 

        </div>

	</div>


	<input type="hidden" class="stars" value="0">





		

	</div>



</div>





<style type="text/css">
	.no-border {
		border: none !important;
	}

	.competency_addline:hover {
		color:white !important;
		opacity: .5;	

	}
</style>

<script type="text/javascript">



$(document).ready(function(){



var plan_ctr = 0;

 var top_plan_ctr = 0;
 







start_ojl('Activity_and_Starts_Monitoring_Sheet_Data');



	$(document).on('click', '.btn_skip', function() {

		window.location = '<?=base_url();?>Ojl_evaluation';

	})





});





function start_ojl(fc) {

	$.ajax({

		url:"<?=base_url()?>Ojl_completion/"+fc,

		type:'post',

		dataType:'json'

	}).done(function(data){

		var pageTitle;

		var content;

		pageTitle = data.pageTitle;

		content = data.table;

		$('.title_completion').html(pageTitle);

		$('.content-item').html(content);





		plan_ctr = $('.hid_plan_ctr').val();

		top_plan_ctr = $('.hid_top_plan_ctr').val();

		for(a=1;a<=plan_ctr;a++) {
			$('.planned_date_impletemented_'+a).datepicker();
		}


		for(b=1;b<=top_plan_ctr;b++) {
			$('.top_planned_date_impletemented_'+b).datepicker();
		}

		var agenda_status = $('.hidden_agenda_status').val();

		

		get_compentencieees();

	});

}


function get_compentencieees() {
	var mp_status = $('.hidden_mp_status').val();
	var agenda_status = $('.hidden_agenda_status').val();

	$.ajax({
		type:'post',
		url:'<?=base_url();?>Ojl_completion/get_comps'

	}).done(function(result) {
		var obj = JSON.parse(result);
		var htm = '';
		var c = 0;
		
		if(mp_status == 1 && (agenda_status == 2 || agenda_status ==3 || agenda_status == 4)) {
	                                          
	    } else {
	    	$.each(obj, function(x,y) {
				c++;
				if(y.type==1) {
					var header = 'Care';
				} else if(y.type==2) {
					var header = 'Grow';
				} else if(y.type==3) {
					var header = 'Integrate';
				} else if(y.type==4) {
					var header = 'Execute';
				} else if(y.type==5) {
					var header = 'Transform';
				}
				htm += '<table class="table comp-table_'+c+'" type="'+y.type+'" style="">';
					htm += '<thead class="darkblue-bg">';
						htm += '<th class="no-border" colspan="2" style="text-align:center;border:none !important">Competency Exhibit: '+header+' </th>';
						htm += '<th class="no-border"  style="text-align:center;width:3%;border:none !important"><span class="glyphicon glyphicon-remove-circle remove-comp remove-icon"></span></th>';
					htm += '</thead>';

					htm += '<tbody>';
						htm += '<tr style="background-color:#f3f2f0">';
							htm += '<td class="no-border" style="width:50%;text-align:center">Situation/Task</td>';
							htm += '<td class="no-border" colspan="2"><input type="text" class="inputs form-control txt_sit_task_'+c+'" value="'+y.situation_task+'"></td>';
						htm += '</tr>';

					htm += '<tr style="background-color:#dcd9d5">';
						htm += '<td class="no-border" style="width:50%;text-align:center">Action</td>';
						htm += '<td class="no-border" colspan="2"><input type="text" class="inputs form-control txt_action_'+c+'" value="'+y.action+'"></td>';

					htm += '</tr>';

					htm += '<tr style="background-color:#f3f2f0">';
						htm += '<td class="no-border" style="width:50%;text-align:center">Result</td>';
						htm += '<td class="no-border" colspan="2"><input type="text" class="inputs form-control txt_result_'+c+'" value="'+y.result+'"></td>';					
					htm += '</tr>';	
						
					htm += '</tbody>';

				htm += '</table>';		

			})

			
	    	
	    }



		

		$('.competency_tables').append(htm);

		if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
				//alert('a');
				$('.remove-comp').hide();
			}

		$('.stars').val(c);
		disable_inp();

	})
	
	

		
}

function disable_inp() {

	var mp_status = $('.hidden_mp_status').val();
	var agenda_status = $('.hidden_agenda_status').val();
	if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
		$('.inputs, .stars_drp').prop('disabled', true);
		$('.inputs_remove, .inputs_add').css({'pointer-events':'none'});
		$('.btn-nexteval').show();
		$('.AddLine').hide();
	}

}



</script>