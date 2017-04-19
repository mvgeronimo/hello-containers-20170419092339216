

<style type="text/css">

	.prog_sales_plan {

		color:blue;

	}





	.margintop-10 {

		margin-top:10px;

	}



	.sales_table, .sales_table th, .ds_table, .ds_table th {

		text-align: center;



	}



	.td_ds {

		width: 25%;

	}







</style>

<script type="text/javascript">

$(document).ready(function() {

	// $('.i').addClass('activePage');

	// $('.ii').addClass('activePage');

	// $('.iii').addClass('activePage');



	// $('.i').click(function() {

	// 	var agenda = $('.hidden_agenda').val();

	// 	window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda;

	// });



	// $('.ii').click(function() {

	// 	window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+agenda;

	// })



	// $('.iv').click(function() {

	// 	window.location = '<?=base_url();?>Coverage_performance_monitoring?id='+agenda;

	// });



	$('.prog_cp_monitoring').click(function() {

		$('.to_cp_monitoring').click();

	})



	$('.to_cp_monitoring').click(function() {



		var step = $('.hidden_step').val();

		var next_step = 4;


		$(this).attr('disabled',true);
		if(step < next_step) {

			$.ajax({

				type:'post',

				url:'<?=base_url();?>Ojl_schedule/step',

				data:{'step':next_step}

			}).done(function() {

				proceed_to_coverage();

			})	

		} else {

			proceed_to_coverage();

		}

		

		

	})



	function proceed_to_coverage() {

		var ds_id = $('.hidden_ds_id').val();

		var sales_remarks = $('.sales_remarks').val();
		var agenda_id = $('.hidden_agenda').val();
		var psr_id = $('.hidden_psr').val();

		var grossup_ytd_ds = $('.grossup_ytd_ds').html();
		var grossup_ytd_st = $('.grossup_ytd_st').html();
		var grossup_ytd_is = $('.grossup_ytd_is').html();
		var quota_ytd = $('.quota_ytd').html();
		var quota_fy = $('.quota_fy').html();
		var quota_togo = $('.quota_togo').html();
			
		
		// $('.trs').each(function() {
		// 	var grossup_ytd_ds = $(this).find('.grossup_ytd_ds').html();
		// 	var quota_ytd = $(this).find('.quota_ytd').html();

		// 	alert(grossup_ytd_ds+' '+quota_ytd);
		// })

		

		delete_sales(agenda_id, psr_id);

		

		

	}


	function delete_sales(agenda_id, psr_id) {
		$.ajax({
			type:'post',
			url:'<?=base_url();?>Sales_plan_for_the_month/delete_sales',
			data:{"agenda_id":agenda_id, "psr_id":psr_id}
		}).done(function() {

			proceeed();
		})
	}


	function proceeed() {
		var sales_count = $('.hidden_sales_count').val();
		var agenda_id = $('.hidden_agenda').val();

		for(x=1;x<=sales_count-1;x++) {

			var grossup_ytd_ds = parseFloat($('.grossup_ytd_ds_'+x).html().replace(/\,/g, ''));
			var grossup_ytd_st = parseFloat($('.grossup_ytd_st_'+x).html().replace(/\,/g, ''));
			var grossup_ytd_is = parseFloat($('.grossup_ytd_is_'+x).html().replace(/\,/g, ''));
			var quota_ytd = parseFloat($('.quota_ytd_'+x).html().replace(/\,/g, ''));
			var quota_fy = parseFloat($('.quota_fy_'+x).html().replace(/\,/g, ''));
			var quota_togo = parseFloat($('.quota_togo_'+x).html().replace(/\,/g, ''));
			var sales_remarks = $('.sales_remarks_'+x).val();
				
			var psr_id = $('.hidden_psr').val();
			


			
			$.ajax({

				type:'post',
				url:'<?=base_url();?>Sales_plan_for_the_month/update_sales_plan',
				data:{'sales_remarks':sales_remarks, 'agenda_id':agenda_id, 'psr_id':psr_id, "grossup_ytd_ds":grossup_ytd_ds,
						"grossup_ytd_st":grossup_ytd_st, "grossup_ytd_is":grossup_ytd_is, "quota_ytd":quota_ytd, "quota_fy":quota_fy,
						"quota_togo":quota_togo}

			}).done(function() {

				// bootbox.alert('<b>Success</b>', function() {
				// });

			})
			


			
		}

		if(x==sales_count){
			window.location = '<?=base_url();?>Coverage_performance_monitoring?id='+agenda_id;
		}
		
		/*if(sales_count == 1) {
				window.location = '<?=base_url();?>Coverage_performance_monitoring?id='+agenda_id;
			}*/
	}

})

</script>

<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">
<input type="hidden" class="hidden_psr" value="<?=$psr_id;?>">



<div class="sales_plan_div col-sm-12 col-md-12" style="background-color:white">

	<div class="col-md-2 col-sm-3 progress_div">

		<?php $this->load->view('schedule/progress.php'); ?>

	</div>

	

	<div class="col-md-10 col-sm-9 pad-0 container_div">

		<div class="col-md-12 pad-0">

			<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL SCHEDULE</p>

			<p class="darkblue-font page_title">SALES PLAN FOR THE MONTH</p>

		</div>





		<div class="col-md-12">

			<table class="sales_table sales_plan_tbl col-sm-12 col-md-12 col-lg-12 margintop-10">

				<thead class="darkblue-bg">

					<th>YTD Quota</th>

<!-- 					<th>YTD Aug Actual</th>

					<th>% Perf</th> -->

					<th>FY Quota</th>

					<th>FY To Go</th>

				<thead>



				<tbody>

					<?php $x = 1; foreach($sales_plan as $key => $c) { ?>

						<tr class="trs">

							<td class="quota_ytd_<?=$x;?>"><?=number_format($c->quota_ytd, 2, '.', ',')?></td>

<!-- 							<td>asd</td>

							<td>asd</td> -->

							<td class="quota_fy_<?=$x;?>"><?=number_format($c->quota_fy, 2, '.', ',')?></td>

							<td class="quota_togo_<?=$x;?>"><?=number_format($c->quota_togo, 2, '.', ',')?></td>

						</tr>

					<?php $x++; } ?>

				</tbody>	

			</table>
			<input type="hidden" class="hidden_sales_count" value="<?=$x;?>">
		</div>



		<!-- <div class="col-md-12" style="text-align:right">

			<button class="btn btn-primary btn_add_remarks" style="width:20%">Add Remarks</button>

		</div> -->



		<div class="col-md-12">

			<table class="ds_table sales_plan_tbl col-sm-12 col-md-12 col-lg-12 margintop-10">

				<thead class="darkblue-bg">

					<th>DS</th>

					<th>ST</th>

					<th>Iserv</th>

					<th>Remarks</th>

					

				<thead>



				<tbody>

					<?php $y=1; foreach($sales_plan as $key => $d) { 

						if($key%2 == 0) {

						?>

						<tr>

						<?php } else { ?>

						<tr class="trs" style="background-color:#dcdcdc">

						<?php } ?>



							<td class="td_ds grossup_ytd_ds_<?=$y;?>"><?=number_format($c->grossup_ytd_ds, 2, '.', ',')?></td>

							<td class="td_ds grossup_ytd_st_<?=$y;?>"><?=number_format($c->grossup_ytd_st, 2, '.', ',')?></td>

							<td class="td_ds grossup_ytd_is_<?=$y;?>"><?=number_format($c->grossup_ytd_is, 2, '.', ',')?></td>

							<td class="td_ds" style="padding:5px 0px 5px 0px;">

								<input type="hidden" class="hidden_ds_id" value="<?=$d->record_id;?>"> 

								<?php if($agenda_status == 2 || $agenda_status == 3 || $agenda_status == 4) { ?>
									<input type="text" class="form-control sales_remarks_<?=$y;?>" value="<?=$d->remarks;?>" disabled>
								<?php } else { ?>
									<input type="text" class="form-control sales_remarks_<?=$y;?>" value="<?=$d->remarks;?>">
								<?php } ?>							
							</td>

						</tr>

					<?php $y++; } ?>

				</tbody>	

			</table>

		</div>



		<div class="col-md-12" style="text-align:right">

			<?php $this->load->view('home_button'); ?><button class="darkblue-bg darkblue-btn to_cp_monitoring" style="width:8%;margin-top:20px;">Next</span></button>

		</div>





		</div>



		



	</div>

</div>