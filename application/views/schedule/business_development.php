<style type="text/css">
	.business_development_cont, .people_development_cont {
		border:1px solid black;
		padding:0px;
		padding-bottom:10px;
		margin-bottom:20px;
	}
</style>



<script type="text/javascript">
$(document).ready(function() {
	var count_agenda = 1;
	var count_people = 1;

	$('.save_people').click(function() {
		
		for(pp=1;pp<=count_people;pp++) {
			var agenda_name = $('.agenda_name_people_'+pp).val();
			var action_plan = $('.action_plan_people_'+pp).val();
			
			if(agenda_name != undefined) {
				$.ajax({
    url: '<?php echo base_url(); ?>Ojl_schedule/insert_business_development',
    type: "POST",
    data: { agenda_name: agenda_name, action_plan: action_plan, type : 2 },
    success: function (result) {
		$('.loader').hide();
		alert("Successfully Saved!");
		
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

		// alert("Successfully Saved!");
	
	})

	$('.save_business').click(function() {
		$('.loader').show();
		// alert(count_agenda);
		for(sb=1;sb<=count_agenda;sb++) {
			var agenda_name = $('.agd_'+sb).val();
			var action_plan = $('.action_plan_'+sb).val();
			// alert('222');
			if(agenda_name != undefined) {
				// alert('1111');
				$.ajax({
    url: '<?php echo base_url(); ?>Ojl_schedule/insert_business_development',
    type: "POST",
    data: { agenda_name: agenda_name, action_plan: action_plan, type : 1},
    success: function (result) {
		$('.loader').hide();
		alert("Successfully Saved!");
		
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
		
	})

	$('.add_agenda').click(function() {
		count_agenda++;

		var htm = '';
		htm += '<div class="col-md-12 business_'+count_agenda+'">';
		htm += '<div class="col-md-5" style="margin-top:15px">';
		htm += '<div class="col-md-10" style="padding:0px">';
		htm += '<input type="text" class="agenda_name form-control agd_'+count_agenda+'" placeholder="Agenda">';
		htm += '</div>';

		htm += '<div class="col-md-2">';
		htm += '<button class="btn btn-primary minus_agenda" btn-num="'+count_agenda+'" style="height: 34px;">';
		htm += '<span class="glyphicon glyphicon-minus" aria-hidden="true">';
		htm += '</button></div></div>';

		htm += '<div class="col-md-7" style="margin-top:15px">';
		htm += '<input type="text" class="action_plan_'+count_agenda+' form-control" placeholder="Action Plan">';
		htm += '</div></div>';


		$('.agenda_cont').append(htm);	
		
	})

	$('.add_people_agenda').click(function() {
		count_people++;

		var htm = '';

		htm += '<div class="col-md-12 ppl_'+count_people+'">';
		htm += '<div class="col-md-5" style="margin-top:15px">';
		htm += '<div class="col-md-10" style="padding:0px">';
		htm += '<input type="text" class="agenda_name_people_'+count_people+' ppl_'+count_people+' form-control" placeholder="Agenda">';
		htm += '</div>';

		htm += '<div class="col-md-2">';
		htm += '<button class="btn btn-primary minus_ppl_agenda" btn-num="'+count_people+'" style="height: 34px;width:40px">';
		htm += '<span class="glyphicon glyphicon-minus" aria-hidden="true">';
		htm += '</button>';
		htm += '</div></div>';

		htm += '<div class="col-md-7" style="margin-top:15px">';
		htm += '<input type="text" class="action_plan_people_'+count_people+' form-control" placeholder="Action Plan">';
		htm += '</div></div>';

		$('.people_cont').append(htm);
		

	})

	$(document).on('click', '.minus_agenda', function() {
		var busines_no = $(this).attr('btn-num');
		$('.business_'+busines_no).remove();
	})

	$(document).on('click', '.minus_ppl_agenda', function() {
		var people_dev = $(this).attr('btn-num');
		$('.ppl_'+people_dev).remove();
	})

	$('.to_itenerary').click(function() {
		window.location = '<?=base_url();?>ojl_schedule/itenerary';
	})
})
</script>


<input type="hidden" class="hidden_agenda" value="<?= $this->session->userdata('agenda_id')?>">

<div class="col-md-12">

	<div class="col-md-5" style="">
		<b>AGENDA</b>
	</div>

	<div class="col-md-7">
		<b>SPECIFIC PLAN(S)</b>
	</div>
</div>

<div class="col-md-12 business_development_cont">

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			<b>Business Development</b>
		</div>

		<div class="col-md-7" style="margin-top:15px">
			
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			<button class="btn btn-primary add_agenda">Add Agenda</button> 
		</div>

		<div class="col-md-7" style="margin-top:15px">
			
		</div>
	</div>



	<div class="agenda_cont">
		<div class="col-md-12 business_1">
			<div class="col-md-5" style="margin-top:15px">
				<div class="col-md-10" style="padding:0px">
					<select class="agenda_name form-control agd_1">
					<?php foreach($dropdown as $key => $value) { ?>
					<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
					<?php } ?>
					</select>
				</div>

				<div class="col-md-2">
					<button class="btn btn-primary minus_agenda" btn-num="1" style="height: 34px;width:40px">
						<span class="glyphicon glyphicon-minus" aria-hidden="true">
					</button>
				</div>
			</div>

			<div class="col-md-7" style="margin-top:15px">
				<input type="text" class="action_plan_1 form-control" placeholder="Action Plan">
			</div>
		</div>

	</div>

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			
		</div>

		<div class="col-md-7" style="margin-top:15px;text-align:right">
			<button class="btn btn-primary save_business" data-val="1">Save</button> 
		</div>
	</div>

</div>


<div class="col-md-12 people_development_cont">

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			<b>People Development</b>
		</div>

		<div class="col-md-7" style="margin-top:15px">
			
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			<button class="btn btn-primary add_people_agenda">Add Agenda</button> 
		</div>

		<div class="col-md-7" style="margin-top:15px">
			
		</div>
	</div>

	<div class="people_cont">
		<div class="col-md-12 ppl_1">

			<div class="col-md-5" style="margin-top:15px">
				<div class="col-md-10" style="padding:0px">
					<!--<input type="text" class="agenda_name_people_1 form-control" placeholder="Agenda">!-->
					<select class="agenda_name_people_1 form-control">
					<?php foreach($dropdown as $key => $value) { ?>
					<option value="<?php echo $value->agenda_name_id; ?>"><?php echo $value->agenda_name; ?></option>
					<?php } ?>
					</select>
				</div>

				<div class="col-md-2">
					<button class="btn btn-primary minus_ppl_agenda" btn-num="1" style="height: 34px;width:40px">
						<span class="glyphicon glyphicon-minus" aria-hidden="true">
					</button>
				</div>
				
			</div>

			<div class="col-md-7" style="margin-top:15px">
				<input type="text" class="action_plan_people_1 form-control" placeholder="Action Plan">
			</div>
		</div>

	</div>

	<div class="col-md-12">
		<div class="col-md-5" style="margin-top:15px">
			
		</div>

		<div class="col-md-7" style="margin-top:15px;text-align:right">
			<button class="btn btn-primary save_people" data-val="2">Save</button> 
		</div>
	</div>


</div>

<div class="col-md-12" style="text-align:right">
	<button class="btn btn-primary to_itenerary">Itenerary</button> 
</div>












