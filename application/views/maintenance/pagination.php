<?php 



$display = "";



$pagenum = ceil($pages[0]->count/$_POST['limit']);



if($pagenum < 1){



	$display = "display:none";



}



?>







<div class="user-pagination" style="background:#012873;text-align:right;">



<div class="prod-pagintaion audit-prod-pagination" style="<?=$display;?>">



	<?php







		$x = 1;



		$page = $_POST['page'];



	?>



	<button class="cbtnpaginate_member prevnext" value="1">First</button>



	<button class="cbtnpaginate_member prev" value="<?=$page-1?>"><</button>



	<?php



	if($page>3){



		$x = $page-2;



	}



	$a = $x;



	$y = $x+3;



	$pagenum = ceil($pages[0]->count/$limit);







		while($x<=$pagenum){



			?>



			<button class="cbtnpaginate_member pagenum num_<?=$x?> <?=($x==$a) ? 'f-page' : '' ?>" value="<?=$x?>"><?=$x?></button>



	<?php		



		$x++;



			if($x==$y){



				$x = $pagenum +1;



			}



		}



	?>



	<button class="cbtnpaginate_member next" value="<?=$page+1?>">></button>



	<button class="cbtnpaginate_member prevnext" value="<?=$pagenum?>">Last</button>



</div>







</div>



<input type="hidden" class="last-page" value="<?=$pagenum?>">



<script type="text/javascript">



$(document).ready(function(){



	var page = "<?=$_POST['page']?>";



	$('.num_'+page).addClass('active-page');



	



});



</script>



