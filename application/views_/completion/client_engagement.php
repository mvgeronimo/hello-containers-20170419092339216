

<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

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



	<div class="col-md-12 col-sm-12 pad-0">

		<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL COMPLETION</p>

		<p class="darkblue-font title_completion" style="font-size:50px"></p>

				

	</div>



	<div class="col-md-12 content-item no-padding">

		<?= $table ?>

	</div>







		

	</div>



</div>







<script type="text/javascript">



$(document).ready(function(){



	$('.i').addclass('ActivePage');



	start_ojl('start_ojl_completion');



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



	});

}



</script>