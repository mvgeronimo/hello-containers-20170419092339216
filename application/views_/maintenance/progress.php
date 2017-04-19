<style type="text/css">
	.prog {
		color:#7a7a7a;
		float:left
	}

	.prog:hover {
		opacity: .5;


	}
	.prog-a {
		cursor: pointer;
	}
	.prog-a:hover {
		color: #012873 !important;
    	font-weight: bold;
	}
	.top-15 {
		margin-top: 15px;
	}
</style>

<script type="text/javascript">
$(document).ready(function() {
	var currentStep = $('.currentStep').val();

	if(currentStep == 1) {
		$('.i').addClass('activePage');
	} else if(currentStep == 2) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
	} else if(currentStep == 3) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
	} else if(currentStep == 4) {
		$('.i').addClass('activePage');
		$('.ii').addClass('activePage');
		$('.iii').addClass('activePage');
		$('.iv').addClass('activePage');
	}
	
	$('.prog-a').removeClass('activePage');
	var url = document.URL
	var active = url.substr(url.lastIndexOf('/') + 1);
	$('.'+active).addClass("activePage");
	if(active == "maintenance"){
		$('.user').addClass("activePage");
	}

    $(document).on('click', '.prog-a', function() {
    	var data = $(this).attr('data');
    	$('.prog-a').removeClass('activePage');
    	$(this).addClass("activePage");
    	window.location = '<?=base_url();?>maintenance/'+data;
    })
 

})
</script>

<input type="hidden" class="currentStep" value="<?=$this->session->userdata('step');?>">

<div class="tab-paging">

	<div class="col-md-12 pad-0">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_1">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a i user" data='user'>User</a>
		</div>
	</div>
	
	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_2">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a ii job" data="job">Job Name</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_3">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a iii role" data="role">Roles</a>
		</div>
	</div>

	<div class="col-md-12 pad-0 top-15">
		<div class="col-md-2 pad-0">
			<img class="prog-img piatos_4">
		</div>

		<div class="col-md-10 pad-0">
			<a class="prog-a iv agenda" data="agenda">Agenda</a>
		</div>
	</div>

	
</div>

<script type="text/javascript">
$(document).ready(function() {

	var path = '<?=base_url();?>';

	$('.prog-a').css({'color':'#ccc'});
})
</script>