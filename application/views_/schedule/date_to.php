<style type="text/css">
  .ui-datepicker-prev, .ui-datepicker-next {
    display: none !important;
  }
</style>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
 <!--  <link rel="stylesheet" href="/resources/demos/style.css">
 -->
  <script>

  $(document).ready(function() {
    // $('.ui-datepicker-next').css({'display':'none'});
    // $('.ui-datepicker-prev').css({'display':'none'});
    $('.i').addClass('activePage');

    $('.biomedis-logo').attr('src', '../assets/images/biomedis-logo.png');

    $('.footer-login img').attr('src', '../assets/images/biomedis-footer.png');

    // $('.iii').click(function() {
    //   window.location = '<?=base_url();?>Sales_plan_for_the_month';
    // })  

    var category1 = 1;
    var category2 = 1;

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
     
       var date1 = $('#date_from').datepicker('getDate');
       var day = date1.getDay();


      var date_from = new Date($(this).val());
      var start = date_from;

      if(day == 5) {
         date_from.setDate(date_from.getDate() + 3);
       } else {
        date_from.setDate(date_from.getDate() + 1);
       }
      
      var span_date_from = date_from.setDate(date_from.getDate());

      var d = new Date();


     if(date_from < d) {
      bootbox.alert('<b>Past date cannot be selected. Please select present or future date.</b>');
      $('#date_from').val($.datepicker.formatDate('mm/dd/yy', startdate));
     } else {
      $('#date_to').val($(this).val());
      $('.span_date_from').html($.datepicker.formatDate('mm/dd/yy', start));
     }

      
    })

    $('#date_to').on('change', function() {
      var date1 = $('#date_to').datepicker('getDate');
       var day = date1.getDay();

      var date_to = new Date($(this).val());

      if(day == 1) {
        date_to.setDate(date_to.getDate() - 3);
      } else {
        date_to.setDate(date_to.getDate() - 1);
      }
      

      var d2 = new Date();
      var d = d2.getFullYear()+'-'+(d2.getMonth()+1)+'-'+d2.getDate();  

      //alert($(this).val()+' '+d);

      $.ajax({
        type:'post',
        url: '<?=base_url();?>Ojl_schedule/checktime',
        data:{"date_to":$(this).val(), "date_now":d}
      }).done(function(result) {
         if(result == '1') {
        bootbox.alert('<b>Past date cannot be selected. Please select present or future date.</b>');
         $('#date_from').val($.datepicker.formatDate('mm/dd/yy', startdate));
        $('#date_to').val($.datepicker.formatDate('mm/dd/yy', date));
       } else if(result == '2') {
          $('#date_from').val($.datepicker.formatDate('mm/dd/yy', d2));
          $('.span_date_to').html($.datepicker.formatDate('M dd yy', d2));
       } else {
          $('#date_from').val($.datepicker.formatDate('mm/dd/yy', date_to));
          $('.span_date_to').html($.datepicker.formatDate('M dd yy', date_to));
       } 
      })
     
     
    })

    $('.btn-save').click(function() {
      // alert(agenda_type);

      var nulls = 0;

      $('.action_text').each(function() {
        if($(this).val() == '') {
          nulls++;
        }
      })

      $('.people_text').each(function() {
        if($(this).val() == '') {
          nulls++;
        }
      })
 
     if(nulls == 0) {


          $('.loader').show();

            var dm = $('.p_dm').html();
            var psr_id = $('.psr').val();
            var psr = $('.psr option:selected').html();
            var salary = $('.salary_grade_b').html();
            var territory = $('.territory').html();
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            var consistency = $('#competency_standards').html();
            // var agendaid = $('.input_next_id').val();
            var type = $('#createType').val();

            var is_agreeed = $('#psr_drop_'+psr_id).attr('is_agree');

            var is_new  = $(this).attr('is-new');

            var type_2 = $('#createType').val();

            if(type_2 == 2) {
              var hid_agenda2 = $('.hidden_agenda').val();
            }
            else {
              var hid_agenda2 = '';
            }
              
            
            if(is_agreeed == 1) {

              $.ajax({
                type:'post',
                url:'<?=base_url();?>Ojl_schedule/checkAgenda',
                data:{"dm":dm, "psr_id":psr_id, "psr":psr, "salary":salary, "territory": territory, "date_from":date_from, "date_to":date_to, "consistency":consistency,createType:type, 'hid_agenda':hid_agenda2}
              }).done(function(res) {
                if(res=='error'){
                  $('.loader').hide();
                  //
                  bootbox.alert('There is an ojl already for this dates');
                }
                else{




                    var formData = new FormData($('form#agenda_business_form')[0]);
                    var formData2 = new FormData($('form#agenda_ppl_form')[0]);
                    // $('#agenda_business_form').submit();
                    console.log(formData);

                    $.ajax({
                      url: '<?php echo base_url(); ?>ojl_schedule/insert_business_development',
                      type: "POST",
                      data: formData,
                      success: function (msg) {
                        var objJSON = JSON.parse(msg);
                      },
                      cache: false,
                      contentType: false,
                      processData: false
                    });
                    
                    $.ajax({
                      url: '<?php echo base_url(); ?>ojl_schedule/insert_people_development',
                      type: "POST",
                      data: formData2,
                      success: function (msg) {
                      var objJSON = JSON.parse(msg);
                      },
                      cache: false,
                      contentType: false,
                      processData: false
                    });
                     
                      $.ajax({
                        type:'post',
                        url:'<?=base_url();?>ojl_schedule/create_emp'
                      }).done(function(result) {
                        $('.loader').hide();
                        bootbox.alert("<b>Agenda has been successfully saved.</b>", function() {
                            window.location = '<?=base_url();?>ojl_schedule/itinerary';
                        });

                          
                        })
                }

                 
              });
              
            } else {

              if(psr_id == '') {
                $('.loader').hide();
                  bootbox.alert('<b>Please select PSR.</b>');
              } else {
                var ha = $('.hidden_agenda').val();
                if(ha==undefined) {
                   $('.loader').hide();
                  bootbox.alert('<b>Please view the previous agreements</b>');
                } 
                
              }
              
             
            }




     } else {
      
        bootbox.alert("<b>Please fill out the missing fields.</b>");

     }



    	

    	     

    })

  function checkdates(date_from, date_to) {

  }

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
        var nulls = 0;
        $('.action_text').each(function() {
          if($(this).val() == '') {
            nulls++;
          } else {


          }
        })
        
          if(nulls == 0) {
            $('.loader').show();
            if(category1 < 3) {
                count_agenda++;
                category1++;
                var htm = '';
                var select ='';
                    htm += '<div class="col-md-12 business_'+count_agenda+'">';
                    htm += '<div class="col-md-5" style="margin-top:15px">';
                    htm += '<div class="col-md-10" style="padding:0px">';
                    // htm += '<input type="text" class="agenda_name form-control agd_'+count_agenda+'" placeholder="Agenda">';
                    htm += '<select name="agd_business[]" class="agenda_name form-control agd_'+count_agenda+'"></select>';
                    htm += '</div>';

                    htm += '<div class="col-md-2">';
                    htm += '<a class="minus_agenda" btn-num="'+count_agenda+'" style="height: 34px;color:#a0a0a0;cursor:pointer">';
                    htm += '<i>Delete</i>';
                    htm += '</a></div></div>';

                    htm += '<div class="col-md-7" style="margin-top:15px">';
                    htm += '<input type="text" name="action_business[]" class="action_text action_plan_'+count_agenda+' form-control" placeholder="Action Plan">';
                    htm += '</div></div>';


                $('.agenda_cont').append(htm); 
                $('#businessCounter').val(count_agenda);
                $('.save_businessDraft').show();
                      $.ajax({
                          url: '<?php echo base_url(); ?>ojl_schedule/getDataTable',
                          type: 'post',
                          data: { table: 'ojl_agenda_name',where:'is_active = 1' },
                          success:function(msg){
                          var obj = JSON.parse(msg);
                          $.each(obj,function(a,b){
                            if(b.agenda_type == 1) {
                              select += '<option value="'+b.agenda_name_id+'">'+b.agenda_name+'</option>';
                            }
                    
                            });
                            // alert('agenda_name_people_'+count_people);
                            $('.agd_'+count_agenda).append(select);
                            

                           
                          $('.loader').hide();
                  
                          }
                      }); 

                      } else {
                        bootbox.alert("<b>A maximum of 3 items per category can be selected.</b>");
                        $('.loader').hide();
                      }


              } else {
                bootbox.alert("<b>Please fill out the missing fields.</b>");
              }
                  
        
          

          
        })

        $('.add_people_agenda').click(function() {
         

          var nulls = 0;
          $('.people_text').each(function() {
            if($(this).val() == '') {
              nulls++;
            } else {


            }
          })

          if(nulls == 0) {
             $('.loader').show();
            if(category2 < 3) {
                category2++;
                count_people++;

                var htm = '';
                var select = '';
       
                htm += '<div class="col-md-12 ppl_'+count_people+'">';
                htm += '<div class="col-md-5" style="margin-top:15px">';
                htm += '<div class="col-md-10" style="padding:0px">';
                htm += '<select name="agd_ppl[]" class="agenda_name_people_'+count_people+' ppl_'+count_people+' form-control"></select>';
                //htm += '<input type="text" class="agenda_name_people_'+count_people+' ppl_'+count_people+' form-control" placeholder="Agenda">';
                htm += '</div>';

                htm += '<div class="col-md-2">';
                htm += '<a class="minus_ppl_agenda" btn-num="'+count_people+'" style="height: 34px;width:40px;color:#a0a0a0;cursor:pointer">';
                htm += '<i>Delete</i>';
                htm += '</a>';
                htm += '</div></div>';

                htm += '<div class="col-md-7" style="margin-top:15px">';
                htm += '<input type="text" name="action_ppl[]" class="people_text action_plan_people_'+count_people+' form-control" placeholder="Action Plan">';
                htm += '</div></div>';

                $('.people_cont').append(htm);
                $('#peopleCounter').val(count_people);
                $('.save_peopleDraft').show();
                
                      $.ajax({
                          url: '<?php echo base_url(); ?>ojl_schedule/getDataTable',
                          type: 'post',
                          data: { table: 'ojl_agenda_name',where:'is_active = 1' },
                          success:function(msg){
                            var obj = JSON.parse(msg);
                            $.each(obj,function(a,b){
                              if(b.agenda_type == 2) {
                                select += '<option value="'+b.agenda_name_id+'">'+b.agenda_name+'</option>';
                              }
                              
                            });
                            // alert('agenda_name_people_'+count_people);
                            $('.agenda_name_people_'+count_people).append(select);

                          
                           $('.loader').hide();
                  
                          }
                      }); 


            } else {

              bootbox.alert("<b>A maximum of 3 items per category can be selected.</b>");
              $('.loader').hide();
            }

          } else {
            bootbox.alert("<b>Please fill out the missing fields.</b>");
          }

         
          

        })

        $(document).on('click', '.minus_agenda', function() {
           var busines_no = $(this).attr('btn-num');


            if(category1 != 1) {

              if($('.action_plan_'+busines_no).val() != '') { // if walang laman yung specific action pla wag daw magppromt hays
                 bootbox.confirm("<b>Are you sure you want to delete this item?</b>", function(r) {
                  if(r) {
                    category1--;
                    $('.business_'+busines_no).remove();
                  }
                })
              } else {
                category1--;
                $('.business_'+busines_no).remove();
              }
             
            } else {

              if($('.action_plan_'+busines_no).val() != '') {
                bootbox.confirm("<b>Are you sure you want to delete this item?</b>", function(r) {
                  if(r) {
                    $('.action_text').val('');
                  }
                })
              }
            }
            
        })

        $(document).on('click', '.minus_ppl_agenda', function() {
          var people_dev = $(this).attr('btn-num');

          if(category2 != 1) {

            if($('.action_plan_people_'+people_dev).val() != '') { // if walang laman yung specific action pla wag daw magppromt hays
              bootbox.confirm("<b>Are you sure you want to delete this item?</b>", function(r) {
                if(r) {
                  category2--;
                  
                  $('.ppl_'+people_dev).remove();
                }
              })
            } else {
                category2--;
                  
                $('.ppl_'+people_dev).remove();
            }
            
          } else {
            if($('.action_plan_people_'+people_dev).val() != '') { 
                 bootbox.confirm("<b>Are you sure you want to delete this item?</b>", function(r) {
                  if(r) {
                    $('.people_text').val('');
                  }
                })
            }
           
            
          }
          
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

    $('.psr').on('change', function() {


      var ha = $('.hidden_agenda').val();

      if(ha == undefined) {
         bootbox.alert("<b>Kindly review the previous OJL agreement before creating a new agenda.</b>", function() {
            var psr_id = $('.psr').val();
            var agreed = $('#psr_drop_'+psr_id).attr('is_agree');
            if(agreed == 1) {
              $('.agree_check').prop('checked', true);
            } else {
              $('.agree_check').prop('checked', false);
            }
          $('.btn-prev').click();
        });
      } 


      var psr_id = $(this).val();
      $.ajax({
        type:'post',
        url:'<?=base_url();?>Ojl_schedule/get_territory',
        data:{'psr_id':psr_id}
      }).done(function(result) {
          var obj = JSON.parse(result);

          $.each(obj, function(x,y) {

            $('.territory').html(y.territory);
          })
      })

      $.ajax({
        type:'post',
        url:'<?=base_url();?>Ojl_schedule/get_salary',
        data:{'psr_id':psr_id}
      }).done(function(result) {
        var obj = JSON.parse(result);

        $.each(obj, function(x,y) {
          
          $('.salary_grade_b').html(y.salary_grade);
          $('#competency_standards').html(y.competency);
        })
      })
    })


    $('.btn-prev').click(function() {
      var psr_id = $('.psr').val();

      $.ajax({
        type:'post',
        url:'<?=base_url();?>ojl_schedule/get_prev',
        data:{'psr_id':psr_id}
      }).done(function(result) {
      
        var obj = JSON.parse(result);

        if(obj.length == 0) {
          bootbox.alert("<b>No previous agreement is found.</b>", function() {
            $('#psr_drop_'+psr_id).attr('is_agree', 1);

          });
        } else {
          $.each(obj, function(x,y) {

              $('.dm_action_plan').html(y.dm_action_plan);

              if(y.dmdatefrom != null) {

                $('.prev_dm_date').html(y.dmdatefrom);
              } 
              
              if(y.psrdatefrom != null ) {
                $('.prev_psr_date').html(y.psrdatefrom);
              }

              if(y.psrdateto != null ) {
                $('.prev_om_date').html(y.psrdateto);
              }

              
              $('.psr_action_plan').html(y.psr_action_plan);
              $('.om_action_plan').html(y.om_remarks);
              $('.issues_concerns').html(y.issues_and_remarks);
              $('.prev_om').html(y.om_name);
              $('.prev_psr').html(y.psr);
              $('.prev_dm').html(y.dm);


          })
           $('.bd-example-modal-lg').modal('show');
        }
        
      })
     
    })

$('.to_homes').click(function() {
 bootbox.confirm("<b>Are you sure you want to leave this page?</b>", function(e) {
  if(e) {
    window.location = '<?=base_url();?>home';
  }
 })
})



  })
  $( function() {


    $( "#date_to" ).datepicker();
  } );


  </script>

 
<p> <input type="text" class="form-control datetf" id="date_to" value="<?php echo date('m/d/Y');?>"></p>
 
