
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
 <!--  <link rel="stylesheet" href="/resources/demos/style.css">
 -->
  <script>

  $(document).ready(function() {
    $('.prog_agenda').css({'color':'blue'});

    var agenda_type = 0;
    var date = new Date();
    var startdate = new Date();
    startdate.setDate(startdate.getDate());
    date.setDate(date.getDate() + 1);
     $('#date_from').val($.datepicker.formatDate('mm/dd/yy', startdate));
    $('#date_to').val($.datepicker.formatDate('mm/dd/yy', date));
    $('.span_date_to').html($.datepicker.formatDate('M dd yy', date));

    $('.span_date_from').html($.datepicker.formatDate('M dd yy', startdate));

    $('#date_from').on('change', function() {
      var date_from = new Date($(this).val());
      var start = date_from;

      date_from.setDate(date_from.getDate() + 1);
      var span_date_from = date_from.setDate(date_from.getDate());
      $('#date_to').val($.datepicker.formatDate('mm/dd/yy', date_from));
      $('.span_date_from').html($.datepicker.formatDate('mm/dd/yy', start));
    })

    $('#date_to').on('change', function() {
      var date_to = new Date($(this).val());
      date_to.setDate(date_to.getDate() - 1);

      $('#date_from').val($.datepicker.formatDate('mm/dd/yy', date_to));
      $('.span_date_to').html($.datepicker.formatDate('M dd yy', date_to));
    })

    $('.btn-save').click(function() {
      alert(agenda_type);
    	$('.loader').show();

          var dm = $('.p_dm').val();
          var psr_id = $('.psr').val();
          var salary = 20000;
          var territory_id = $('.territory').val();
          var date_from = $('#date_from').val();
          var date_to = $('#date_to').val();
          var consistency = $('#competency_standards').val();
          var agendaid = $('.input_next_id').val();

    	if(consistency != '')
    	{
    		  $.ajax({
            type:'post',
            url:'<?=base_url();?>ojl_schedule/create_agenda',
            data:{"agendaid":agendaid, "agenda_type":agenda_type, "dm":dm, "psr_id":psr_id, "salary":salary, "territory_id": territory_id, "date_from":date_from, "date_to":date_to, "consistency":consistency}
          }).done(function() {
    		  $('.loader').hide();
            alert("Successfully Saved");
            save_itenerary();

            //window.location = '<?=base_url();?>ojl_schedule/business_development';
          })

    	}
    	else
    	{
    		alert('Please Complete Fields!');
        $('.loader').hide();
    	}

    })

      // for businesspeople
      var count_agenda = 1;
      var count_people = 1;

      $.ajax({
        type:'post',
        url:'<?=base_url();?>Ojl_schedule/get_lastid'
      }).done(function(result) {
          $('.input_next_id').val(result);

      })

      $('.save_people').click(function() {
    
        for(pp=1;pp<=count_people;pp++) {
          var agenda_name = $('.agenda_name_people_'+pp).val();
          var action_plan = $('.action_plan_people_'+pp).val();
          var agendaid = $('.input_next_id').val();

          if(agenda_name != undefined) {
            $.ajax({
                url: '<?php echo base_url(); ?>Ojl_schedule/insert_business_development',
                type: "POST",
                data: { agendaid:agendaid, agenda_name: agenda_name, action_plan: action_plan, type : 2 },
                success: function (result) {
                $('.loader').hide();
                alert("Successfully Saved!");
                
                },
                error: function (xhr, status, p3, p4) {
                    var err = "Error " + " " + status + " " + p3;
                    if (xhr.responseText && xhr.responseText[0] == "{")
                        err = JSON.parse(xhr.responseText).message;
                    alert(err);
                }
            });
          }
        }

        //alert("Successfully Saved!");
      
      })

    $('.save_business').click(function() {
        $('.loader').show();
        // alert(count_agenda);
        for(sb=1;sb<=count_agenda;sb++) {
          var agenda_name = $('.agd_'+sb).val();
          var action_plan = $('.action_plan_'+sb).val();
          var agendaid = $('.input_next_id').val();
          // alert('222');
          if(agenda_name != undefined) {
            // alert('1111');
            $.ajax({
                url: '<?php echo base_url(); ?>Ojl_schedule/insert_business_development',
                type: "POST",
                data: { agendaid:agendaid, agenda_name: agenda_name, action_plan: action_plan, type : 1},
                success: function (result) {
                $('.loader').hide();
                alert("Successfully Saved!");
                
                },
                error: function (xhr, status, p3, p4) {
                    var err = "Error " + " " + status + " " + p3;
                    if (xhr.responseText && xhr.responseText[0] == "{")
                        err = JSON.parse(xhr.responseText).message;
                    alert(err);
                }
            });
          }
          
        }
        
      })


      $('.add_agenda').click(function() {
          count_agenda++;

          var htm = '';
          htm += '<div class="col-md-12 business_'+count_agenda+'">';
          htm += '<div class="col-md-5" style="margin-top:15px">';
          htm += '<div class="col-md-10" style="padding:0px">';
          htm += '<input type="text" class="agenda_name form-control agd_'+count_agenda+'" placeholder="Agenda">';
          htm += '</div>';

          htm += '<div class="col-md-2">';
          htm += '<button class="btn btn-primary minus_agenda" btn-num="'+count_agenda+'" style="height: 34px;">';
          htm += '<span class="glyphicon glyphicon-minus" aria-hidden="true">';
          htm += '</button></div></div>';

          htm += '<div class="col-md-7" style="margin-top:15px">';
          htm += '<input type="text" class="action_plan_'+count_agenda+' form-control" placeholder="Action Plan">';
          htm += '</div></div>';


          $('.agenda_cont').append(htm);  
          
        })

        $('.add_people_agenda').click(function() {
          count_people++;

          var htm = '';

          htm += '<div class="col-md-12 ppl_'+count_people+'">';
          htm += '<div class="col-md-5" style="margin-top:15px">';
          htm += '<div class="col-md-10" style="padding:0px">';
          htm += '<input type="text" class="agenda_name_people_'+count_people+' ppl_'+count_people+' form-control" placeholder="Agenda">';
          htm += '</div>';

          htm += '<div class="col-md-2">';
          htm += '<button class="btn btn-primary minus_ppl_agenda" btn-num="'+count_people+'" style="height: 34px;width:40px">';
          htm += '<span class="glyphicon glyphicon-minus" aria-hidden="true">';
          htm += '</button>';
          htm += '</div></div>';

          htm += '<div class="col-md-7" style="margin-top:15px">';
          htm += '<input type="text" class="action_plan_people_'+count_people+' form-control" placeholder="Action Plan">';
          htm += '</div></div>';

          $('.people_cont').append(htm);
          

        })

        $(document).on('click', '.minus_agenda', function() {
          var busines_no = $(this).attr('btn-num');
          $('.business_'+busines_no).remove();
        })

        $(document).on('click', '.minus_ppl_agenda', function() {
          var people_dev = $(this).attr('btn-num');
          $('.ppl_'+people_dev).remove();
        })

        $('.to_itenerary').click(function() {
          $('.prog_agenda').css({'color':'#7a7a7a'});
          $('.prog_itenerary').css({'color':'blue'});
          $(this).hide();
          $('.agenda_div').hide();
          $('.itenerary_div').show();
        })

    //end for businesspeople

    //start for itenerary

    var count_itenerary = 1;
    var count_itenerary2 = 1;

    $(document).on('change', '.doctorsDropdown', function() {
        var count = $(this).attr('data-value');
        var doctorID = $('.doctors_'+count).val();
        var town = '';
        var hospital = '';
        $('.loader').show();
          $.ajax({
              url: '<?php echo base_url(); ?>Ojl_schedule/getDataTable',
              type: "POST",
              data: { table:'ojl_DoctorTown',where:'DoctorID = '+doctorID },
              success: function (result) {
              $('.loader').hide();
               var obj = JSON.parse(result);
                // alert(msg);
                  $.each(obj,function(a,b){
                    town += '<option value="'+b.id+'">'+b.TownName+'</option>';
                  });
                  $('.towns_'+count).html(town);
              
              },
              error: function (xhr, status, p3, p4) {
                  var err = "Error " + " " + status + " " + p3;
                  if (xhr.responseText && xhr.responseText[0] == "{")
                      err = JSON.parse(xhr.responseText).message;
                  alert(err);
              }
            });

        $.ajax({
            url: '<?php echo base_url(); ?>Ojl_schedule/getDataTable',
            type: "POST",
            data: { table:'ojl_DoctorHospital',where:'DoctorID = '+doctorID },
            success: function (result) {
            $('.loader').hide();
             var obj = JSON.parse(result);
              // alert(msg);
                $.each(obj,function(a,b){
                  hospital += '<option value="'+b.id+'">'+b.HospitalName+'</option>';
                });
                $('.hospitals_'+count).html(hospital);
            
            },
            error: function (xhr, status, p3, p4) {
                var err = "Error " + " " + status + " " + p3;
                if (xhr.responseText && xhr.responseText[0] == "{")
                    err = JSON.parse(xhr.responseText).message;
                alert(err);
            }


        });
         $(".doctorsDropdown option[value*='n/a']").prop('disabled',true);
        })


        $('.add_focus_md').click(function() {
          $('.loader').show();
          count_itenerary++;

          var htm = '';
          var doctors = '';

          htm += '<div class="col-md-3">';
          htm += '<label class="itenerary_name_'+count_itenerary+'">Itenerary '+count_itenerary+'</label>';
          htm += '</div>';
          
          htm += '<div class="col-md-3">';
          htm += '<select class="form-control doctorsDropdown doctors_'+count_itenerary+'" data-value="'+count_itenerary+'">';
          htm += '</select></div>';

          htm += '<div class="col-md-3">';
          htm += '<select class="form-control towns_'+count_itenerary+'">';
          htm += '</select></div>';

          htm += '<div class="col-md-3">';
          htm += '<select class="form-control hospitals_'+count_itenerary+'">';
          htm += '</select></div>';
          $('.itenerary_cont').append(htm);
              $.ajax({
                  url: '<?php echo base_url(); ?>Ojl_schedule/getDataTable',
                  type: "POST",
                  data: { table:'ojl_doctors',where:'isActive = 1' },
                  success: function (result) {
                  $('.loader').hide();
                   var obj = JSON.parse(result);
                    // alert(msg);
                    doctors += '<option value="n/a">-- Please Select Doctor --</option>';
                      $.each(obj,function(a,b){
                        doctors += '<option value="'+b.id+'">'+b.DoctorName+'</option>';
                      });
                      $('.doctors_'+count_itenerary).html(doctors);
                      $('.loader').hide();
                  
                  },
                  error: function (xhr, status, p3, p4) {
                      var err = "Error " + " " + status + " " + p3;
                      if (xhr.responseText && xhr.responseText[0] == "{")
                          err = JSON.parse(xhr.responseText).message;
                      alert(err);
                  }
              });
          
          
        });

        //////////////for day 2//////////////////
            $('.add_focus_md_2').click(function() {
             
                $('.loader').show();
                  count_itenerary2++;

                  var htm = '';
                  var doctors = '';

                  htm += '<div class="col-md-3">';
                  htm += '<label class="itenerary_name2_'+count_itenerary2+'">Itenerary '+count_itenerary2+'</label>';
                  htm += '</div>';
                  
                  htm += '<div class="col-md-3">';
                  htm += '<select class="form-control doctorsDropdown2 doctors2_'+count_itenerary2+'" data-value="'+count_itenerary2+'">';
                  htm += '</select></div>';

                  htm += '<div class="col-md-3">';
                  htm += '<select class="form-control towns2_'+count_itenerary2+'">';
                  htm += '</select></div>';

                  htm += '<div class="col-md-3">';
                  htm += '<select class="form-control hospitals2_'+count_itenerary2+'">';
                  htm += '</select></div>';
                  $('.itenerary_cont_2').append(htm);
                      $.ajax({
                          url: '<?php echo base_url(); ?>Ojl_schedule/getDataTable',
                          type: "POST",
                          data: { table:'ojl_doctors',where:'isActive = 1' },
                          success: function (result) {
                          $('.loader').hide();
                           var obj = JSON.parse(result);
                            // alert(msg);
                            doctors += '<option value="n/a">-- Please Select Doctor --</option>';
                              $.each(obj,function(a,b){
                                doctors += '<option value="'+b.id+'">'+b.DoctorName+'</option>';
                              });
                              $('.doctors2_'+count_itenerary2).html(doctors);
                              $('.loader').hide();
                          
                          },
                          error: function (xhr, status, p3, p4) {
                              var err = "Error " + " " + status + " " + p3;
                              if (xhr.responseText && xhr.responseText[0] == "{")
                                  err = JSON.parse(xhr.responseText).message;
                              alert(err);
                          }
                      });

                  
                })
          // end for day 2

    //end for itenerary

    $('.btn_back').click(function() {
      $('.prog_agenda').css({'color':'blue'});
      $('.prog_itenerary').css({'color':'#7a7a7a'});
     
      $('.itenerary_div').hide();
      $('.to_itenerary').show();
      $('.agenda_div').show();
    })

    $('.btn_sumbit2').click(function() {
      
      agenda_type = $(this).attr('btype');
      $('.btn-save').click();
    })

    $('.btn_cancel2').click(function() {
      window.location = '<?= base_url(); ?>ojl_schedule';
    })

    function save_itenerary() {
       for(a=1;a<=count_itenerary;a++) {
          var itenerary_name = $('.itenerary_name_'+a).html();
          var doctor_id = $('.doctors_'+a).val();
          var town_id = $('.towns_'+a).val();
          var hospital_id = $('.hospitals_'+a).val();
          var status = $(this).attr('btype');
          var agendaid = $('.input_next_id').val();
          
          $.ajax({
              url: '<?php echo base_url(); ?>Ojl_schedule/insert_itenerary',
              type: "POST",
              data: {agendaid:agendaid,  itenerary_name: itenerary_name, doctor_id: doctor_id, town_id : town_id, hospital_id:hospital_id, status:status, day:1},
              success: function (result) {
                $('.loader').hide();
            
                alert("Successfully Saved!");
              
            
              },
              error: function (xhr, status, p3, p4) {
                  var err = "Error " + " " + status + " " + p3;
                  if (xhr.responseText && xhr.responseText[0] == "{")
                      err = JSON.parse(xhr.responseText).message;
                  alert(err);
              }
          });
        }



        for(a=1;a<=count_itenerary;a++) {
          var itenerary_name = $('.itenerary_name2_'+a).html();
          var doctor_id = $('.doctors2_'+a).val();
          var town_id = $('.towns2_'+a).val();
          var hospital_id = $('.hospitals2_'+a).val();
          var status = $(this).attr('btype');
          var agendaid = $('.input_next_id').val();

          
          $.ajax({
              url: '<?php echo base_url(); ?>Ojl_schedule/insert_itenerary',
              type: "POST",
              data: {agendaid:agendaid, itenerary_name: itenerary_name, doctor_id: doctor_id, town_id : town_id, hospital_id:hospital_id, status:status, day:2},
              success: function (result) {
                $('.loader').hide();
            
                alert("Successfully Saved!");
              
            
              },
              error: function (xhr, status, p3, p4) {
                  var err = "Error " + " " + status + " " + p3;
                  if (xhr.responseText && xhr.responseText[0] == "{")
                      err = JSON.parse(xhr.responseText).message;
                  alert(err);
              }
          });
        }


    }



  })
  $( function() {


    $( "#date_to" ).datepicker();
  } );


  </script>

 
<p> <input type="text" class="form-control" id="date_to" value="<?php echo date('m/d/Y');?>"></p>
 
