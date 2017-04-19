<script type="text/javascript">

$(document).ready(function(){ 


	$(document).on('change', '.datetf', function() {
		check_date();
	});

	function check_date() {
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();

		$.ajax({
			type: "POST",
			url: "<?=base_url();?>ojl_schedule/checkdate",
			data: {date_from: date_from, date_to: date_to}
		}).done(function(data) {
		
			//alert(data);
		});

	}


});

</script>