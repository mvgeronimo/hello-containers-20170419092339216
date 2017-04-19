

<input type="hidden" class="hidden_empid" value="<?=$this->session->userdata('emp_id');?>">



<div class="col-md-12 col-sm-12 create_div" style="background-color:white">

	<div class="col-md-2 col-sm-3 progress_div"> <?php include('progress.php'); ?> </div>

		<div class="col-md-10 col-sm-9 pad-0">

			<div class="col-md-12 pad-0 user_div"> <!-- div for user -->

				<div class="col-md-12 pad-0">

					<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">MAINTENANCE</p>

					<p class="darkblue-font page_title" style="color: #000;">Agenda</p>

				</div>

				<div class="col-md-12 pad-0 user_list">

					<?php include('maintenance_agenda.php'); ?>

				</div>

			</div>

		</div>

</div> <!-- end for user -->











<script>



 $(document).ready(function() {



 });



</script>

