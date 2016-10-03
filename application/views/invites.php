<!--load head codes -->
<?php $this->load->view('layout/header.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Invite Participants
            <small>Search them here</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content text-muted">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
                <div class-"box-body">
                  <div class="tab-content" id="invitesList">
                    <div role="tabpanel" class="tab-pane fade" id="invitelist">
                      <table class="table table-striped">
                        <tr>
                          <th>Contact Person</th>
                          <th>Company</th>
                          <th>Address</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Position</th>
                          <th>Industry</th>
                        </tr>
                      </table>
                    </div><!-- /. inviteList -->
                    <div role="tabpanel" class="tab-pane fade active in" id="search" style="padding: 10px">
                      <div class="row">
                        <div class="col-sm-4">
                          <small>
                          <strong>Quick Search</strong>
                          <br><br>
                            <div class="input-group">
                              <label class="input-group-addon alert-info">Module</label>
                              <select class="form-control" id="module">
                                  <option value="leads" selected>Leads</option>
                                  <option value="accounts">Accounts</option>
                                  <option value="contacts">Contacts</option>
                              </select>
                            </div>
                            <br>
                            <div class="input-group">
                              <label class="input-group-addon alert-info">Industry</label>
                              <select class="form-control" id="industry">
                                <option value="" selected>----</option>
                                  <?php foreach($industry as $row){ ?>
                                  <option><?php echo $row->cf_758 ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <br>
                            <div class="btn-group">
                              <label class="btn">Location</label>
                              <select class="btn" id="location" multiple>
                                <?php foreach($location['contacts']->result() as $row){ ?>
                                  <option class="text-left"><?php echo $row->city ?></option>
                               <?php } ?>
                              </select>
                            </div>
                          </small>
                        </div>
                        <div class="col-sm-8">
                          <small>
                            <strong>Advance Search</strong>
                            <div id="conditionContainer">

                            </div>
                            <br><br>
                            <button class="btn btn-success btn-sm" id="add-control"><i class="fa fa-plus"></i> Add Condition</button>
                          </small>
                        </div>
                      </div><!-- /. row -->
                      <br>
                      <div class="text-center"><button class="btn btn-success" id="generate">Generate</button></div>
                      <br>
                      <div class="well" id="results" style="overflow: hidden">
                        Results here
                      </div>
                    </div>
                  </div><!-- /. invites tab-content -->
                </div>
              </div>
            </div>
          </div><!-- /.row -->
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
        var module = $("#module").val();
        var fieldname = [];
        var condition = [];
        var value = [];
        var andor = [];
        var industry = $("#industry").val();
        var location = $("#location").val();


        $("#results").html("<div class='col-md-12 text-center'><img src='<?php echo base_url() ?>assets/dist/img/loading.gif'><div>");
        $.post("<?php echo base_url() ?>campaign/get_leads",function(data){
          $("#results").html(data);
        },"html");

        $("#add-control").click(function(){
          
          var contacts = "<div class='filterContainer'><br> <div class='col-sm-3'> <select class='form-control fieldname'> <?php foreach($fields['contacts'] as $field){ ?> <option value='<?php echo $field->columnname ?>'> <?php echo $field->fieldlabel ?> </option> <?php } ?> </select> </div> <div class='col-sm-3'> <select class='form-control condition'> <option value='=' selected>equal to</option><option value='!='>not equal to</option><option value='like'>contains</option><option value='not like'>does not contain</option></select></div><div class='col-sm-3'><input class='form-control value' placeholder='Type your keyword'></div><div class='col-sm-2'><select class='form-control andor'><option>and</option><option>or</option></select></div><button class='btn btn-danger remove'><i class='fa fa-close'></i></button></div>";
          var leads = "<div class='filterContainer'><br> <div class='col-sm-3'> <select class='form-control fieldname'> <?php foreach($fields['leads'] as $field){ ?> <option value='<?php echo $field->columnname ?>'> <?php echo $field->fieldlabel ?> </option> <?php } ?> </select> </div> <div class='col-sm-3'> <select class='form-control condition'> <option value='=' selected>equal to</option><option value='!='>not equal to</option><option value='like'>contains</option><option value='not like'>does not contain</option></select></div><div class='col-sm-3'><input class='form-control value' placeholder='Type your keyword'></div><div class='col-sm-2'><select class='form-control andor'><option>and</option><option>or</option></select></div><button class='btn btn-danger remove'><i class='fa fa-close'></i></button></div>";
          var accounts = "<div class='filterContainer'><br> <div class='col-sm-3'> <select class='form-control fieldname'> <?php foreach($fields['accounts'] as $field){ ?> <option value='<?php echo $field->columnname ?>'> <?php echo $field->fieldlabel ?> </option> <?php } ?> </select> </div> <div class='col-sm-3'> <select class='form-control condition'> <option value='=' selected>equal to</option><option value='!='>not equal to</option><option value='like'>contains</option><option value='not like'>does not contain</option></select></div><div class='col-sm-3'><input class='form-control value' placeholder='Type your keyword'></div><div class='col-sm-2'><select class='form-control andor'><option>and</option><option>or</option></select></div><button class='btn btn-danger remove'><i class='fa fa-close'></i></button></div>";
          
          switch(module){
            case 'contacts':
              $("#conditionContainer").append(contacts); break;
            case 'leads':
              $("#conditionContainer").append(leads); break;
            case 'accounts':
              $("#conditionContainer").append(accounts); break;
          }
          $(".andor").show();
          $(".andor:last").hide();
        });

        $("#generate").click(function(){

          module = $("#module").val();
          industry = $("#industry").val();
          location = $("#location").val();

          $('.fieldname').each(function(){
              fieldname.push($(this).val()); 
          });

          $('.condition').each(function(){
              condition.push($(this).val()); 
          });

          $('.value').each(function(){
              value.push($(this).val()); 
          });

          $('.andor').each(function(){
              andor.push($(this).val()); 
          });

          $("#results").html("<div class='col-md-12 text-center'><img src='<?php echo base_url() ?>assets/dist/img/loading.gif'><div>");
          $.post("<?php echo base_url() ?>campaign/filter_result",{fieldname : fieldname, condition : condition, value : value, module : module, industry : industry, location : location, andor : andor},function(data){

            $("#results").html(data);

          },"html");

          fieldname = [];
          condition = [];
          value = [];
          andor = [];
        });

        $(document).on('click','.remove',function(){
          var toDelete = $(this).parent();

          toDelete.remove();
        });

        $(document).on('change','#module',function(){
          module = $("#module").val();
          $("#conditionContainer div").remove();
          $("#conditionContainer br").remove();

        /* TODO limit numbers of filters*/

          switch(module){
            case "leads":
              $("#location").html("<?php foreach($location['leads']->result() as $row){ ?><option class='text-left'><?php echo $row->city ?></option><?php } ?>");break;
            case "accounts":
              $("#location").html("<?php foreach($location['accounts']->result() as $row){ ?><option class='text-left'><?php echo $row->city ?></option><?php } ?>");break;
            /* BUG: cannot use contacts array because of line breaks*/
            case "contacts":
              $("#location").html("<?php foreach($location['accounts']->result() as $row){ ?><option class='text-left'><?php echo ($row->city) ?></option><?php } ?>");break;
          }
        })

      })

    </script>
  </body>
</html>