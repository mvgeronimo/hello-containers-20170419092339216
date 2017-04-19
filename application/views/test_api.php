		
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-table.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/ajaxfiledownload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/cascadingdropdown.js"></script> -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-table.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/default.css">


<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
		type:'post',
		url:'http://ojl.ecomqa.com/api',
		data:{'token':'49cd537e47f8f6c036818d92c1c79ef08c9f97cd', 
				'empid':'3726', 
				'cmdEvent':'get_competitors_activity_report',
				'agenda_id':'30',
				'name_of_md':'Montgomery',
				'biomedis_product':'Bio-fresh',
				'rating_per_md':'88',
				'remarks':'Good product'
			}

	}).done(function (result) {
		console.log(result);
	})
})
</script>

