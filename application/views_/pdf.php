<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-table.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	var agenda_id = $('.agenda_id').val();
	

	$.ajax({
		type:'post',
		url:'<?=base_url();?>Generate_agenda/get_agenda',
		data:{"agenda_id":agenda_id}
	}).done(function(result) {
		var obj = JSON.parse(result);
		var dm = '';
		var psr = '';
		$.each(obj, function(x,y) {
			dm = y.user_id;
			psr = y.psr_id;

			get_cp(dm, psr);
		})

	})

	function get_cp(dm, psr) {
		$.ajax({
	     type:'get',
	     url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/performance/callrates',
	     data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
	    }).done(function(result) {
	    	
	    	var cycle = '';
	    	var rate = ''
	    	var header = 0;
	     	$.each(result, function(x,y) {
	     		cycle+='<td>'+y.Cycle+'</td>';
	     		rate += y.ActualCallRate+',';
	     		header++;
	     	})

	     	//alert(cycle);
	     	// get_pdf(cycle, rate, header, agenda_id);

	     	get_online_exam(agenda_id, dm, psr, header, rate);
	     	//window.location = '<?=base_url();?>Generate_agenda/training_dept_via_pdf2/'+agenda_id+'/'+header+'?rate='+rate;

	     // 	$('.cycle').append(cycle);
	     // 	$('.rate').append(rate);
	     // 	$('.cycle_header').attr('colspan', header);

	    })

	}

	function get_online_exam(agenda_id, dm, psr, header, rate) {
		$.ajax({
         type:'get',
         url:'http://phmdabigsvr1.unilab.com.ph/WebAPI_BiomedisOJL/api/performance/exams',
         data:{'token':'OH769B94G0XXXVKHF8GYY0KTKK5QSTHP', 'empid_dm':dm, 'empid_psr':psr,'year':'2016'}
        }).done(function(result) {
        	var htm = '';
        	var obj = result;
        	console.log(obj);
       		var agenda_status = $('.hidden_agenda_status').val();
       		var exams = '';

        	$.each(obj, function(x,y) {
        		var mth = y.StartDateTime;
        		var month = mth.substring(5, 7);
        		var n = y.ExamAverage;
        		(Math.round( n * 100 )/100 ).toString();
				
        		
        		if(month == '01') {
        			
        				exams += '01='+n+',';
        			
        			
        		} else if(month == '02') {
        			
        				exams += '02='+n.toFixed(2)+',';
        			

        		
        		} else if(month == '03') {
        			
        				exams += '03='+n.toFixed(2)+',';
        			
        		} else if(month == '04') {
        			
        				exams += '04='+n.toFixed(2)+',';
        			
        		} else if(month == '05') {
        			
        				exams += '05='+n.toFixed(2)+',';
        			
        		} else if(month == '06') {
        			
        				exams += '06='+n.toFixed(2)+',';
        			
        		} else if(month == '07=') {
        			
        				exams += '07='+n.toFixed(2)+',';
        			
        		} else if(month == '08') {
        			
        				exams += '08='+n.toFixed(2)+',';
        			
        		} else if(month == '09') {
        			
        				exams += '09='+n.toFixed(2)+',';
        			
        		} else if(month == '10') {
        			
        				exams += '10='+n.toFixed(2)+',';
        			
        		} else if(month == '11') {
        			
        				exams += '11='+n.toFixed(2)+',';
        			
        		} else if(month == '12') {
        			
        				exams += '12='+n.toFixed(2)+',';
        			
        		}
        	})

	

	window.location = '<?=base_url();?>Generate_agenda/training_dept_via_pdf2/'+agenda_id+'/'+header+'?rate='+rate+'&exams='+exams;
			
        })
	}

	// function get_pdf(cycle, rate, header, agenda_id) {
	// 	$.ajax({
	// 		type:'post',
	// 		url:'<?=base_url();?>Generate_agenda/training_dept_via_pdf',
	// 		data:{"cycle":cycle, "rate":rate, "header":header, "agenda_id":agenda_id}
	// 	}).done(function(result) {
	// 		alert('a');
	// 	})
	// }
})
</script>



<input type="hidden" class="agenda_id" value="<?=$this->uri->segment(3);?>">