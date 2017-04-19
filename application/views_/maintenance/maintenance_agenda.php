<style>
  
th, td{
  text-align: center;
} 

.table-top-border{
  
  border-top: 20px solid #012873;
}

.abt{
  border-radius: 0px;
  background-color: #012873;
  color: #fff;
  font-weight: bold;
}

.abt:hover{
  color: #fff;
}

.filtered{
  margin-left: 0px;
  margin-bottom: 20px;
  padding: 6px;
  padding-left: 5px;
  font-size: 12pt;
  font-weight: bold;
  color: #fff;
  background-color: #012873;
}

.sorted{
  margin-left: 15px;
  margin-bottom: 20px;
  padding: 6px;
  padding-left: 5px;
  font-size: 12pt;
  font-weight: bold;
  color: #fff;
  background-color: #012873;
}

.filtered-select{
  padding: 0px;
}

.sorted-select{
  margin-left: 15px;
  padding: 0px;
  margin-bottom: 2%;
  
}

.checkbox{
  padding: 0px; 
}

.agenda-title {

    margin-bottom: 2%;

    margin-top: 2%;

    font-weight: bold;

}

.agenda-border {

  border: 2px solid #000000;

  min-height: 350px;

}

.required {

  color: red;

}

.btn-agenda {

  text-align: right;

  margin-bottom: 54px;

  padding: 0px;

  margin-top: 2%;

}

.btn-save {

  background: #012873 !important;

  margin-left: 10px;

  width: 9%;

  margin-top: 2%;

  border-radius: 0px;

}

.agenda_add {

  width: 90%;

}

.prod-pagintaion{
  margin-bottom: 10px;
  padding: 5px;
}

.prod-pagintaion button{
  font-size:  11px;
}

.modal-user {

    padding-top: 2% !important;

}

.modal-dialog {

    margin-top: 0px;

}

.modal-title {

    font-size: 18px;

    font-weight: bold;

}

.modal-header {

  border-bottom: 0px !important;

}

.modal-content, #user-maintenance-content {

    background: #C1CDCD;

}

.btn-user-update {

    background: #012873 !important;

    margin-left: 10px;

    margin-top: 2%;

    border-radius: 0px;

}

.modal-user-details{

  margin-top: 5%;

    margin-bottom: 1%;

}

.btn-usersave-modal{

  text-align: right;

    margin-bottom: 2%;

    margin-top: 2%;

}

.active1 {

      background-color: #5c5a5a !important;

      color: white !important;

}

.modal-content{
  background-color: #fff;
}

.er-msg-modal {
    color: red;
    display: none;
    float: left;
    font-size: 12px;
}

.er-msg {
    color: red;
    display: none;
    float: left;
    font-size: 12px;
}
.sorted_by_check {
    margin-top: 1%;
}

.header-sort{
    margin-left: 7%;
    padding: 0px;
}

@media screen and  (max-width: 336px) {
  .create_div{
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
}

@media screen and  (min-width: 320px)  and (max-width: 768px){
  
  .header-sort{
    margin-left: 0%;
  }

  .res_select{
    padding: 0px;
  }

  .sorted {
    margin-left: 0px;
    margin-top: 30px;
  }

  .sorted-select {
    margin-left: 0px;
    
  }

  .agenda_add{
    width: 100%;
  }

  .btn-save{
    width: auto;
    margin-bottom: 2%;
  }

  .cat_label{
    margin-top: 2%;
  }
}

</style>
  
<div id="agenda_list">
  <div class="col-md-6 col-xs-12" style="padding: 0px;">
      
      <div class="col-md-12 col-xs-12 filtered"> Filtered By </div>

      <div class="col-md-5" style="padding: 0px;">

        <select class="form-control second-filter" style="width: 100%;" id="cat_filter">
          
          <option value="" >All Categories</option>        
          
          <?php foreach($cat_results as $cat_result): ?>

            <option value="<?php echo $cat_result->cat_maintenance_id; ?>" ><?php echo $cat_result->cat_maintenance_name; ?></option> 

          <?php endforeach; ?>

        </select>

      </div>

      <div class="col-md-5 res_select">

        <select class="form-control second-filter" style="width: 100%;" id="status_filter"> 

          <option value="" >All Status</option>

          <option value="1" >Active</option>

          <option value="0" >Inactive</option>

        </select>

      </div>

  </div>
  
  <div class="col-md-5 col-xs-12 header-sort" style="">
    
    <div class="col-md-12 col-xs-12 sorted pull-left"> Sorted By </div>
        <div class="col-md-12 sorted-select" >
      
          <select class="form-control second-filter" style="width: 50%;" id="sorted_all">
            
            <option ></option>
            <option value="agenda_maintenance_name">Agenda</option>
            <option value="cat_maintenance_name">Category</option>

          </select>

          <span class = "er-msg error-sort-by">Sorted by should not be empty *</span>
      
          <div class="col-md-12 pad-0 sorted_by_check">
            <div class="checkbox">

              <label>

                <input type="radio" class="sorting" value="ASC" name="sort"> Ascending

              </label>

            </div>

            <div class="checkbox">

              <label>

                <input type="radio" class="sorting" value="DESC" name="sort"> Descending

              </label>

            </div>

            <span class = "er-msg error-sort">Please check one of the following *</span>

          </div>

      </div>

  </div>

  <div class="col-md-6 filtered-select">

    

    

  </div>

 

<!-- 	<div class="col-md-6" style="padding-right:0px;padding-bottom:5px;padding-top:13px;">

    <div class="paginationsss"> 

    </div>

  </div> -->

  

  <div class="col-md-12 pull-right" style="text-align:right;margin-bottom: 20px; margin-right: -15px;">

  <button class="btnFilter abt btn">Filter</button>

  <button class="btnReset abt btn">Reset</button>

  <button class="btnCreate abt btn">Create Agenda</button>

  </div>





  


    <!-- <div class="table-top-border"></div> -->
  	<table id="tbl_users" class="table table-top-border" style="margin-bottom: 15px;">   



      <thead>

        <th>Agenda</th>

        <th>Category</th>

        <th style="width: 10%">Is Active</th>

        <th style="width: 10%">Action</th>

        

      </thead>



      <tbody class="tbody_users" >

      

      

      </tbody>



    </table>


    <div class="col-md-12 pagination_div no-padding"></div>

  

</div>

<div class="col-sm-12 col-md-12 col-lg-12  agenda_add pad-0" id="agenda_add" style="display:none;">

  <div class="col-sm-12 col-md-12 col-lg-12 top pad-0 agenda-border">

    <div class="col-sm-12 create_user">

      <div class="col-md-12 agenda-title pad-0">Agenda Information</div>

      <div id="submit-user" class="col-md-12 user-info-div pad-0">

        <div class="col-md-4 pad-0 ">

          <div class="form-group">

            <div class="col-md-4 pad-0">

              <label for="agenda" class="control-label">Agenda:<span class="required">*</span></label>

            </div>

            <div class="col-md-8">

              <input type="text" class="form-control inputs" id="agenda"  required>

              <span class = "er-msg-modal">Agenda should not be empty *</span>

            </div>

          </div>

        </div>

        <div class="col-md-4 pad-0 ">

          <div class="form-group">

            <div class="col-md-4 pad-0 cat_label">

              <label for="category" class="control-label">Category:<span class="required">*</span></label>

            </div>

            <div class="col-md-8">

              <select class="form-control inputs" style="width: 100%; " id="category">
        
                <option value="">Choose One</option>        
                
                <?php foreach($cat_results as $cat_result): ?>

                  <option value="<?php echo $cat_result->cat_maintenance_id; ?>" ><?php echo $cat_result->cat_maintenance_name; ?></option> 

                <?php endforeach; ?>

              </select>

              <span class = "er-msg-modal">Category should not be empty *</span>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="col-md-12 btn-agenda" style="">

    <button class="btnSaveUser abt btn btn-save">Save</button>

    <button class="btnCancelUser abt btn btn-save">Cancel</button>

  </div>

</div>


<!-- Update Agenda -->

<div class="modal fade" id="modal-user-maintenance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content" style = "border-radius:0px">

      <div class="modal-header txt-right" style = "padding: 25px 10px; background:transparent; background-color: #C1CDCD">

        <div class="col-md-12 pad-0">

          <div class="col-md-6 pad-0">

        <h4 class="modal-title" id="myModalLabel">UPDATE AGENDA</h4> </div><div class="col-md-6" style="    text-align: right;">

        <a style="display:none;" class = "close-video" data-dismiss="modal" aria-label="Close">[<span aria-hidden="true">&times;</span>]Close</a></div>

        </div>

      </div>

      <div  class="modal-body" style = "padding:0px; background:#fff">

        <div class="col-md-12" id="user-maintenance-content" style = "padding:10px;">

          

        </div>

      </div>



    </div>

  </div>
<div class="successdata"></div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    var edit_id = '';

    var active_page = '';

    var first_number = 1;

    var last_number = 0;

    var limit = 0;

    var current_first_users = 1;

    var current_page_users = 1;

    var current_last_users = 5;

    var default_page_show =5;

  var page = 1;

  load_data(default_page_show,page,'load1');

  load_data(default_page_show,page,'load2');


  $(document).on('click','.pagenum',function() {

    page = $(this).val();

    onchange(page,'load1');

    $('.pagenum').removeClass('active1');

    $(this).addClass('active1');

    $('.prev').val(parseInt(page)-1);

    $('.next').val(parseInt(page)+1);

  });

  $(document).on('click','.next',function() {

    page = $(this).val();

    if(page <= parseInt($('.last-page').val())){

      onchange(page,'load1');

      $(this).val(parseInt(page)+1);

      $('.prev').val(parseInt(page)-1);

      if(page > 3){

        onchange(page,'load2');

      }

      $('.pagenum').removeClass('active1');

      $('.num_'+page).addClass('active1');

    }

  });

  $(document).on('click','.prev',function() {

    page = $(this).val();

    if(page >0){

      onchange(page,'load1');

      $(this).val(parseInt(page)-1);

      $('.next').val(parseInt(page)+1);

      if(parseInt($('.f-page').val()) > page){

        onchange(page,'load2');

      }

      $('.pagenum').removeClass('active1');

      $('.num_'+page).addClass('active1');

    }

  });

  $(document).on('click','.prevnext',function() {

    page = $(this).val();

    onchange(page,'load1');

    onchange(page,'load2'); 

  });

  function onchange(page,loadme){

      var default_page_show = '5';

      load_data(default_page_show,page,loadme);
  }

  function load_data(default_page_show,page,loadme) {

    var search = $('#search_id').val();

    var cat_filter = $('#cat_filter').val();

    var status_filter = $('#status_filter').val()

    var sort = $('input[name="sort"]:checked').val();

    var sorted_all = $('#sorted_all').val();

    var agend_filter = {'cat_filter':cat_filter, 'status_filter':status_filter, 'sort':sort, 'sorted_all':sorted_all}

    $.ajax({

        type: 'post',

        url: '<?=base_url();?>Maintenance/load_agenda',

        data: { "t":new Date().getTime(),'limit':default_page_show, 'agend_filter':agend_filter, 'search':search, 'page':page, 'loadme':loadme,'table':'ojl_agenda_maintenance'}

      }).done(function(data){

        if(loadme=='load1'){

          if (!$.trim(data)){  

          var htm ='';

            htm += '<tr>';

            htm += '<td colspan="4" style="pointer-events: none;cursor: default;"class="ctd">No records to show.</td>';
            
            htm += '</tr>';
            
              $('.tbody_users').html('');
            
              $('.tbody_users').append(htm);
          
          } else {
          
            $(".tbody_users").html(data);

          }

        }

        else{

          $(".pagination_div").html(data);

          $('.pagenum').removeClass('active1');

          $('.num_'+page).addClass('active1');  

        }

      });

  }  

    function show_page_itemslogs() {

        $('.page_num_logs').hide();

        l = current_first_users;

        while(l<=current_last_users){

          $('.page_item_logs'+l).show();

          l++;

        }

      }

    // refresh_load();

  //   function refresh_load(search_data){

  // $.ajax({

  //     type:'post',

  //     url:'<?= base_url()?>maintenance/get_total_records',

  //     data: {"table":"ojl_agenda_maintenance", "search" : search_data}

  //   }).done(function(result) {

  //     var y = result /5;

  //     y = Math.ceil(y);

  //     last_number = y;

  //     var q = '';

  //     for(i = 1; i <= y; ++i) {

  //      q+= '<button class="page_num_logs page_item_logs'+i+' cbtnpaginate" id=""  value="'+i+'" style="margin-right:5px;">'+i+'</button>';

  //   }

  //   $('#pages_logs').html(q);

  //   if(y < 1){

  //      var htm ='';

  //      htm += '<tr>';

  //      htm += '<td colspan="5" style="pointer-events: none;cursor: default;"class="acenter">No records to show.</td>';

  //      htm += '</tr>';

  //      $('.tbody_users').html('');

  //      $('.tbody_users').append(htm);

  //      $('.divpaginate').hide();

  //   } else {

  //     $('.divpaginate').show();

  //   }

  //   show_page_itemslogs();

  //   $('.page_item_logs1').addClass('active1');

  //   })

  // }

    $(document).on('click', '.page_num_logs', function() {

      var page_number_logs = $(this).val();

      first_number = page_number_logs;

      $('.page').hide();

      $('.page_'+first_number).show();

      $('.page_num_logs').removeClass('active1');

      $('.page_item_logs'+page_number_logs).addClass('active1');

      current_page_users = page_number_logs;

    })

    $('#next_logs').click(function(v) {

      v.preventDefault();

      //$(this).css('color', 'white');

      if(first_number != last_number) {

        limit+=3;

        first_number++;

        current_page_users++;

        $('#id_outof_logs').html('');

        $('#id_outof_logs').html(first_number+" of "+last_number);

        $('.page').hide();

        $('.page_'+first_number).show();

        $('.page_num_logs').removeClass('active1');

        $('.page_item_logs'+current_page_users).addClass('active1');

        if(current_page_users > current_last_users){

          current_last_users = current_page_users;

          current_first_users = current_last_users - 4;

          show_page_itemslogs();

        }

      }

    })

    $('#prev_logs').click(function(v) {

      v.preventDefault();

     // $(this).css('color', 'white');

      if(first_number != 1) {

        first_number--;

        current_page_users--;

        $('#id_outof_logs').html('');

        $('#id_outof_logs').html(first_number+" of "+last_number);

        $('.page').hide();

        $('.page_'+first_number).show();

        $('.page_num_logs').removeClass('active1');

        $('.page_item_logs'+current_page_users).addClass('active1');

        if(current_page_users < current_first_users){

          current_last_users = current_page_users + 4;

          current_first_users = current_page_users;

          show_page_itemslogs();

        }

      }

    })

     $('#last_logs').click(function(v) {

      v.preventDefault();

      //$(this).css('color', 'white');

      first_number = last_number;

      $('#id_outof_logs').html('');

      $('#id_outof_logs').html(first_number+" of "+last_number);

      $('.page').hide();

      $('.page_'+first_number).show();

      current_last_users = last_number;

      current_page_users = current_last_users;

      current_first_users = current_last_users - 4;

      show_page_itemslogs();

        $('.page_num_logs').removeClass('active1');

        $('.page_item_logs'+current_page_users).addClass('active1');

    })

      $('#first_logs').click(function(v) {

      v.preventDefault();

     // $(this).css('color', 'white');

      first_number = 1;

      $('#id_outof_logs').html('');

      $('#id_outof_logs').html(first_number+" of "+last_number);

      $('.page').hide();

      $('.page_'+first_number).show();

      current_first_users = 1;

      current_page_users = 1;

        if(last_number < 5) {

          current_last_users = last_number;

        } else {

          current_last_users = 5;

        }

        show_page_itemslogs();

        $('.page_num_logs').removeClass('active1');

        $('.page_item_logs'+current_page_users).addClass('active1');

    })


   $(document).on('click', '.btnCreate', function() {

      $("select").each(function() { this.selectedIndex = 0 });

      $("input.sorting").each(function() { $(this).prop('checked', false); });

      $("input").each(function() { $(this).val(""); });

      $('.second-filter').val("");

      $('#agenda_add').show();

      $('#agenda_list').hide();

      $('.page_title').html("");

      $('.page_title').html("Create Agenda");

    })

  $(document).on('click', '.btnCancelUser', function() {
      
    bootbox.confirm("<b>Are you sure you want to leave this page?</b>", function(e) {
        
        if(e) {

          // window.location = '<?=base_url();?>home'
          
          $('#modal-user-maintenance').modal('hide');
          
          $('#agenda_add').hide();

          $('#agenda_list').show();

          $('.page_title').html("");

          $('.page_title').html("Agenda");

          $('.edit').each(function(){
                      $(this).next().hide();
                      $(this).css('border','1px solid #ccc'); 
        });

       }

    })
  })

   $(document).on('click', '.successdata', function() {
      
      
        //window.location = '<?=base_url();?>maintenance/user';
        $('#modal-user-maintenance').modal('hide');
        $('#agenda_add').hide();

        $('#agenda_list').show();

        $('.page_title').html("");

        $('.page_title').html("Agenda");
      $('.inputs').each(function(){
                    $(this).next().hide();
                    $(this).css('border','1px solid #ccc'); 
      });
 
    })

      $(document).on('click', '.btnSaveUser', function() {



      var agenda = $('#agenda').val();

      var category = $('#category').val();

      var counter = 0; 

      $('.inputs').each(function(){

        var input = $(this).val();

        if (input.length == 0) {

            $(this).css('border','1px solid red');

            $(this).next().show();

            counter++;

        }else{

            $(this).next().hide();

            $(this).css('border','1px solid #ccc');
        }

      });
        if(counter == 0){
          $.ajax({

            type:'post',

            url:'<?=base_url();?>Maintenance/insert_agenda',

            data:{'agenda':agenda,'category':category }

          }).done(function(result) {

          if(result == 1 ){

            // alert("Successsfully added!");

            bootbox.alert('<b style="color:black">Successsfully added!!</b>');

            load_data(5,1,'load1');

            load_data(5,1,'load2');

            $('.successdata').click();

          } else {

            bootbox.alert('<b style="color:black">Something went wrong!!</b>');

          }         

          })
        
        } else {

          bootbox.alert('<b style="color:red">Please fill out all the required fields!</b>');

        }

    })

  $(document).on('click', '.agenda-edit-icon', function() {



        var agenda_id = $(this).attr('data-id');

        $.ajax({

          type:'post',

          url:'<?=base_url();?>Maintenance/get_agenda',

          data:{'agenda_id':agenda_id}

        }).done(function(result) {

            var htm = "";

            var obj = JSON.parse(result);

            var check = "";

            $.each(obj, function(x,y) {



            if(y.is_active > 0){

              check = "checked";

            }



          htm   +=  '<div class="col-md-12 modal-user-details pad-0">';

          

          htm   +=  '<div class="col-md-12 modal-user pad-0">';     

          htm   +=  '<div class="col-md-4 pad-0">';

          htm   +=  '<label for="username" class="control-label">Agenda:</label>';

          htm   +=  '</div>';

          htm   +=  '<div class="col-md-8">';

          htm   +=  '<input type="hidden" class="form-control" id="agenda_id" value="'+y.agenda_maintenance_id+'"  required>';

          htm   +=  '<input type="text" class="form-control edit" id="agenda_name" value="'+y.agenda_maintenance_name+'"  required>';

          htm   += '<span class = "er-msg-modal">Agenda should not be empty *</span>';

          htm   +=  '</div></div>';

          htm   +=  '<div class="col-md-12 modal-user pad-0">'; 

          htm   +=  '<div class="col-md-4 pad-0 cat_label">';

          htm   +=  '<label for="username" class="control-label">Category:</label>';

          htm   +=  '</div>';

          htm   +=  '<div class="col-md-8">';

          htm   +=  '<select name="category" class="role_name form-control" id="update_cat">';

          htm   += '<?php foreach($cat_results as $cat_result): ?>';

          htm   += '<option value="<?php echo $cat_result->cat_maintenance_id; ?>"> <?php echo $cat_result->cat_maintenance_name; ?></option> ';

          htm   += '<?php endforeach; ?>';

          htm   +=  '</select>';

          htm   +=  '</div></div>';
          

          htm   +=  '</div>';

          htm   +=  '<div class="col-md-12 modal-user pad-0">'; 

          htm   +=  '<div class="col-md-4 pad-0">';

          htm   +=  '<label for="username" class="control-label">Is Active:</label>';

          htm   +=  '</div>';


          htm   +=  '<div class="col-md-8">';

          htm   +=  '<input type="checkbox" id="isactive-modal" value="'+y.is_active+'"  '+check+'>';

          htm   +=  '</div></div>';                             

          

          htm   +=  '<div class="col-md-12 btn-usersave-modal" style="">';    

          htm   +=  '<button class="btnUpdateUser abt btn btn-user-update">Save</button>';   

          htm   +=  '<button  class="close-video btnCancelUser abt btn btn-user-update">Cancel</button>';    

          htm   +=  '</div>';   



          htm   +=  '</div>';





              $('#user-maintenance-content').html('');

              $('#user-maintenance-content').html(htm);



                    jQuery('#modal-user-maintenance').modal({

                    backdrop: 'static',

                    keyboard: false

                });

                $('#update_cat option[value='+y.cat_maintenance_id+']').attr('selected','selected');

          })

        })

  })

      $(document).on('click', '.btnUpdateUser', function() {



        var agenda_name = $('#agenda_name').val();

        var update_cat = $('#update_cat').val();

        var id = $('#agenda_id').val();

        if($("#isactive-modal").is(':checked')){

             var isactive = 1;

        } else {

             var isactive = 0;

        }

        var counter = 0; 

        $('.edit').each(function(){

          var input = $(this).val();

          if (input.length == 0) {

              $(this).css('border','1px solid red');

              $(this).next().show();

              counter++;

          }else{

              $(this).next().hide();

              $(this).css('border','1px solid #ccc');
          }

        });

        if(counter == 0){
            $.ajax({

              type:'post',

              url:'<?=base_url();?>Maintenance/update_agenda',

              data:{'isactive':isactive,'id':id,'agenda_name':agenda_name,'update_cat':update_cat }

            }).done(function(result) {

            if(result == 1 ){

              // alert("Successsfully Updated!");

              bootbox.alert('<b style="color:black">Successsfully Updated!!</b>');

              load_data(5,1,'load1');

              load_data(5,1,'load2');



              $('.successdata').click();



            } else {


              bootbox.alert('<b style="color:red">Something went wrong!</b>');

            }         

            })
        } else {
          bootbox.alert('<b style="color:black">Please fill out all the required fields!</b>');
        }

    })

   $(document).on('click', '.btnReset', function() {

  

      $("select").each(function() { this.selectedIndex = 1 });

      $("input.sorting").each(function() { $(this).prop('checked', false); });

      $("input").each(function() { $(this).val(""); });

      $('.second-filter').val("");

      $('.btnFilter').click();



  })

  $(document).on('click', '.btnFilter', function() { 
    var sorted_all = $('#sorted_all').val();
    var sort = $('input[name="sort"]:checked').val();
    
    if(sorted_all != '' && sort == undefined){
          $('.sorted_by_check').css('border','1px solid red');
          $('.error-sort').show();
          $('.error-sort-by').hide();
          $('#sorted_all').css('border','1px solid #ccc');
    } else if(sort != undefined && sorted_all == ''){
        $('#sorted_all').css('border','1px solid red');
        $('.error-sort-by').show();
        $('.error-sort').hide();
        $('.sorted_by_check').css('border','0px solid #ccc');
    } else {
        $('.sorted_by_check').css('border','0px solid #ccc');
        $('#sorted_all').css('border','1px solid #ccc');
        $('.error-sort').hide();
        $('.error-sort-by').hide();
        load_data(5,1,'load1');
        load_data(5,1,'load2');
    } 

  })

})

</script>