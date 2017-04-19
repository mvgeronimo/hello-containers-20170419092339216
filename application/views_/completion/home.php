<?php //echo '<pre>'; print_r($this->session->all_userdata()); ?>

<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">

<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">

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



	<div class="col-md-12 pad-0">

		<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL COMPLETION</p>

		<p class="darkblue-font title_completion page_title" style=""></p>

				

	</div>



	<div class="col-md-12 content-item no-padding">

		<?= $table ?>

	</div>







		

	</div>



</div>







<script type="text/javascript">



$(document).ready(function(){
	

	start_ojl('start_ojl_completion');


});









function start_ojl(fc) {
	var agenda_id = $('.hidden_agenda').val();

	$.ajax({

		url:"<?=base_url()?>Ojl_completion/"+fc+'?id='+agenda_id,

		type:'post',

		dataType:'json'

	}).done(function(data){
		$.each(data.engagement, function(x,y) {
			console.log(y);
		})

		var pageTitle;

		var content;

		pageTitle = data.pageTitle;

		content = data.table;

		
		$('.title_completion').html(pageTitle);

		$('.content-item').html(content);



	});

}





// counter = 1;



// $(document).on("click",".flex-control-paging li a",function(){

// $('.flex-control-paging li a').removeClass("activePage");

// $(this).addClass("activePage");

// });







// $(document).on("click",".v",function(){



// 	start_ojl('start_ojl_completion');



// });







// $(document).on("click",".vi, .PCE-StoryTelling-page",function(){





// $('.flex-control-paging li a').removeClass("activePage");

// $('.vi').addClass("activePage");



// 	start_ojl('product_communication');



// });





// $(document).on("click",".vii, .SDPharmacies",function(){

// $('.flex-control-paging li a').removeClass("activePage");

// $('.vii').addClass("activePage");

// 	start_ojl('Survey_Drugstore_Pharmacies');



// });





// $(document).on("click",".viii, .Competitors-Activity-Report",function(){

// $('.flex-control-paging li a').removeClass("activePage");

// $('.viii').addClass("activePage");

// 	start_ojl('Competitors_Activity_Report');



// });





// $(document).on("click",".ix, .EC-Development",function(){

// $('.flex-control-paging li a').removeClass("activePage");

// $('.ix').addClass("activePage");

// 	start_ojl('Employee_Compentency_Development');

	

// });





// $(document).on("click",".x, .RemarksEvaluation",function(){

// $('.flex-control-paging li a').removeClass("activePage");



// 	//insert_idp();



// $('.x').addClass("activePage");

// 	start_ojl('Activity_and_Starts_Monitoring_Sheet');

// 	page = 'Activity_and_Starts_Monitoring_Sheet';

// 	append_plan(1);

// 	append_plan(2);

// });



// function append_plan(type) {

// 	$.ajax({

// 		type:'post',

// 		url:'<?=base_url();?>Ojl_completion/get_plan',

// 		data:{type:type}

// 	}).done(function(result) {

// 		var obj = JSON.parse(result);

// 		var htm = '';



// 		$.each(obj, function(x,y) {

// 			htm += '<tr>';

// 				htm += '<td>'+y.product+'</td>';

// 				htm += '<td>'+y.name_of_program+'</td>';

// 				htm += '<td>'+y.planned+'</td>';

// 				htm += '<td>'+y.actual+'</td>';

// 				htm += '<td>'+y.perf+'</td>';

// 				htm += '<td>'+y.date_impletemented+'</td>';

// 				htm += '<td>'+y.remarks+'</td>';

// 				htm += '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>'

// 			htm += '</tr>';

// 		})



	

// 		if(type == 1) {



// 			$('.tb_plan').append(htm);

// 		} else {

// 			$('.tb_top_plan').append(htm);

// 		}



// 	// alert(type);		                                    



// 	})

// }



// function insert_idp() {

// 	 var IDP = $('.ECDevelopement-table tbody tr').length;

// 	 var Ulearn = $('.ECDevelopement-table tbody tr').length;

// 	 var idpFirst = "";

// 	 var idpSecond = "";



// 	 for( i=1;i<=IDP;i++){



	 	

// 	 	  if(i == IDP) {

// 	 	  	idpFirst += ($('.idp-first-data-'+i).val());

// 	 	 	idpSecond += ($('.idp-second-data-'+i).val());

// 	 	  } else {

// 	 	  	 idpFirst += ($('.idp-first-data-'+i).val()) +"-";

// 	 		 idpSecond += ($('.idp-second-data-'+i).val()) +"-";

// 	 	  }

// 		 }

		



// 	 var idpFirstData = idpFirst.split("-");

// 	 var idpSecondData = idpSecond.split("-");



	 

// 	  $.ajax({

// 	 		type:'post',

// 	 		url:'ojl_completion/tempData',

// 	 		data:{idpFirstData:idpFirstData, idpSecondData:idpSecondData}

// 	 }).done(function(data){

// 	 	insert_ulearn();

// 	 });

// }



// function insert_ulearn() {

// 	var Ulearn = $('.UAUpdate-table tbody tr').length;



// 	var ulearFirst = "";

// 	var ulearnSecond = "";

// 	var ulearnThird = "";

// 	 for( i=1;i<=Ulearn;i++){



// 		if(i==Ulearn) {

// 			ulearFirst 	 += ($('.ulearn-first-data-'+i).val());

// 			ulearnSecond += ($('.ulearn-second-data-'+i).val());

// 			ulearnThird  += ($('.ulearn-third-data-'+i).val());

// 		} else {

// 			ulearFirst 	 += ($('.ulearn-first-data-'+i).val()) +"-";

// 			ulearnSecond += ($('.ulearn-second-data-'+i).val()) +"-";

// 			ulearnThird  += ($('.ulearn-third-data-'+i).val()) + "-";

// 		}



// 	}



// 	var ulearFirstData = ulearFirst.split("-");

// 	var ulearnSecondData = ulearnSecond.split("-");

// 	var ulearnThirdData = ulearnThird.split("-");











// 	 $.ajax({

// 	 		type:'post',

// 	 		url:'ojl_completion/tempData2',

// 	 		data:{ulearFirstData:ulearFirstData, ulearnSecondData:ulearnSecondData,  ulearnThirdData:ulearnThirdData}

// 	 }).done(function(data){

// 	 		console.log(data);

// 	 });

// }







// $(document).on("click",".AddLine-2-column",function(){

// 	var type = $(this).attr('aria-type');

// 	counter++;

// 	var data="";



// 		data += '<tr>';

// 		data += '<td><input type="text" class="form-control idp-first-data-'+counter+'"></td>';

// 		data += '<td>';

// 		data += '<div class="no-padding col-xm-11 col-sm11 col-md-11 col-lg-11 "><input type="text" class="form-control idp-second-data-'+counter+'"></div>';

// 		data += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="EDeCvelopement-table"></span></div>';

// 		data += '</td>';

// 		data += '</tr>';



// 	if(type=="ECDevelopement"){

// 	$('.ECDevelopement-table tbody').append(data);

// 	}







// });





// $(document).on("click",".AddLine-3-column",function(){

// 	var type = $(this).attr('aria-type');

// 	counter++;

// 	var data="";



// 		data += '<tr>';

// 		data += '<td><input type="text" class="form-control ulearn-first-data-'+counter+'"></td>';

// 		data += '<td><input type="text" class="form-control ulearn-second-data-'+counter+'"></td>';

// 		data += '<td>';

// 		data += '<div class="no-padding col-xm-11 col-sm11 col-md-11 col-lg-11 "><input type="text" class="form-control ulearn-third-data-'+counter+'"></div>';

// 		data += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="UAUpdate-table"></span></div>';

// 		data += '</td>';

// 		data += '</tr>';



// 	if(type=="UAUpdate"){

// 		$('.UAUpdate-table tbody').append(data);

// 	}

	



// });



// $(document).on("click",".AddLine-7-column",function(){

// 	var type = $(this).attr('aria-type');

// 	counter++;

// 	var data="";



// 		data +=  '<tr>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

// 		data +=  '<td> Hey I </td>';

		

// 	if(type=="ASMSheet"){

// 		data +=  '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>';

// 		data +=  '</tr>';



// 		$('.ASMSheet-table tbody').append(data);

// 	}

// 	else if(type=="PITPlanned"){

// 		data +=  '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="PITPlanned-table"></span> </td>';

// 		data +=  '</tr>';



// 		$('.PITPlanned-table tbody').append(data);

// 	}



// });



// var table_tr = 1;



// $(document).on("click",".AddLine-2-table",function(){

// 	var type = $(this).attr('aria-type');

// 	table_tr++;



// 	counter++;

// 	var data="";

// 	console.log("yeah");

// 	data +='<tr class="tr_'+table_tr+'">' ;

// 	data +='  <td>';                                 

// 		data +=' <table class="col-sm-12 col-md-12 col-lg-12">'   ;                               

// 		data +=' <tr>'                                      ;

// 		data +='	<td class="border-bottom-only">';                                              

// 		data +=' 	<label class="form-label"> Compentency Excibit: Functional Expertise</label>'  ;                                    

// 		data +=' 	</td>'  ;                                         

// 		data +='	<td class="border-bottom-only">'  ;                                             

// 		data +=' 	<span class="glyphicon glyphicon-remove-circle remove-icon" btnum="'+table_tr+'" aria-table-name="removetable"></span>' ;                                     

// 		data +=' 	</td>';                                      

// 		data +=' </tr>' ;                                       

// 		data +=' <tr>'  ;                         

// 		data +=' 	<td class="col-md-6 col-lg-6"> Situation/ Task </td>' ;                    

// 		data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control sit-task_'+table_tr+'"> </td>'  ;       

// 		data +=' </tr>' ;                                        

		                                       

// 		data +='<tr>' ;                                           

// 		data +='	<td class="col-md-6 col-lg-6"> Action </td>' ;                                       

// 		data +='	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control action_'+table_tr+'"> </td>' ;                                     

// 		data +='</tr>' 

// 		data +='<tr>'                                      

// 		data +='	<td class="col-md-6 col-lg-6"> Result </td>' ;                                         

// 		data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control result_'+table_tr+'"> </td>'  ;                                       

// 		data +='</tr>' ;                                      

// 		data +='</table>'  ;                                   

// 	data +='</td>' ;                                 

// 	data +='</tr>' ;                                 

	                                   

// 	data +=' <tr class="tr_b'+table_tr+'">';                              

// 	data +=' <td>' ;                                 

// 		data +=' <table class="col-sm-12 col-md-12 col-lg-12">';                                 

// 		data +=' <tr>';                              

// 		data +=' 	<td class="border-bottom-only padding-top-20px">';                         

// 		data +=' 	<label class="form-label">Compentency Excibit: Thinks Customer</label>' ;                     

// 		data +=' 	</td>';     

// 		data +=' 	<td class="border-bottom-only padding-top-20px">';                                               

// 		data +=' 	<span class="glyphicon glyphicon-remove-circle remove-icon" btnum="b'+table_tr+'" aria-table-name="removetable"></span>';                                          

// 		data +=' 	</td>' ;                                      

// 		data +=' </tr>';                            

// 		data +=' <tr>'  ;                                                                             

// 		data +=' 	<td class="col-md-6 col-lg-6 "> Situation/ Task </td>';                                          

// 		data +=' 	<td class="col-md-6 col-lg-6 "> <input type="text" class="form-control sit-task_b'+table_tr+'"> </td>';                                     

// 		data +=' </tr>';

// 		data +=' <tr>'  ;                                    

// 		data +=' 	<td class="col-md-6 col-lg-6"> Action </td>' ;                                                                             

// 		data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control action_b'+table_tr+'"> </td>';                                      

// 		data +=' </tr>';

// 		data +=' <tr>';                                      

// 		data +=' 	<td class="col-md-6 col-lg-6"> Result </td>';                                            

// 		data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control result_b'+table_tr+'"> </td>';                                          

// 		data +=' </tr>'  ;                                     

// 		data +=' </table>' ;                                   

// 	data +='</td>'  ;                                 

// 	data +='</tr>';                                   



	



// $('.tbody_ce').append(data);



// });	



// $(document).on('click', '.btn-submit', function() {

// 	var type = $(this).attr('btnum');



// 	var fu_sit = '';

// 	var fu_action = '';

// 	var fu_result = '';



// 	var fu_sitb = '';

// 	var fu_actionb = '';

// 	var fu_resultb = '';



// 		for(x=1;x<=table_tr;x++) {

// 			if(x==table_tr) {

// 				fu_sit += $('.sit-task_'+x).val();

// 				fu_action += $('.action_'+x).val();

// 				fu_result += $('.result_'+x).val();



// 				fu_sitb += $('.sit-task_b'+x).val();

// 				fu_actionb += $('.action_b'+x).val();

// 				fu_resultb += $('.result_b'+x).val();

// 			} else {

// 				fu_sit += $('.sit-task_'+x).val()+'-';

// 				fu_action += $('.action_'+x).val()+'-';

// 				fu_result += $('.result_'+x).val()+'-';



// 				fu_sitb += $('.sit-task_b'+x).val()+'-';

// 				fu_actionb += $('.action_b'+x).val()+'-';

// 				fu_resultb += $('.result_b'+x).val()+'-';

// 			}

			

// 		}	

// 		var fu_sit_data = fu_sit.split('-');

// 		var fu_action_data = fu_action.split('-');

// 		var fu_result_data = fu_result.split('-');



// 		var fu_sitb_data = fu_sitb.split('-');

// 		var fu_actionb_data = fu_actionb.split('-');

// 		var fu_resultb_data = fu_resultb.split('-');



		



// 		$.ajax({

// 			type:'post',

// 			url:'<?=base_url()?>Ojl_completion/submit_competencies',

// 			data:{fu_sit_data:fu_sit_data, fu_action_data:fu_action_data, fu_result_data:fu_result_data,

// 				fu_sitb_data:fu_sitb_data, fu_actionb_data:fu_actionb_data, fu_resultb_data:fu_resultb_data,type}

// 		}).done(function(result) {

// 			alert('success');

// 		})

// })





// $(document).delegate(".AddLine-2-column","click",function(){

	

	 



// });





// $(document).delegate(".AddLine-2-column","click",function(){

	 

// });









// $(document).on("click",".remove-icon",function(){



// var tableName = $(this).attr('aria-table-name');

// var trData="";







// if(tableName == "EDeCvelopement-table"){

// 	 trData = $('.ECDevelopement-table tbody tr').length;	



// 	 if(trData>1){

// 	 $(this).closest("tr").remove();  

// 	 }

// 	 else{

// 	 	alert("unable to remove that row"); }

	 

// }



// else if(tableName == "UAUpdate-table"){

// 	 trData = $('.UAUpdate-table tbody tr').length;	



// 	 if(trData>1){

// 	 $(this).closest("tr").remove();  

// 	 }

// 	 else{

// 	 	alert("unable to remove that row"); }

	 

// }



// else if(tableName == "ASMSheet-table"){

// 	 trData = $('.ASMSheet-table tbody tr').length;	



// 	 if(trData>1){

// 	 $(this).closest("tr").remove();  

// 	 }

// 	 else{

// 	 	alert("unable to remove that row"); }

	 

// }



// else if(tableName == "PITPlanned-table"){

// 	 trData = $('.PITPlanned-table tbody tr').length;	



// 	 if(trData>1){

// 	 $(this).closest("tr").remove();  

// 	 }

// 	 else{

// 	 	alert("unable to remove that row");

// 	 }

	 

// }



// else if(tableName == "removetable"){



// 	 // trData = $('.PITPlanned-table tbody tr').length;	



// 	 // if(trData>1){

// 	 // $(this).closest("table").remove();  

// 	 // }

// 	 // else{

// 	 // 	alert("unable to remove that row"); alert('a');

// 	 // }

// 	 var trtr = $(this).attr('btnum')

// 	 $('.tr_'+trtr).remove();



// }







// });

</script>

