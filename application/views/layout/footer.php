
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

    </script>
  </body>
</html>