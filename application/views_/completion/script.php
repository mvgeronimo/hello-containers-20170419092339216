<script type="text/javascript">

$(document).ready(function() {
	var stars = $('.stars').val();
	stars = parseInt(stars);

	$(document).on('click', '.remove-comp', function() {
		
		// var stars = $('.stars').val();
		// stars = parseInt(stars);
		// stars--;
		// $('.stars').val(stars);
		var wew = $(this).closest('table');
		bootbox.confirm("<b>Are you sure you want to delete this record?</b>", function(e) {
			if(e) {
				wew.remove();
			}
		})
		
	})


	$(document).on('click', '.competency_addline', function() {
	var stars = $('.stars').val();
	stars = parseInt(stars);

	stars++;
	
	$('.stars').val(stars);
	$(this).css({'color':'white !important'}); 	
	var header = $('.stars_drp option:selected').html();
	var type = $('.stars_drp').val();

	var htm = '';


	htm += '<table class="table comp-table_'+stars+'" type="'+type+'">';
		htm += '<thead class="darkblue-bg">';
			htm += '<th class="no-border" colspan="2"  style="text-align:center;border:none !important">Competency Exhibit: '+header+'</th>';
			htm += '<th class="no-border"  style="text-align:center;width:3%;border:none !important"><span class="glyphicon glyphicon-remove-circle remove-comp remove-icon"></span></th>';
		htm += '</thead>';

		htm += '<tbody>';
			htm += '<tr style="background-color:#f3f2f0">';
				htm += '<td class="no-border" style="width:50%;text-align:center">Situation/Task</td>';
				htm += '<td class="no-border" colspan="2"><input type="text" class="form-control txt_sit_task txt_sit_task_'+stars+'"></td>';
			htm += '</tr>';

			htm += '<tr style="background-color:#dcd9d5">';
				htm += '<td class="no-border" style="width:50%;text-align:center">Action</td>';
				htm += '<td class="no-border" colspan="2"><input type="text" class="form-control txt_action txt_action_'+stars+'"></td>';
			htm += '</tr>';

			htm += '<tr style="background-color:#f3f2f0">';
				htm += '<td class="no-border" style="width:50%;text-align:center">Result</td>';
				htm += '<td class="no-border" colspan="2"><input type="text" class="form-control txt_result txt_result_'+stars+'"></td>';
			htm += '</tr>';

		htm += '</tbody>';



	htm += '</table>';	


	$('.competency_tables').append(htm);

	
})
	
}) 

counter = 1;
var attr = 0;
var attr2 = 0;

// var BlkAccountIdV = $('.stars_perf').val();
// var re = /[^0-9]/g;    
// if ( re.test(BlkAccountIdV) ){  
//     // found a non-numeric value, handling error
//     document.getElementById('lblAccountId').innerText = "Number Only";
//     errorflag=1;
// }

$(document).on('keyup', '.stars_perf', function() {
this.value = this.value.replace(/[^0-9\.]/g,'');  

})

function get_emp() {
	$.ajax({
		type:'post',
		url:'<?=base_url();?>Ojl_completion/get_emp'
	}).done(function(result) {
		var obj = JSON.parse(result);


		var agenda_status = $('.hidden_agenda_status').val();


		$.each(obj, function(x,y) {
			$('.empID').val(y.competency_id);
			$('.competency_id').val(y.competency_id);
			$('.psr_name').html(y.psr_name);
			$('.salary_grade').html(y.salary_grade);
			$('.territory').html(y.territory);
			$('.date_of_ojl').html(y.date_of_ojl);
			$('.competency_standards').html(y.competency_standard);
			$('.areas_of_improvement').val(y.areas_of_improvement);
			$('.training_intervention').val(y.training_intervention);
			$('#date_from').val(y.last_promotion_date);
		})

		if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
		    $('.main_emp_div').find('input').prop({'disabled':true});
		    $('.remove-icon, .AddLine').css({'pointer-events':'none'});
		}

		get_idp();
		get_ulearn();
		get_rates();

	})

}

function get_rates() {
	var dm = $('.hidden_dm').val();
	var psr = $('.hidden_psr').val();
	$.ajax({
         type:'get',
         url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/performance/exams',
         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
        }).done(function(result) {
        	var htm = '';
        	var obj = result;
        	console.log(obj);
       		var agenda_status = $('.hidden_agenda_status').val();

        	$.each(obj, function(x,y) {
        		var mth = y.StartDateTime;
        		var month = mth.substring(5, 7);
        		var n = y.ExamAverage;
        		(Math.round( n * 100 )/100 ).toString();
				
        		
        		if(month == '01') {
        			$('.month_1').html(n);
        		} else if(month == '02') {
        			$('.month_2').html(n.toFixed(2));
        		} else if(month == '03') {
        			$('.month_3').html(n.toFixed(2));
        		} else if(month == '04') {
        			$('.month_4').html(n.toFixed(2));
        		} else if(month == '05') {
        			$('.month_5').html(n.toFixed(2));
        		} else if(month == '06') {
        			$('.month_6').html(n.toFixed(2));
        		} else if(month == '07') {
        			$('.month_7').html(n.toFixed(2));
        		} else if(month == '08') {
        			$('.month_8').html(n.toFixed(2));
        		} else if(month == '09') {
        			$('.month_9').html(n.toFixed(2));
        		} else if(month == '10') {
        			$('.month_10').html(n.toFixed(2));
        		} else if(month == '11') {
        			$('.month_11').html(n.toFixed(2));
        		} else if(month == '12') {
        			$('.month_12').html(n.toFixed(2));
        		}
        	})


			if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
			    $('.main_emp_div').find('input').prop({'disabled':true});
			    $('.remove-icon, .AddLine').css({'pointer-events':'none'});
			}
        })
}



	function get_idp() {
		var competency_id = $('.competency_id').val();
		$.ajax({
			type:'post',
			url:'<?=base_url();?>Ojl_completion/get_idp',
			data:{'competency_id':competency_id, 'table':'ojl_idp'}
		}).done(function(result) {
			var obj = JSON.parse(result);
			var htm = '';
			attr = obj.length;
			var ztr = 1;

			$.each(obj, function(x,y) {
				htm += '<tr>';
					htm += '<td> <input type="text" class="form-control idp-first-data-'+ztr+'" name="first-data-'+ztr+'" value="'+y.skills_to_developed+'"> </td>';
					htm += '<td>';
						htm += '<div class="no-padding col-xs-11 col-sm-11 col-md-11 col-lg-11">';
							htm += '<input type="text" class="form-control idp-second-data-'+ztr+'" value="'+y.development_activity+'"></div>';
						htm += '</div>';	

						htm += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1">';
							htm += '<span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="EDeCvelopement-table"></span>';
						htm += '</div>';	
					htm += '</td>';
				htm += '</tr>';

				ztr++;
			})

			$('.tbody_idp').html(htm);

			var agenda_status = $('.hidden_agenda_status').val();
			if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
			    $('.main_emp_div').find('input').prop({'disabled':true});
			    $('.remove-icon, .AddLine').css({'pointer-events':'none'});
			}
			
		})
	}

	function get_ulearn() {
		var competency_id = $('.competency_id').val();

		$.ajax({
			type:'post',
			url:'<?=base_url();?>Ojl_completion/get_idp',
			data:{'competency_id':competency_id, 'table':'ojl_ulearn'}
		}).done(function(result) {
			var obj = JSON.parse(result);
			var htm = '';
			var xtr = 1;

			attr2 = obj.length;

			$.each(obj, function(x,y) {
				htm += '<tr>';
					htm += '<td> <input type="text" class="form-control ulearn-first-data-'+xtr+'" value="'+y.course_title+'"> </td>';
					htm += '<td> <input type="text" id="dates'+xtr+'" class="deyts form-control ulearn-second-data-'+xtr+'" value="'+y.comp_date+'"> </td>';
					
					htm += '<td>';
						htm += '<div class="no-padding col-xs-11 col-sm-11 col-md-11 col-lg-11">';
							htm += '<input type="text" class="form-control ulearn-third-data-'+xtr+'" value="'+y.learning_application+'">';
						htm += '</div>';

						htm += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> ';
							htm += '<span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="UAUpdate-table"></span>';
						htm += '</div> ';
					htm += '</td>';
				htm += '</tr>';
				xtr++;
	            
			})
			$('.tbody_ulearn').html(htm);

			var agenda_status = $('.hidden_agenda_status').val();
			if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
			    $('.main_emp_div').find('input').prop({'disabled':true});
			    $('.remove-icon, .AddLine').css({'pointer-events':'none'});	
			}
		})
	}


$(document).on('change', '.ulearn_date_picker', function() {

	// var date_from = new Date($(this).val());

	//  var d = new Date();


 //     if(date_from < d) {
 //      alert('This date in invalid becase it is already done');
 //   		 $(this).val($.datepicker.formatDate('mm/dd/yy', d));
 //     } else {

 //     }

})

$(document).on("click",".flex-control-paging li a",function(){
$('.flex-control-paging li a').removeClass("activePage");
$(this).addClass("activePage");
});



$(document).on("click",".i",function(){
	var agenda_id = $('.hidden_agenda').val();
	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {
		window.location = '<?=base_url();?>agenda/edit_agenda/'+agenda_id;
	}
	
});


$(document).on("click",".ii",function(){
	var agenda_id = $('.hidden_agenda').val();
	var hidden_step = $('.hidden_step').val();

	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {

		if(hidden_step >= 2) {
			window.location = '<?=base_url();?>Agenda/edit_itinerary?id='+agenda_id;
		}
	}
});

$(document).on("click",".iii",function(){
	var agenda_id = $('.hidden_agenda').val();
	var hidden_step = $('.hidden_step').val();

	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {
		if(hidden_step >= 3) {
			window.location = '<?=base_url();?>Sales_plan_for_the_month?id='+agenda_id;
		}
	}
});

$(document).on("click",".iv",function(){
	var agenda_id = $('.hidden_agenda').val();
	var hidden_step = $('.hidden_step').val();

	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {
		if(hidden_step >= 4) {
			window.location = '<?=base_url();?>Coverage_performance_monitoring?id='+agenda_id;
		}
		
	}
});



$(document).on("click",".v",function(){
	//start_ojl('start_ojl_completion');
	var agenda_id = $('.hidden_agenda').val();
	var hidden_step = $('.hidden_step').val();
	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {
		if(hidden_step >= 5) {
			window.location = '<?=base_url();?>Ojl_completion?id='+agenda_id;
		}
	}
});



$(document).on("click",".vi, .PCE-StoryTelling-page",function(){



	var agenda_id = $('.hidden_agenda').val();
	// start_ojl('product_communication');
	var step = $('.hidden_step').val();

	//if(step >= 7) {

		$('.flex-control-paging li a').removeClass("activePage");
		$('.vi').addClass("activePage");
		var next_step = 7;
		if(step < next_step) {
			step_up(step, next_step, "<?=base_url() ?>ojl_completion/product_communication?id="+agenda_id);
		} else {
			window.location.href = "<?=base_url() ?>ojl_completion/product_communication?id="+agenda_id;
		}
	//}
	
		

});

$(document).on("click",".xi",function(){
	//start_ojl('start_ojl_completion');
	var agenda_id = $('.hidden_agenda').val();
	var hidden_step = $('.hidden_step').val();
	if(agenda_id == '' || agenda_id == undefined || agenda_id == null) {

	} else {
		if(hidden_step >= 11) {
			window.location = '<?=base_url();?>ojl_evaluation?id='+agenda_id;
		}
	}
});

function step_up(step, next_step, url) {

		$.ajax({
			type:'post',
			url:'<?=base_url();?>ojl_schedule/step',
			data:{"step":next_step}
		}).done(function(res) {
			window.location.href = url;
		})
}


$(document).on("click", ".SDPharmacies", function() {
	var agenda_id = $('.hidden_agenda').val();
	var step = $('.hidden_step').val();

	$('.flex-control-paging li a').removeClass("activePage");
		$('.vii').addClass("activePage");
		var next_step = 8;
		if(step < next_step) {
			step_up(step, next_step, "<?=base_url() ?>ojl_completion/survey_drugstore_pharmacies?id="+agenda_id);
		} else {
			window.location.href = "<?=base_url() ?>ojl_completion/survey_drugstore_pharmacies?id="+agenda_id;
		}
})


$(document).on("click",".vii",function(){

	// start_ojl('Survey_Drugstore_Pharmacies');

	var agenda_id = $('.hidden_agenda').val();
	// start_ojl('product_communication');
	var step = $('.hidden_step').val();

	if(step >= 8) {
		$('.flex-control-paging li a').removeClass("activePage");
		$('.vii').addClass("activePage");
		var next_step = 8;
		if(step < next_step) {
			step_up(step, next_step, "<?=base_url() ?>ojl_completion/survey_drugstore_pharmacies?id="+agenda_id);
		} else {
			window.location.href = "<?=base_url() ?>ojl_completion/survey_drugstore_pharmacies?id="+agenda_id;
		}
	}
	
});


$(document).on("click", ".Competitors-Activity-Report", function() {
	var agenda_id = $('.hidden_agenda').val();
	var step = $('.hidden_step').val();

	$('.flex-control-paging li a').removeClass("activePage");
		$('.viii').addClass("activePage");
		var next_step = 9;
		if(step < next_step) {
			step_up(step, next_step, "<?=base_url() ?>ojl_completion/competitors_activity_report?id="+agenda_id);
		} else {
			window.location.href = "<?=base_url() ?>ojl_completion/competitors_activity_report?id="+agenda_id;
		}
})

$(document).on("click",".viii",function(){

	// start_ojl('Competitors_Activity_Report');

	var agenda_id = $('.hidden_agenda').val();
	// start_ojl('product_communication');
	var step = $('.hidden_step').val();

	if(step >= 9) {
		$('.flex-control-paging li a').removeClass("activePage");
		$('.viii').addClass("activePage");
		var next_step = 9;
		if(step < next_step) {
			step_up(step, next_step, "<?=base_url() ?>ojl_completion/competitors_activity_report?id="+agenda_id);
		} else {
			window.location.href = "<?=base_url() ?>ojl_completion/competitors_activity_report?id="+agenda_id;
		}
	}
	

	
});


$(document).on("click",".ix",function(){

	// start_ojl('Employee_Compentency_Development');
	var agenda_id = $('.hidden_agenda').val();

	$.ajax({
		type:'post',
		url:'<?=base_url();?>ojl_completion/check_is_api',
		data:{'agenda_id':agenda_id}
	}).done(function(result) {
		// if(result == 0) { ---change of steps 12-15-16----
		// 	bootbox.alert("<b>You cannot proceed to the next step yet. Please complete all previous steps.</b>");


		// } else {
		// 	var step = $('.hidden_step').val();
		// 	var next_step = 9;
		// 	if(step < next_step) {
		// 		step_up(step, next_step, "<?=base_url() ?>ojl_completion/employee_compentency_development?id="+agenda_id);
		// 	} else {
		// 		window.location.href = "<?=base_url() ?>ojl_completion/employee_compentency_development?id="+agenda_id;
		// 	}

		var step = $('.hidden_step').val();

			if(step >= 6) {
				var next_step = 6;
					$('.flex-control-paging li a').removeClass("activePage");
					$('.ix').addClass("activePage");
				if(step < next_step) {
					step_up(step, next_step, '<?=base_url();?>Employee_competency_development?id='+agenda_id);
				} else {
					window.location.href = '<?=base_url();?>Employee_competency_development?id='+agenda_id;
				}
			}
			


	})

	// $.ajax({
	// 	type:'post',
	// 	url:'<?=base_url();?>ojl_schedule/step',
	// 	data:{"step":'9'}
	// }).done(function(res) {
	// 	window.location.href = "<?=base_url() ?>ojl_completion/employee_compentency_development";
	// })
	
	
	
});

$(document).on("click", ".x", function() {
	var agenda_id = $('.hidden_agenda').val();
	var step = $('.hidden_step').val();

	$('.flex-control-paging li a').removeClass("activePage");
	if(step >= 10) {
		window.location.href = "<?=base_url() ?>ojl_completion/activity_and_starts_monitoring_sheet?id="+agenda_id
	}
})

$(document).on("click", '.EC-Development', function() {
	var agenda_id = $('.hidden_agenda').val();

	$('.flex-control-paging li a').removeClass("activePage");
			// $('.x').addClass("activePage");
			// start_ojl('Activity_and_Starts_Monitoring_Sheet');
				page = 'Activity_and_Starts_Monitoring_Sheet';

				
				append_plan(1);
				append_plan(2);


	$.ajax({
		type:'post',
		url:'<?=base_url();?>ojl_completion/check_is_api',
		data:{'agenda_id':agenda_id}
	}).done(function(result) {

		var step = $('.hidden_step').val();

		
			if(result == 0) {
				bootbox.alert("<b>To proceed to the next step, please complete all previous steps.</b>");
			} else {

				
				var next_step = 10;
				if(step < next_step) {
					step_up(step, next_step, '<?=base_url();?>ojl_completion/activity_and_starts_monitoring_sheet?id='+agenda_id);
				} else {
					window.location.href = "<?=base_url() ?>ojl_completion/activity_and_starts_monitoring_sheet?id="+agenda_id;
				}
				
			}
		

		

		

	})
})

$(document).on("click",".RemarksEvaluation",function(){
	var agenda_status = $('.hidden_agenda_status').val();
	var agenda_id = $('.hidden_agenda').val();

	if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
	    window.location.href = "<?=base_url() ?>Ojl_completion?id="+agenda_id;
	}
	else{
		
		insert_idp();
	}


	

	// $.ajax({
	// 	type:'post',
	// 	url:'<?=base_url();?>ojl_completion/check_is_api',
	// 	data:{'agenda_id':agenda_id}
	// }).done(function(result) {
	// 	if(result == 0) {
	// 		bootbox.alert("<b>You cannot proceed to the next step yet. Please complete all previous steps.</b>");

			
	// 	} else {

			
			
	// 	}
	// })


	
});

function append_plan(type) {
	$.ajax({
		type:'post',
		url:'<?=base_url();?>Ojl_completion/get_plan',
		data:{type:type}
	}).done(function(result) {
		var obj = JSON.parse(result);
		var htm = '';

		$.each(obj, function(x,y) {
			htm += '<tr>';
				htm += '<td>'+y.product+'</td>';
				htm += '<td>'+y.name_of_program+'</td>';
				htm += '<td>'+y.planned+'</td>';
				htm += '<td>'+y.actual+'</td>';
				htm += '<td>'+y.perf+'</td>';
				htm += '<td>'+y.date_impletemented+'</td>';
				htm += '<td>'+y.remarks+'</td>';
				htm += '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>'
			htm += '</tr>';
		})

	
		if(type == 1) {

			$('.tb_plan').append(htm);
		} else {
			$('.tb_top_plan').append(htm);
		}

	// alert(type);		                                    

	})
}

function insert_idp() {
	 var IDP = $('.ECDevelopement-table tbody tr').length;
	 var Ulearn = $('.ECDevelopement-table tbody tr').length;
	 var idpFirst = "";
	 var idpSecond = "";
	 var comp_id = $('.empID').val();
	 



	 // $('.ECDevelopement-table tbody tr').find('input').each(function(x,y){
	 // console.log(y);
	 	

	 // });

	var a = 1;
	 for( i=1;i<=attr;i++){

	 	if(a==attr) {
	 		if($('.idp-first-data-'+i).val() != undefined) {
	 		// alert($('.idp-first-data-'+i).val());

		 		 idpFirst += ($('.idp-first-data-'+i).val());
		 		 idpSecond += ($('.idp-second-data-'+i).val());
		 	}

	 	} else {
	 		if($('.idp-first-data-'+i).val() != undefined) {
	 		// alert($('.idp-first-data-'+i).val());

		 		 idpFirst += ($('.idp-first-data-'+i).val()) +"-";
		 		 idpSecond += ($('.idp-second-data-'+i).val()) +"-";
		 	}
	 	}
	 	
	 	  // if(i == IDP) {
	 	  // 	idpFirst += ($('.idp-first-data-'+i).val());
	 	 	// idpSecond += ($('.idp-second-data-'+i).val());
	 	  // } else {
	 	  // 	 idpFirst += ($('.idp-first-data-'+i).val()) +"-";
	 		 // idpSecond += ($('.idp-second-data-'+i).val()) +"-";
	 	  // }
	 	  a++;
		 }

	 var idpFirstData = idpFirst.split("-");
	 var idpSecondData = idpSecond.split("-");

	 
	 	$.ajax({
		 		type:'post',
		 		url:'<?= base_url() ?>ojl_completion/deletePreviousData',
		 		data:{comp_id:comp_id, table:'ojl_idp'}
		 }).done(function(data){
				  $.ajax({
				 		type:'post',
				 		url:'<?= base_url() ?>ojl_completion/tempData',
				 		data:{comp_id:comp_id, idpFirstData:idpFirstData, idpSecondData:idpSecondData}
				 }).done(function(data){

				 	insert_ulearn();
				 });
		 });
	 
	 


		
// console.log(idpFirstData);
// console.log(idpSecondData);


	  


	
}

function insert_ulearn() {
	var Ulearn = $('.UAUpdate-table tbody tr').length;
	var b=1;
	var ulearFirst = "";
	var ulearnSecond = "";
	var ulearnThird = "";
	var comp_id = $('.empID').val();
	 for( i=1;i<=attr2;i++){



	 	if(b==attr2) {
	 		if($('.ulearn-first-data-'+i).val() != undefined) {
 			ulearFirst 	 += ($('.ulearn-first-data-'+i).val());
			ulearnSecond += ($('.ulearn-second-data-'+i).val());
			ulearnThird  += ($('.ulearn-third-data-'+i).val());
		 	}

	 	} else {
	 		
	 		if($('.ulearn-first-data-'+i).val() != undefined) {
	 		// alert($('.idp-first-data-'+i).val());
			ulearFirst 	 += ($('.ulearn-first-data-'+i).val()) +"-";
			ulearnSecond += ($('.ulearn-second-data-'+i).val()) +"-";
			ulearnThird  += ($('.ulearn-third-data-'+i).val()) + "-";
	 		}
	 	}

		b++;
	}

	var ulearFirstData = ulearFirst.split("-");
	var ulearnSecondData = ulearnSecond.split("-");
	var ulearnThirdData = ulearnThird.split("-");

	// alert(ulearnSecondData);
	// alert(attr2);
	//exit(0);

	
	 	$.ajax({
		 		type:'post',
		 		url:'<?= base_url() ?>ojl_completion/deletePreviousData',
		 		data:{comp_id:comp_id, table:'ojl_ulearn'}
		 }).done(function(){
		 		 $.ajax({
			 		type:'post',
			 		url:'<?= base_url() ?>ojl_completion/tempData2',
		 			data:{comp_id:comp_id, ulearFirstData:ulearFirstData, ulearnSecondData:ulearnSecondData,  ulearnThirdData:ulearnThirdData}
		 		}).done(function(data){

		 			var step = $('.hidden_step').val();
					var next_step = 6;
					if(step < next_step) {
						$.ajax({
							type:'post',
							url:'<?=base_url();?>ojl_schedule/step',
							data:{"step":next_step}
						}).done(function(res) {

							var comf_id = $('.empID').val();
							var datesss = $('#date_from').val();
							var areas = $('.areas_of_improvement').val();
							var training_intervention = $('.training_intervention').val();
							var agenda_id = $('.hidden_agenda').val();

							$.ajax({
								type:'post',
								url:'<?=base_url();?>ojl_completion/update_mp',
								data:{'comf_id':comf_id, 'datesss':datesss, 'areas':areas, 'training_intervention':training_intervention}
							}).done(function(result) {
								bootbox.alert("<b>Your entry is successfully saved.</b>", function() {
								window.location.href = "<?=base_url() ?>Ojl_completion?id="+agenda_id;
								})
								
							})

							
						})
					} else {
							var comf_id = $('.empID').val();
							var datesss = $('#date_from').val();
							var areas = $('.areas_of_improvement').val();
							var training_intervention = $('.training_intervention').val();
							var agenda_id = $('.hidden_agenda').val();

							$.ajax({
								type:'post',
								url:'<?=base_url();?>ojl_completion/update_mp',
								data:{'comf_id':comf_id, 'datesss':datesss, 'areas':areas, 'training_intervention':training_intervention}
							}).done(function(result) {
								bootbox.alert("<b>Your entry is successfully saved.</b>", function() {
									window.location.href = "<?=base_url() ?>Ojl_completion?id="+agenda_id;
								})
								
							})

					}

		 			
		 			
			 	});
		 });
	 
	 


	
}



$(document).on("click",".AddLine-2-column",function(){
	var type = $(this).attr('aria-type');
	attr++;

	counter++;
	if(type=="ECDevelopement"){
		var count = $('.ECDevelopement-table tbody tr').length;
	}
	count++;
	var data="";

		data += '<tr>';
		data += '<td><input type="text" class="form-control idp-first-data-'+attr+'"></td>';
		data += '<td>';
		data += '<div class="no-padding col-xm-11 col-sm11 col-md-11 col-lg-11 "><input type="text" class="form-control idp-second-data-'+count+'"></div>';
		data += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="EDeCvelopement-table"></span></div>';
		data += '</td>';
		data += '</tr>';

	if(type=="ECDevelopement"){
	$('.ECDevelopement-table tbody').append(data);
	}


});


$(document).on("click",".AddLine-3-column",function(){
	var type = $(this).attr('aria-type');
	counter++;
	attr2++;
	var count = $('.UAUpdate-table tbody tr').length;

	count++;
	var data="";

		data += '<tr>';
		data += '<td><input type="text" class="form-control ulearn-first-data-'+attr2+'"></td>';
		data += '<td><input type="text" class="ulearn_date_picker form-control ulearn-second-data-'+attr2+'"></td>';
		data += '<td>';
		data += '<div class="no-padding col-xm-11 col-sm11 col-md-11 col-lg-11 "><input type="text" class="form-control ulearn-third-data-'+attr2+'"></div>';
		data += '<div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="UAUpdate-table"></span></div>';
		data += '</td>';
		data += '</tr>';

	if(type=="UAUpdate"){
		$('.UAUpdate-table tbody').append(data);

		$( ".ulearn-second-data-"+attr2).datepicker();
	}
	

});

$(document).on("click",".AddLine-7-column",function(){
	var type = $(this).attr('aria-type');
	counter++;
	
	var data="";

		
		
	if(type=="ASMSheet"){
		plan_ctr++;
		data +=  '<tr>';
		data +=  '<td><input type="text" class="planned_product planned_product_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_nop planned_nop_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_planned stars_perf planned_planned_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_actual stars_perf planned_actual_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_perf stars_perf planned_perf_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_date_impletemented planned_date_impletemented_'+plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="planned_remarks planned_remarks_'+plan_ctr+'"></td>';

		data +=  '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="ASMSheet-table"></span> </td>';
		data +=  '</tr>';

		$('.ASMSheet-table tbody').append(data);

		$( ".planned_date_impletemented_"+plan_ctr).datepicker();
	}
	else if(type=="PITPlanned"){
		top_plan_ctr++;

		data +=  '<tr>';
		data +=  '<td><input type="text" class="top_planned_product top_planned_product_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_nop top_planned_nop_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_planned stars_perf top_planned_planned_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_actual stars_perf top_planned_actual_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_perf stars_perf top_planned_perf_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_date_impletemented top_planned_date_impletemented_'+top_plan_ctr+'"></td>';
		data +=  '<td><input type="text" class="top_planned_remarks top_planned_remarks_'+top_plan_ctr+'"></td>';

		data +=  '<td class="no-padding-left no-border"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="PITPlanned-table"></span> </td>';
		data +=  '</tr>';

		$('.PITPlanned-table tbody').append(data);

		$( ".top_planned_date_impletemented_"+top_plan_ctr).datepicker();
	}

});

var table_tr = 1;

$(document).on("click",".AddLine-2-table",function(){
	var type = $(this).attr('aria-type');
	table_tr++;

	counter++;
	var data="";
	console.log("yeah");
	                                   

	data += '<div class="note">';
	data += '<h4>';
		data+='S.T.A.R.S noted: Demonstrates Functional Expertise, Think Customer, Drives Innovation, Exemplifies Leadership';
	data += '</h4>';
	data += '</div>';


	data += '<table class="table table-bordered CompentencyExcibit col-sm-12 col-md-12 col-lg-12 ">';
		data += '<tbody class="tbody_ce">';

			data +='<tr class="tr_'+table_tr+'">' ;
			data +='  <td>';                                 
				data +=' <table class="col-sm-12 col-md-12 col-lg-12">'   ;                               
				data +=' <tr>'                                      ;
				data +='	<td class="border-bottom-only">';                                              
				data +=' 	<label class="form-label"> Compentency Excibit: Functional Expertise</label>'  ;                                    
				data +=' 	</td>'  ;                                         
				data +='	<td class="border-bottom-only">'  ;                                             
				data +=' 	<span class="glyphicon glyphicon-remove-circle remove-icon" btnum="'+table_tr+'" aria-table-name="removetable"></span>' ;                                     
				data +=' 	</td>';                                      
				data +=' </tr>' ;                                       
				data +=' <tr>'  ;                         
				data +=' 	<td class="col-md-6 col-lg-6"> Situation/Task </td>' ;                    
				data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control sit-task_'+table_tr+'"> </td>'  ;       
				data +=' </tr>' ;                                        
				                                       
				data +='<tr>' ;                                           
				data +='	<td class="col-md-6 col-lg-6"> Action </td>' ;                                       
				data +='	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control action_'+table_tr+'"> </td>' ;                                     
				data +='</tr>' 
				data +='<tr>'                                      
				data +='	<td class="col-md-6 col-lg-6"> Result </td>' ;                                         
				data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control result_'+table_tr+'"> </td>'  ;                                       
				data +='</tr>' ;                                      
				data +='</table>'  ;                                   
			data +='</td>' ;                                 
			data +='</tr>' ;                                 
			                                   
			data +=' <tr class="tr_b'+table_tr+'">';                              
			data +=' <td>' ;                                 
				data +=' <table class="col-sm-12 col-md-12 col-lg-12">';                                 
				data +=' <tr>';                              
				data +=' 	<td class="border-bottom-only padding-top-20px">';                         
				data +=' 	<label class="form-label">Compentency Excibit: Thinks Customer</label>' ;                     
				data +=' 	</td>';     
				data +=' 	<td class="border-bottom-only padding-top-20px">';                                               
				data +=' 	<span class="glyphicon glyphicon-remove-circle remove-icon" btnum="b'+table_tr+'" aria-table-name="removetable"></span>';                                          
				data +=' 	</td>' ;                                      
				data +=' </tr>';                            
				data +=' <tr>'  ;                                                                             
				data +=' 	<td class="col-md-6 col-lg-6 "> Situation/Task </td>';                                          
				data +=' 	<td class="col-md-6 col-lg-6 "> <input type="text" class="form-control sit-task_b'+table_tr+'"> </td>';                                     
				data +=' </tr>';
				data +=' <tr>'  ;                                    
				data +=' 	<td class="col-md-6 col-lg-6"> Action </td>' ;                                                                             
				data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control action_b'+table_tr+'"> </td>';                                      
				data +=' </tr>';
				data +=' <tr>';                                      
				data +=' 	<td class="col-md-6 col-lg-6"> Result </td>';                                            
				data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control result_b'+table_tr+'"> </td>';                                          
				data +=' </tr>'  ;     

				data +=' <tr>';                                      
				data +=' 	<td class="col-md-6 col-lg-6"> Alternative Action </td>';                                            
				data +=' 	<td class="col-md-6 col-lg-6"> <input type="text" class="form-control alternative_b'+table_tr+'"> </td>';                                          
				data +=' </tr>'  ;     

				data +=' </table>' ;                                   
			data +='</td>'  ;                                 
			data +='</tr>';

		data += '</tbody>';
	data += '</table>';
	

$('.addFunctionalExpertise').append(data);

});	




$(document).on('change', '.stars_drp', function() {

	var val = $(this).val();
	if(val != 'all') {
		$('.competency_addline').css({'pointer-events':'all'});
	}
	

})

$(document).on('click', '.btn-nexteval', function() {
	var agenda_status = $('.hidden_agenda_status').val();
	if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
		window.location.href = '<?=base_url();?>Ojl_evaluation';
	}

});



$(document).on('click', '.btn-submit', function() {
	var type = $(this).attr('btnum');
	var mp_id = $('.hidden_mp_id').val();
	
	// $(document).find('.tb_top_plan tr').each(function(x,y) {
	// 	var top_planned_product = $(this).find('.top_planned_product').val();
	// 	var top_planned_name_of_program = $(this).find('.top_planned_nop').val();
	// 	var top_planned_planned = $(this).find('.top_planned_planned').val();
	// 	var top_planned_actual = $(this).find('.top_planned_actual').val();
	// 	var top_planned_perf = $(this).find('.top_planned_perf').val();
	// 	var top_planned_date_impletemented = $(this).find('.top_planned_date_impletemented').val();
	// 	var top_planned_remarks = $(this).find('.top_planned_remarks').val();
	// 	alert(top_planned_product+', '+top_planned_name_of_program+', '+top_planned_planned+', '+top_planned_actual+', '+top_planned_perf+', '+top_planned_date_impletemented+', '+top_planned_remarks);
	// })
	// exit(0);
	
	
	$.ajax({
		type:'post',
		url:'<?=base_url();?>ojl_completion/delete_plan',
		data:{'mp_id':mp_id}
	}).done(function(result) {

		if(result == 'success') {
			var v = 1;
			//for(v=1;v<=plan_ctr;v++) {
			$(document).find('.tb_plan tr').each(function() {

				
				var planned_product = $(this).find('.planned_product').val();
				var planned_name_of_program = $(this).find('.planned_nop').val();
				var planned_planned = $(this).find('.planned_planned').val();
				var planned_actual = $(this).find('.planned_actual').val();
				var planned_perf = $(this).find('.planned_perf').val();
				var planned_date_impletemented = $(this).find('.planned_date_impletemented').val();
				var planned_remarks = $(this).find('.planned_remarks').val();
				
				if(planned_product != undefined) {
					$.ajax({
						type:'post',
						url:'<?=base_url();?>ojl_completion/insert_planned',
						data:{'planned_product':planned_product, 'planned_name_of_program':planned_name_of_program, 'planned_planned':planned_planned,
							'planned_actual':planned_actual, 'planned_perf':planned_perf, 'planned_date_impletemented':planned_date_impletemented,
							'planned_remarks':planned_remarks, 'mp_id':mp_id, 'type':'1'
						}
					}).done(function() {
						
					})
				}	
				v++;
			})

			$(document).find('.tb_top_plan tr').each(function() {
				
				var top_planned_product = $(this).find('.top_planned_product').val();
				var top_planned_name_of_program = $(this).find('.top_planned_nop').val();
				var top_planned_planned = $(this).find('.top_planned_planned').val();
				var top_planned_actual = $(this).find('.top_planned_actual').val();
				var top_planned_perf = $(this).find('.top_planned_perf').val();
				var top_planned_date_impletemented = $(this).find('.top_planned_date_impletemented').val();
				var top_planned_remarks = $(this).find('.top_planned_remarks').val();
				
				//if(top_planned_product != undefined) {
					$.ajax({
						type:'post',
						url:'<?=base_url();?>ojl_completion/insert_planned',
						data:{'planned_product':top_planned_product, 'planned_name_of_program':top_planned_name_of_program, 'planned_planned':top_planned_planned,
							'planned_actual':top_planned_actual, 'planned_perf':top_planned_perf, 'planned_date_impletemented':top_planned_date_impletemented,
							'planned_remarks':top_planned_remarks, 'mp_id':mp_id, 'type':'2'
						}
					}).done(function() {


						
					})


				//}

					//end if for submit competencies

				
				
			})


			$.ajax({
						type:'post',
						url:'<?=base_url();?>ojl_completion/delete_comp',
						data:{'mp_id':mp_id}
					}).done(function(result) {
						var stars = $('.stars').val();
						for(x=1;x<=stars;x++) {
							var sit_task = $('.txt_sit_task_'+x).val();
							var action = $('.txt_action_'+x).val();
							var result = $('.txt_result_'+x).val();
							var com_type = $('.comp-table_'+x).attr('type');

							if(sit_task != undefined) {
								$.ajax({
									type:'post',
									url:'<?=base_url();?>Ojl_completion/submit_competencies2',
									data:{"sit_task":sit_task,"action":action,"result":result,"com_type":com_type,"mp_id":mp_id}
								}).done(function() {

								})
							}

							
						}
					
							

					})


			update_mp_status(type, mp_id);

		} //END OF if for result
		

		

		// alert('success');
		// window.location = '<?=base_url();?>Ojl_evaluation';





	}) // end of ajax for delete plan



	

	
})

function update_mp_status(type, mp_id) {

	$.ajax({
		type:'post',
		url:'<?=base_url();?>Ojl_completion/update_mp_status',
		data:{'type':type, 'mp_id':mp_id}
	}).done(function(result) {
		if(type == 1) {

			bootbox.alert("<b>Your entry is successfully saved as draft.</b>");
		} else {
			bootbox.alert("<b>Your entry is successfully saved.</b>", function() {
				var step = $('.hidden_step').val();
				var next_step = 11;
				if(step < next_step) {
					step_up(step, next_step, '<?=base_url();?>Ojl_evaluation');
				} else {
					window.location.href = '<?=base_url();?>Ojl_evaluation';
				}
				
			});
		}
	})
}




$(document).delegate(".AddLine-2-column","click",function(){
	
	 

});


$(document).delegate(".AddLine-2-column","click",function(){
	 
});


$(document).on('click', '.cancel_activity', function() {
	var tr_plan = $('.tb_plan tr').length;
	var tr_top_plan = $('.tb_top_plan tr').length;
	var competency_tables = $('.competency_tables table').length;


	var vals = 0;
	$('.tb_plan tr input').each(function() {
		var inputs = $(this).val();
		if(inputs != '') {
			vals++;
		}
	})

	$('.tb_top_plan tr input').each(function() {
		var inputs = $(this).val();
		if(inputs != '') {
			vals++;
		}
	})

	$('.competency_tables table input').each(function() {
		var inputs = $(this).val();
		if(inputs != '') {
			vals++;
		}
	})

	
	if(vals == 0) {
		location.reload();
	} else {
		bootbox.confirm("<b>Are you sure you want to cancel? All changes will not be saved.</b>", function(e) {
			if(e) {
				location.reload();
			}
		})
	}
	
})

$(document).on("click",".remove-icon",function(){

var tableName = $(this).attr('aria-table-name');
var trData="";



if(tableName == "EDeCvelopement-table"){
	 trData = $('.ECDevelopement-table tbody tr').length;	
	 
	 var closest = $(this).closest("tr");
	 bootbox.confirm("<b>Are you sure you want to remove this row?</b>", function(e) {

	 	if(e == true) {
	 		closest.remove();
	 	}
	 })

	  
	 // if(trData>1){
	 // $(this).closest("tr").remove();  
	 // }
	 // else{
	 // 	alert("unable to remove that row"); }
	 
}

else if(tableName == "UAUpdate-table"){
	 trData = $('.UAUpdate-table tbody tr').length;	

	  var closest = $(this).closest("tr");
	 bootbox.confirm("<b>Are you sure you want to remove this row?</b>", function(e) {

	 	if(e == true) {
	 		closest.remove();
	 	}
	 })
	 // if(trData>1){
	 // $(this).closest("tr").remove();  
	 // }
	 // else{
	 // 	alert("unable to remove that row"); }
	 
}

else if(tableName == "ASMSheet-table"){
	 trData = $('.ASMSheet-table tbody tr').length;	

	  var closest = $(this).closest("tr");  
	  bootbox.confirm("<b>Are you sure you want to remove this row?</b>", function(e) {

	 	if(e == true) {
	 		closest.remove();
	 	}
	 })

	 // if(trData>1){
	 // $(this).closest("tr").remove();  
	 // }
	 // else{
	 // 	alert("unable to remove that row"); }
	 
}

else if(tableName == "PITPlanned-table"){
	 trData = $('.PITPlanned-table tbody tr').length;	
	 var closest = $(this).closest("tr");  
	  bootbox.confirm("<b>Are you sure you want to remove this row?</b>", function(e) {

	 	if(e == true) {
	 		closest.remove();
	 	}
	 })
	 // if(trData>1){
	 // $(this).closest("tr").remove();  
	 // }
	 // else{
	 // 	alert("unable to remove that row");
	 // }
	 
}

else if(tableName == "removetable"){

	 // trData = $('.PITPlanned-table tbody tr').length;	

	 // if(trData>1){
	 // $(this).closest("table").remove();  
	 // }
	 // else{
	 // 	alert("unable to remove that row"); alert('a');
	 // }
	 var trtr = $(this).attr('btnum')
	 $('.tr_'+trtr).remove();

}



});


</script>