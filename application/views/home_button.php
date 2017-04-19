<button class="to_home" style="margin-right:10px">Home</button>

<script type="text/javascript">
$(document).ready(function() {
	$('.to_home').click(function() {
		window.location = '<?=base_url();?>home';
	})
})
</script>

