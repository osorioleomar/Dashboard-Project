<?php $this->load->view('layout/header') ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Comments
            <small>See what they say</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box"><!-- Start box for parameters -->
                <div class="box-header with-border">
                    <h3 class="box-title"> Select Filters </h3>
                </div>
                <div class="box-body">
                  <div class="col-sm-4 text-center">
                    <div class="alert alert-success">
                      <div class="input-group">
                        <label class="label-success input-group-addon form-control">Campaign-related only</label>
                        <span class="label-default btn input-group-addon">
                          <input type="checkbox" class="flat-red filter-control" id="campaign-only"/>
                        </span>
                      </div>
                        <br>
                        <div class="input-group">
                          <label class="input-group-addon label-success">Module</label>
                          <select class="form-control filter-control" id="module">
                            <option value="All">All</option>
                            <option value="Leads">Leads</option>
                            <option value="Accounts">Accounts</option>
                            <option value="Contacts">Contacts</option>
                            <option value="Potentials">Opportunities</option>
                          </select>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-sm-4">
                    <div class="alert alert-warning">
                      <div class="input-group">
                        <label class="input-group-addon btn label-warning">Filter</label>
                        <select id="fieldname" class="form-control">
                            <option value="m.label">Related to</option>
                            <option value="whodid">Comment by</option>
                            <option value="commentcontent">Comment</option>
                        </select>
                      </div>
                        <br>
                          <input id="filter-text" placeholder="Type your keyword" class="form-control filter-control">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="alert" style="border: solid 1px #C7C8C8">
                      <div class="text-aqua">
                        Select a range for change date:
                      </div>
                      <br>
                      <div id="reportrange" class="form-control text-muted" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <span></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-1 alert-success text-center">
                    <h1><?php echo $comments_today ?></h1><small>Comments Today</small>
                  </div>
                </div>
              </div><!-- /. box fir parameters -->
            </div>

            <div class="col-md-12 well" style="margin-left: 10px" id="commentsContainer">

            </div>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="http://www.cimtechnologies.com">CIM Technologies, Inc.</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/dist/js/invites.js" type="text/javascript"></script>
    <!-- Jasny Plugin -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>        
    <!-- daterange picker -->
    <link href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- date-range-picker -->
    <script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

 <!--SECTION FOR FEEDBACKS-->   
    <div class="feedback-form nav navbar-fixed-bottom text-right">
        <a href="#" class="btn" id="minimize"><i class="fa fa-arrow-left"></i></a>
        <a href="#" class="btn" id="maximize"><i class="fa fa-arrow-right"></i></a>
        <div class="input-group">
            <textarea type="text" id="feedback" placeholder="Please let me know what's on your mind. Type your feedback here." class="form-control" rows="3"></textarea>
            <a href="#" id="f_submit" class="btn input-group-addon"><i class="fa fa-check"></i></a>
        </div>        
    </div>

    <script type="text/javascript">
            //for feedback
            $("a.alert").hide();

            $("#f_submit").click(function(){
                var feedback = $("#feedback").val();

                if(feedback==''){
                  alert("Please don't submit an empty comment box. Thank you.");
                }else{
                $.post("<?php echo base_url('feedback/save_feedback') ?>",{user_feedback: feedback},function(){
                    alert("We've received your feedback. Thank you so much for your contribution.");
                    $("#feedback").val('');
                })
              }
            });


            $("#get_feedback").click(function(){
              $.post("<?php echo base_url('dashboard/get_feedbacks') ?>",function(data){
                $("#feedbackContainer").html(data);
              },"html");
            });

            $(document).on('click','#minimize',function(){
                $(".feedback-form").animate({width: '230px'},"slow");
            });

            $(document).on('click','#maximize',function(){
                $(".feedback-form").animate({width: '100%'}, "slow");
            });

            //for new users
            $("#create").click(function(){
                var username = $("#username").val();
                var name = $("#name").val()
                var email = $("#email").val()
                var user_type = $("#user_type").val()

                $.post("<?php echo base_url('user/add') ?>",{ username1 : username, name1 : name, email1: email, usertype1: user_type}, function(data){
                    $("#create-success").text("Successfully added one account to dashboard users.");
                    $("#username").val('');
                    $("#name").val('');
                    $("#email").val('');
                    $("#usertable").append("<tr><td>" + username + "<sup class='label label-danger'>NEW</sup></td><td>" + name + "</td><td>" + email + "</td><td>" + user_type + "</td><td>Not Yet</td><td><a href='#'><i class='fa fa-edit'></i></a><a href='#'><i class='fa fa-trash'></i></a></td></tr>")
                });
            });

            $("#update").click(function(){
                if($("#u_password").val() == $("#u_cpassword").val()){
                    var name = $("#u_name").val();
                    var email = $("#u_email").val();
                    var password = $("#u_password").val();

                    $.post("<?php echo base_url('user/update_user') ?>",{ name1 : name, email1 : email, password1 : password}, function(data){
                        $("#nomatch-alert").fadeOut();
                        $("#success-alert").fadeIn();
                    })
                    
                }else{
                    $("#nomatch-alert").show();
                } 
            })

      $("#show_leads_today").click(function(){
        $.post("<?php echo base_url() ?>dashboard/load_leads_today",function(data){
          $("#notifContainer").html(data);
        },"html")
      });

      $("#show_inactive_month").click(function(){
        $.post("<?php echo base_url() ?>dashboard/load_inactive_month",function(data){
          $("#notifContainer").html(data);
        },"html")
      });

      $("#show_never_month").click(function(){
        $.post("<?php echo base_url() ?>dashboard/load_never_month",function(data){
          $("#notifContainer").html(data);
        },"html")
      });

      $(document).ready(function(){
          var module = '';
          var campaign = '';
          var fieldname = '';
          var keyword = '';
          var startdate = '';
          var enddate = '';

        //$('#daterange').daterangepicker();

        $.post("<?php echo base_url() ?>comments/get_comments",function(data){
              $("#commentsContainer").parent().addClass('text-center');
              $("#commentsContainer").html("<img src='<?php echo base_url() ?>/assets/dist/img/loader.gif' width='100px'>");

              $("#commentsContainer").html(data);
              $("#commentsContainer").parent().removeClass('text-center');
        },"html");

        /*
          AJAX to call filtered comments
        */
        $(document).on('change','.filter-control',function(){
          module = $("#module").val();
          if($("#campaign-only").is(':checked')){
            campaign = 'checked';
          }else{
            campaign = 'unchecked';
          }
          fieldname = $("#fieldname").val();
          keyword = $("#filter-text").val();               

          $("#commentsContainer").parent().addClass('text-center');
          $("#commentsContainer").html("<img src='<?php echo base_url() ?>/assets/dist/img/loader.gif' width='100px'>");

          $.post("<?php echo base_url() ?>comments/comments_filtered",{campaign : campaign, module : module, fieldname : fieldname, keyword : keyword, startdate : startdate, enddate : enddate},function(data){

                $("#commentsContainer").html(data);
                $("#commentsContainer").parent().removeClass('text-center');
          },"html");

        }) // end of filter ajax

        /* Date PICKER */
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
       
          $('#reportrange').daterangepicker({
              format: 'MM/DD/YYYY',
              startDate: moment().subtract(29, 'days'),
              endDate: moment(),
              minDate: '01/01/2014',
              maxDate: '12/31/3015',
              //dateLimit: { days: 60 },
              showDropdowns: true,
              showWeekNumbers: true,
              timePicker: false,
              ranges: {
                 'Today': [moment(), moment()],
                 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                 'This Month': [moment().startOf('month'), moment().endOf('month')],
                 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                 'This Year': [moment().startOf('year'), moment().endOf('year')],
              },
              opens: 'left',
              drops: 'down',
              buttonClasses: ['btn', 'btn-sm'],
              applyClass: 'btn-primary',
              cancelClass: 'btn-default',
              separator: ' to ',
              locale: {
                  applyLabel: 'Submit',
                  cancelLabel: 'Cancel',
                  fromLabel: 'From',
                  toLabel: 'To',
                  customRangeLabel: 'Custom',
                  daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                  monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                  firstDay: 1
              }
          }, function(start, end, label) {
              //console.log(start.toISOString(), end.toISOString(), label);
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
              startdate = start.format('MMMM D, YYYY');
              enddate = end.format('MMMM D, YYYY');

          module = $("#module").val();
          if($("#campaign-only").is(':checked')){
            campaign = 'checked';
          }else{
            campaign = 'unchecked';
          }
          fieldname = $("#fieldname").val();
          keyword = $("#filter-text").val();

          //console.log(module + campaign + fieldname + keyword + startdate + enddate);

          $.post("<?php echo base_url() ?>comments/comments_filtered",{campaign : campaign, module : module, fieldname : fieldname, keyword : keyword, startdate : startdate, enddate : enddate},function(data){
                $("#commentsContainer").parent().addClass('text-center');
                $("#commentsContainer").html("<img src='<?php echo base_url() ?>/assets/dist/img/loader.gif' width='100px'>");

                $("#commentsContainer").html(data);
                $("#commentsContainer").parent().removeClass('text-center');
          },"html");
          
          });

      });

    </script>
  </body>
</html>