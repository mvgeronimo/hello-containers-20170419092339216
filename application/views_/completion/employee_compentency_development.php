
<?php //echo '<pre>'; print_r($this->session->all_userdata()); exit();?>
<input type="hidden" class="hidden_agenda" value="<?=$this->session->userdata('agenda_id');?>">
<input type="hidden" class="hidden_step" value="<?=$this->session->userdata('step');?>">
<input type="hidden" class="hidden_psr" value="<?=$this->session->userdata('agenda_psr');?>">
<input type="hidden" class="hidden_dm" value="<?=$this->session->userdata('emp_id');?>">
<input type="hidden" class="hidden_agenda_status" value="<?=$agenda_status?>">;
<div class="col-md-12" style="background-color:white; padding:0px;">

	<div class="col-md-2 progress_div">
		<?php $this->load->view('schedule/progress.php'); ?>
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
	<div class="data-Container col-md-10 pad-0">

	<div class="col-md-12 pad-0">
		<p style="color:#ccc;font-size:20px;margin-top:10px;margin-bottom:0px;">OJL COMPLETION</p>
		<p class="darkblue-font title_completion page_title">EMPLOYEE COMPETENCY DEVELOPMENT</p>
				
	</div>

	<div class="col-md-12 main_emp_div">

		<div class="responsive col-sm-12 col-md-12 col-lg-12 margin-top-20px no-padding">
    						<div class="col-sm-12 col-md-6 col-lg-6" style="padding-left: 0px;">
    							
    							<div class="col-md-12 no-padding">
    								<input type="hidden"  class="empID" value="">
    								<div class="col-md-4 no-padding"><label class="form-label">Name of PSR: </label></div>
    								<div class="col-md-8 no-padding"><span class="psr_name"></span></div>
    							</div>

    							<div class="col-md-12 no-padding">
    								<div class="col-md-4 no-padding"><label class="form-label">Salary Grade: </label></div>
    								<div class="col-md-8 no-padding"><span class="salary_grade"></span></div>
    							</div>

    							<div class="col-md-12 no-padding">
    								<div class="col-md-4 no-padding"><label class="form-label">Territory: </label></div>
    								<div class="col-md-8 no-padding"><span class="territory"></span></div>
    							</div>

    							<div class="col-md-12 no-padding">
    								<div class="col-md-4 no-padding"><label class="form-label">Last Promotion Date: </label></div>
    								<div class="col-md-8 no-padding"> <input type="text" class="form-control" id="date_from" readonly="readonly" style="background:none;border: none;box-shadow: none;cursor: default;padding: 0;height: auto;"> <!-- <input type="text" class="form-control" id="date_from" value="<?php echo date('m/d/Y');?>"> --></div>
    							</div>

    							<div class="col-md-12 no-padding">
    								<div class="col-md-4 no-padding"><label class="form-label">Rating: </label></div>
                                    <div class="col-md-8 no-padding">
                                    <table border="1" style="text-align: center;">
                                        <thead></thead>
                                        <tbody>
                                        <tr>
                                        <?php
                                            $year_today = date('Y');
                                            $year_minus2 = $year_today - 2;
                                            $year_plus1 = $year_today + 1;

                                            $year = $year_minus2;
                                            
                                            for($x=1; $x<=4; $x++){
                                                
                                            $y = 1;
                                            while($y<=2){
                                                
                                        ?>
                                        <td>S<?=$y." ".$year?></td>
                                        <?php 
                                        if($y==2){
                                            $year++;
                                        }
                                            $y++;
                                            if($year==$year_plus1){
                                                $y++;
                                            }
                                        } ?>

                                        <?php } ?>
                                        </tr>
                                       <tr>
                                        <?php
                                            $year_today = date('Y');
                                            $year_minus2 = $year_today - 2;
                                            $year_plus1 = $year_today + 1;

                                            $year = $year_minus2;
                                            
                                            for($x=1; $x<=4; $x++){
                                                
                                            $y = 1;
                                            while($y<=2){
                                                
                                        ?>
                                        <td><?=$rating_data[$year][$y]->rating?></td>
                                        <?php 
                                        if($y==2){
                                            $year++;
                                        }
                                            $y++;
                                            if($year==$year_plus1){
                                                $y++;
                                            }
                                        } ?>

                                        <?php } ?>
                                        </tr>


                                        </tbody>


                                    </table>
                                    <?php
                                    




                                    //print_r($rating_data);
                                    ?> </div>
    							</div>

    							<!-- <div class="col-md-12 no-padding">
    								<div class="col-md-4 no-padding"><label class="form-label">Training Intervention: </label></div>
    								<div class="col-md-8 no-padding"><input type="text" class="training_intervention form-control" value=""></div>
    							</div>
 -->
    							<!-- <div class="form-group">
                                <input type="hidden"  class="empID" value="">
    							<label class="form-label">Name of PSR: <span class="psr_name"></span></label>
    							</div>

    							<div class="form-group">
    							<label class="form-label">Salary Grade: <span class="salary_grade"></span></label>
    							</div>

    								<div class="form-group">
    							<label class="form-label">Territory: <span class="territory"></span></label>
    							</div>

    							<div class="form-group">
                  <div class="col-md-4 pad-0">
                    <label class="form-label">Last Promotion Date:</label>
                  </div>

                  <div class="col-md-8">
                   <input type="text" class="form-control" id="date_from" value="<?php echo date('m/d/Y');?>">
                  </div>
    							
				</div>

				<div class="form-group">
				<label class="form-label">Rating:</label>
				</div> -->

			</div>

			<div class="col-sm-12 col-md-6 col-lg-6" style="padding-right: 0px;">

				<div class="col-md-12 no-padding">
					<input type="hidden"  class="empID" value="">
					<div class="col-md-4 no-padding"><label class="form-label">Date of OJL: </label></div>
					<div class="col-md-8 no-padding"><span class="date_of_ojl"></span></div>
				</div>

				<div class="col-md-12 no-padding">
					<div class="col-md-4 no-padding"><label class="form-label">Competency Standard: </label></div>
					<div class="col-md-8 no-padding"><span class="competency_standards"></span></div>
				</div>

				<div class="col-md-12 no-padding">
					<div class="col-md-4 no-padding"><label class="form-label">Areas for Improvement: </label></div>
					<div class="col-md-8 no-padding"><input type="text" class="form-control areas_of_improvement"></div>
				</div>

                <div class="col-md-12 no-padding" style="margin-top:25px;margin-bottom:25px;">
                    <div class="col-md-4 no-padding"><label class="form-label">Training Intervention: </label></div>
                    <div class="col-md-8 no-padding"><input type="text" class="training_intervention form-control" value=""></div>
                </div>

				<!-- <div class="col-md-12 no-padding">
					<div class="col-md-4 no-padding"><label class="form-label">Eligible Date for Promotion: </label></div>
				</div> -->

				<!-- <div class="form-group">
				<label class="form-label">Date of OJL: <span class="date_of_ojl"></span></label>
				</div>

				<div class="form-group">
				<label class="form-label">Compentency Standard: <span class="competency_standards"></span></label>
				</div>

    			<div class="form-group">
                  <div class="col-md-4 pad-0">
                    <label class="form-label">Areas for Improvement:</label>
                  </div> 

                  <div class="col-md-8 pad-0">
                    <input type="text" class="form-control areas_of_improvement">
                  </div>
    							
    			</div>

				<div class="form-group">
					<label class="form-label">Eligible Date for Promotion:</label>
					</div>
       			</div> -->

	</div>

	<div class="col-md-12 content-item no-padding">
		<div class="clear">
			<div class="col-sm-12 col-md-6 col-lg-6 no-padding">
				<label class="form-label"><h4>Individual Development Plan</h4></label>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-6 no-padding">
				<button class="AddLine AddLine-2-column right darkblue-bg darkblue-btn" aria-type="ECDevelopement" > Add Line </button>
			</div>
		</div>

		<table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 ECDevelopement-table no-padding" style="margin-bottom:15px;"> 
			<thead class="darkblue-bg">
				<tr>
					<th> Skills to be developed </th> 
					<th> Developmental Activity </th> 
				 
				</tr> 
			</thead>
			<tbody class="tbody_idp">

				<tr>
                    <td> <input type="text" class="form-control idp-first-data-1" name="first-data-1" > </td>
                    <td> <div class="no-padding col-xs-11 col-sm-11 col-md-11 col-lg-11"><input type="text" class="form-control idp-second-data-1"></div><div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="EDeCvelopement-table"></span></div> </td>
                </tr>

            </tbody>
    	</table>

    	<div class="clear margin-top-20">
            <div class="col-sm-12 col-md-6 col-lg-6 no-padding">
                <label class="form-label"><h4>Ulearn Accomplishment Update</h4></label>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 no-padding">
                <button class="AddLine AddLine-3-column right darkblue-bg darkblue-btn" aria-type="UAUpdate"> Add Line </button>
            </div>
        </div>

        <table class="sales_plan_tbl col-sm-12 col-md-12 col-lg-12 UAUpdate-table no-padding"> 
            <thead class="darkblue-bg">
                <tr>
                    <th> Course Title </th> 
                    <th> Completion Date </th> 
                    <th> Learning Application </th> 
                 
                </tr> 
            </thead>
            <tbody class="tbody_ulearn">
            	<tr>
	                <td> <input type="text" class="form-control ulearn-first-data-1" value=""> </td>
	                <td> <input type="text" class="form-control ulearn-second-data-1"> </td>
	                <td> <div class="no-padding col-xs-11 col-sm-11 col-md-11 col-lg-11"><input type="text" class="form-control ulearn-third-data-1"></div><div class="no-padding col-xs-1 col-sm-1 col-md-1 col-lg-1"> <span class="glyphicon glyphicon-remove-circle remove-icon" aria-table-name="UAUpdate-table"></span></div> </td>
	            </tr>
	        </tbody>
        </table>

        <div class="clear">
            <div class="col-sm-12 col-md-6 col-lg-6 no-padding">
                <label class="form-label"><h4>On-line Exam Monitoring</h4></label>
            </div>
        </div>

        <table class="table table-bordered col-sm-12 col-md-12 col-lg-12 OLE-Monitoring-table no-padding"> 
            <tbody> 
                <tr>
                    <td rowspan="2"> </td> 
                    <td colspan="13" class="darkblue-bg"> Months </td>
                </tr> 
          
                <tr>
                    <td> 1 </td>
                    <td> 2 </td>
                    <td> 3 </td>
                    <td> 4 </td>
                    <td> 5 </td>
                    <td> 6 </td>
                    <td> 7 </td>
                    <td> 8 </td>
                    <td> 9 </td>
                    <td> 10 </td>
                    <td> 11 </td>
                    <td> 12 </td>
                </tr>

                <tr>
                    <td> % Perf </td>
                    <td class="month_1">  </td>
                    <td class="month_2">  </td>
                    <td class="month_3">  </td>
                    <td class="month_4">  </td>
                    <td class="month_5">  </td>
                    <td class="month_6">  </td>
                    <td class="month_7">  </td>
                    <td class="month_8">  </td>
                    <td class="month_9">  </td>
                    <td class="month_10">  </td>
                    <td class="month_11">  </td>
                    <td class="month_12">  </td>
                </tr>

            </tbody>
        </table>


	<div class="col-sm-12 col-md-12 col-lg-12 no-padding btn-next" style="text-align:right;margin-bottom:15px;">
		<div class="btn-next"><a class="RemarksEvaluation darkblue-bg darkblue-btn">
			Next </a>
		</div>
	</div>
		
	  </div>
	</div>



		
	</div>

</div>

<input type="hidden" class="competency_id" value="">



<script type="text/javascript">

$(document).ready(function(){

	get_emp();

//$( "#date_from" ).datepicker();
$('#dates').datepicker();

	// $('.i').addClass('activePage');
	// $('.ii').addClass('activePage');
	// $('.iii').addClass('activePage');
	// $('.iv').addClass('activePage');
	// $('.v').addClass("activePage");
	// $('.vi').addClass("activePage");
	// $('.vii').addClass("activePage");
	// $('.viii').addClass("activePage");
	// $('.ix').addClass("activePage");


//start_ojl('Employee_Compentency_Development_Data');


	
$(document).on('focus',".deyts", function(){ //bind to all instances of class "date". 
   $(this).datepicker();
});


});


function start_ojl(fc) {
	$.ajax({
		url:"<?=base_url()?>Ojl_completion/"+fc,
		type:'post',
		dataType:'json'
	}).done(function(data){
		var obj = JSON.parse(data);

		$.each(obj, function(x,y) {
			alert(y.EmployeeData);
		})
		// var pageTitle;
		// var content;
		// pageTitle = data.pageTitle;
		// content = data.table;
		// $('.title_completion').html(pageTitle);
		// $('.content-item').html(content);
		// attr = $('.hidden_atr').val();
		// attr2 = $('.hidden_atr2').val();

	});


var agenda_status = $('.hidden_agenda_status').val();
if(agenda_status == 2 || agenda_status == 3 || agenda_status == 4) {
    $('.areas_of_improvement').prop({'disabled':true});
    $('.remove-icon').prop({'pointer-events':'none'});
}


}

</script>