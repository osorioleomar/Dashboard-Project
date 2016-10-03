<!--load head codes -->
<?php $this->load->view('layout/header.php') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jasny/jasny-bootstrap.min.css') ?>">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success" id="list">
                <div class="box-header">
                  <h3 class="box-title">Active Users</h3>
                  <div class="pull-right">
                    <a href="#new" class="btn btn-default">Add New User<a>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-bordered table-striped" id="usertable">
                    <tr>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Last Login</th>
                      <th style="width: 10px">Action</th>
                      <?php 
                        $names = array();
                        foreach($users as $user){ 
                          $names[$user->userid] = $user->name;
                      ?>
                        <tr>
                          <td><?php echo $user->username; ?></td>
                          <td><?php echo $user->name; ?></td>
                          <td><?php echo $user->email; ?></td>
                          <td><?php echo $user->user_type; ?></td>
                          <td><?php echo $user->last_login; ?></td>
                          <td><a href="#"><i class="fa fa-edit"></i></a><a href="<?php echo base_url('user/delete') . '/' . $user->userid ?>" data-toggle="modal" data-target="#confirmDelete"><i class="fa fa-trash"></i></a></td>
                        </tr>
                      <?php } ?>
                    </tr>
                  </table>
                </div>
              </div><!-- ./box -->

              <!-- Add New User -->

              <div class="box box-success" id="new">
                <div class="box-header">
                  <h3 class="box-title">Add New User</h3>
                  <p class="text-green" id="create-success"></p>
                </div>
                <div class="box-body text-center">
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="input-group">
                        <label class="input-group-addon">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="username">
                      </div><br>
                      <div class="input-group">
                        <label class="input-group-addon">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="full name">
                      </div><br>
                      <div class="input-group">
                        <label class="input-group-addon">Email</label>
                        <input id="email" class="form-control" placeholder="email address">
                      </div><br>
                      <div class="input-group">
                        <label class="input-group-addon">User Type</label>
                        <select id="user_type" class="form-control">
                          <option value="Admin">Administrator</option>
                          <option value="Marketing" selected>Marketing</option>
                          <option value="User">Viewer</option>
                        </select>
                      </div><br>
                    </div>
                    <div class="col-xs-6">
                      <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          <img data-src="holder.js/100%x100%" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                            <input type="file" name="filename" id="image"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div><!-- ./ col-xs-6 -->
                  </div><!-- ./row -->
                  <button class="btn btn-success" id="create">Create</button>
                </div>
              </div><!-- ./box -->

            </div><!-- ./col-md-12 -->
          </div><!-- ./row -->

          <!-- MODAL Confirmation -->
          <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body text-center">
                  <p>Are you sure you want to delete <strong><?php echo $names[5] ?></strong> from the list of users?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success btn-flat" id="update">Confirm</button>
                </div>
              </div>
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
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>

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
                $.post("<?php echo base_url('feedback/save_feedback') ?>",{user_feedback: feedback},function(){
                    alert("We've received your feedback. Thank you so much for your contribution.");
                    $("#feedback").val('');
                })
            })

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
    </script>
  </body>
</html>