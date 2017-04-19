

<style type="text/css">

	.prog_sales_plan {

		color:blue;

	}





	.margintop-10 {

		margin-top:10px;

	}



	.cp_monitoring_table, .cp_monitoring_table th, .ds_table, .ds_table th {

		text-align: center;



	}







</style>



<script type="text/javascript">

$(document).ready(function() {

	// $('.i').addClass('activePage');

	// $('.ii').addClass('activePage');

	// $('.iii').addClass('activePage');

	// $('.iv').addClass('activePage');



	$('.ii').click(function() {

		window.location = ''

	})

	$('.iii').click(function() {

		window.location = '<?=base_url();?>Sales_plan_for_the_month';

	});



	var dm = $('.hidden_dm').val();

	var psr = $('.hidden_psr').val();



	$('.to_ojl_completion').click(function() {



		var step = $('.hidden_step').val();

		var agenda_id = $('.hidden_agenda').val();

		var next_step = 5;



		if(step < next_step) {

			$.ajax({

				type:'post',

				url:'<?=base_url();?>Ojl_schedule/step',

				data:{'step':next_step}

			}).done(function() {

				window.location = '<?=base_url();?>Employee_competency_development?id='+agenda_id;

			})	

		} else {

			window.location = '<?=base_url();?>Employee_competency_development?id='+agenda_id;

		}



		

		

	})


	$('.loader').show();

	$.ajax({
	     type:'get',
	     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/performance/callrates',
	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
	    }).done(function(result) {
	    	var cycle = '';
	    	var rate = ''
	    	var header = 0;
	     	$.each(result, function(x,y) {
	     		cycle+='<td>'+y.Cycle+'</td>';
	     		rate += '<td>'+y.ActualCallRate+'</td>';
	     		header++;
	     	})

	     	$('.cycle').append(cycle);
	     	$('.rate').append(rate);
	     	$('.cycle_header').attr('colspan', header);

	     	$('.loader').hide();

	    })

	

	

})

</script>



<?php

	foreach($abig as $key => $c) {

		$abig_data = $c->abig_data;

	}



	$count_cycle = count($cycle);





 ?>



 <?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

 <input type="hidden" class="hidden_dm" value="<?=$this->session->userdata('emp_id');?>">

<input type="hidden" class="hidden_psr" value="<?=$this->session->userdata('agenda_psr');?>">

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">



<div class="cp_monitoring_div col-sm-12 col-md-12" style="background-color:white">

	

	<div class="col-md-2 col-sm-3 progress_div">

		<?php $this->load->view('schedule/progress.php'); ?>

	</div>



	<div class="col-md-10 col-sm-9 pad-0 container_div">

		<div class="col-md-12 pad-0">

			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE</p>

			<p class="darkblue-font page_title">COVERAGE PERFORMANCE MONITORING</p>

		</div>



		<div class="col-md-12" style="padding:0px">

			<table class="cp_monitoring_table sales_plan_tbl col-sm-12 col-md-12 col-lg-12 margintop-10">

			

				<tbody>

					<tr>

						<!-- <td rowspan="3"><b><?=$abig_data;?></b></th> -->

						<td class="cycle_header darkblue-bg" colspan=""><b>CYCLE</b></th>

					</tr>

					<tr class="cycle" style="background-color:grey">

						

					</tr> 



					<tr class="rate">

						

					</tr>

				</tbody>

			</table>





			<div class="col-md-12" style="text-align:right;padding:0px;">

				<?php $this->load->view('home_button'); ?><button class="darkblue-bg darkblue-btn to_ojl_completion" style="width:8%;margin-top:20px;">Next</span></button>

			</div>

		</div>





	</div>



</div>