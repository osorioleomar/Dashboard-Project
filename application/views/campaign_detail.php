<!--load head codes -->
<?php $this->load->view('layout/header.php') ?>    <!-- DATA TABLES -->
    <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>" type="text/javascript"></script>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Campaign Detail
            <small>Where leads are gathered</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success"><!-- box -->
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $campaigns[0]->campaignname ?></h3>
                </div>
                <div class="box-body">
                  <small>
                  <br>
                  <div class="row">
                    <div class="col-sm-5">
                      <table class="table table-bordered table-striped">
                        <?php foreach($campaigns as $campaign){ ?>
                        <tr>
                          <th class="text-right">Campaignname</th>
                          <td class="text-left"><?php echo $campaign->campaignname ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Description</th>
                          <td class="text-left"></th>
                        </tr>
                        <tr>
                          <th class="text-right">Campaign Type</th>
                          <td class="text-left"><?php echo $campaign->campaigntype ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Sponsor</th>
                          <td class="text-left"><?php echo $campaign->sponsor ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Campaign Status</th>
                          <td class="text-left"><?php echo $campaign->campaignstatus ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Start Date</th>
                          <td class="text-left"><?php echo $campaign->startdate ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">End Date</th>
                          <td class="text-left"><?php echo $campaign->closingdate ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Industry</th>
                          <td class="text-left"><?php echo $campaign->industry ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Target Audience</th>
                          <td class="text-left"><?php echo $campaign->targetaudience ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Assigned To</th>
                          <td class="text-left"><?php echo $campaign->user ?></th>
                        </tr>
                        <tr>
                          <th class="text-right">Last Update</th>
                          <td class="text-left"><?php echo $campaign->last_update ?></th>
                        </tr>
                        <?php } ?>
                    </table>
                  </div><!-- /. col-sm-5 -->
                  <div class="col-sm-7">
                    <?php 
                      $targets = array(
                        'budget' => $campaigns[0]->budgetcost,
                        'response' => $campaigns[0]->expectedresponsecount,
                        'salescount' => $campaigns[0]->expectedsalescount,
                        'roi' => $campaigns[0]->expectedroi,
                        );

                      $actuals = array(
                        'budget' => $campaigns[0]->actualcost,
                        'response' => $campaigns[0]->actualresponsecount,
                        'salescount' => $campaigns[0]->actualsalescount,
                        'roi' => $campaigns[0]->actualroi,
                        );
                     ?>

                    <h4><span class="text-muted">Targets</span> vs. <span class="text-info">Actuals</span></h4><br>
                        <canvas id="myChart" width="500px"></canvas>
                    <br><br>
                    <h4 class="text-green">Numbers</h4>
                    <div class="col-sm-3 alert alert-success text-center">
                      <h3><?php echo "  " . $numbers['leads'] . "  " ?> <i class="fa fa-users"></i></h3>
                    </div>
                    <div class="col-sm-3 alert alert-warning text-center">
                      <h3><?php echo " " . $numbers['accounts'] . " " ?> <i class="fa fa-building"></i>  </h3>
                    </div>
                    <div class="col-sm-3 alert alert-info text-center">
                      <h3><?php echo $numbers['contacts'] . " "?> <i class="fa fa-phone"></i>  </h3>
                    </div>
                    <div class="col-sm-3 alert alert-danger text-center">
                      <h3><div><?php echo $numbers['potentials'] . " " ?> <i class="fa fa-money"></i>  </div></h3>
                    </div>
                  </div>
                  </div>
                </small>
                </div>
              </div><!-- /. box -->
            </div>
            <div class="col-md-12">
              <div class="box box-info">
                <div class="box-header">
                  <div class="col-sm-6">
                    <h3 class="box-title">Invites</h3>
                  </div>
                  <div class="col-sm-6">
                    <ul class="nav nav-tabs pull-right">
                      <li class="active"><a href="#search" data-toggle="tab" role="tab" arai-expanded="false"><i class="fa fa-search"></i> Search</a></li>
                      <li><a href="#prospects" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-phone"></i> Prospects List</a></li>
                      <li><a href="#invitelist" data-toggle="tab" role="tab" arai-expanded="false"><i class="fa fa-list"></i> Invites List</a></li>
                    </ul>
                  </div>
                </div>
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
                    <div role="tabpanel" class="tab-pane fade" id="prospects">
                      <div>                    
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#p_leads" data-toggle="tab" role="tab" arai-expanded="false"><i class="fa fa-users"></i> Leads</a></li>
                          <li><a href="#p_accounts" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-building"></i> Accounts</a></li>
                          <li><a href="#p_contacts" data-toggle="tab" role="tab" arai-expanded="false"><i class="fa fa-money"></i> Contacts</a></li>
                        </ul>
                      </div>
                      <div class="tab-content" id="ProspectsList">
                        <div role="tabpanel" class="tab-pane fade active in" id="p_leads">
                          <div class="well" id="p_leadContainer">

                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="p_accounts">
                          <div class="well" id="p_accountContainer">
                            <table class="table table-striped">
                              <tr>
                                <th>Account Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Billing Address</th>
                                <th>Billing City</th>
                                <th>Market Segment</th>
                                <th>Subsegment</th>
                                <th>Status</th>
                              </tr>
                            </table>
                          </div></div>
                        <div role="tabpanel" class="tab-pane fade" id="p_contacts">
                          <div class="well" id="p_contactContainer">
                            <table class="table table-striped">
                              <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Market Segment</th>
                                <th>Subsegment</th>
                                <th>Address</th>
                                <th>Status</th>
                              </tr>
                            </table>
                          </div></div>
                      </div>
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
                            <div class="leads forlocation">
                              <select data-placeholder="Select location" multiple class="chosen-select form-control" tabindex="18" id="location" name="location[]">
                                <?php foreach($location['leads']->result() as $row){ ?>
                                  <option class="text-left"><?php echo $row->city ?></option>
                               <?php } ?>
                              </select>
                            </div>
                            <div class="accounts forlocation" style="display:none"> 
                              <select data-placeholder="Select account location" multiple class="chosen-select form-control" tabindex="18">
                               <?php foreach($location['accounts']->result() as $row){ ?>
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
                      <div class="well" id="results" style="overflow: hidden; background: white">
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
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js ?>" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js ?>" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/dist/js/invites.js" type="text/javascript"></script>
    <!-- Jasny Plugin -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/chosen/chosen.js') ?>"></script>

<!--  SECTION FOR FEEDBACKS 
    <div class="feedback-form nav navbar-fixed-bottom text-right">
        <a href="#" class="btn" id="minimize"><i class="fa fa-arrow-left"></i></a>
        <a href="#" class="btn" id="maximize"><i class="fa fa-arrow-right"></i></a>
        <div class="input-group">
            <textarea type="text" id="feedback" placeholder="Please let me know what's on your mind. Type your feedback here." class="form-control" rows="3"></textarea>
            <a href="#" id="f_submit" class="btn input-group-addon"><i class="fa fa-check"></i></a>
        </div>        
    </div> -->

    <script type="text/javascript">
 /*           //for feedback
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
            });*/

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

        /*
          Get number of selected leads number and leadid's
          Positioned here so it will not repeat on ajax call
        */
        var selectedInvites = 0;
        var selectedInvites_id = []; 

      $(document).ready(function(){

        $(".chosen-select").chosen();

        var module = $("#module").val();
        var fieldname = [];
        var condition = [];
        var value = [];
        var andor = [];
        var industry = $("#industry").val();
        var location = $("#location").val();

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("myChart").getContext("2d");

        var data = {
            labels: ["Budget", "Response Count", "Sales Count", "ROI"],
            datasets: [
                {
                    label: "Expected",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo implode(',', $targets) ?>]
                },
                {
                    label: "Actuals",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [<?php echo implode(',', $actuals) ?>]
                }
            ]
        };

        new Chart(ctx).Line(data, {
          bezierCurve: false
        });

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
            $('#leads-table').dataTable({
              "bPaginate": true,
              "bLengthChange": true,
              "bFilter": true,
              "bSort": true,
              "bInfo": true,
              "bAutoWidth": true
            });

          },"html");

          fieldname = [];
          condition = [];
          value = [];
          andor = [];
          selectedInvites = 0;
          selectedInvites_id = []; 
        });

        $(document).on('click','.remove',function(){
          var toDelete = $(this).parent();

          toDelete.remove();
        });
        /* 
          Event handler for changing the module dropdown select
        */
        $(document).on('change','#module',function(){
          module = $("#module").val();
          $("#conditionContainer div").remove();
          $("#conditionContainer br").remove();
          $(".forlocation").hide();
          $(".forlocation>select").attr("id","");
          $(".forlocation>select").attr("name","");
        /* TODO limit numbers of filters*/

          switch(module){
            case "leads":
              $(".leads").show(); 
              $(".leads>select").attr("id","location");
              $(".leads>select").attr("name","location[]");break;
            case "accounts":
              $(".accounts").show();
              $(".accounts select").attr("id","location");
              $(".accounts select").attr("name","location[]"); break;
            /* BUG: cannot use contacts array because of line breaks*/
            case "contacts":
              $(".accounts").show();
              $(".accounts select").attr("id","location");
              $(".accounts select").attr("name","location[]"); break;
          };
          $(".chosen-container").css("width","100%");

        });

      });

        /*
          Call all leads on document ready.
        */
        $("#results").html("<div class='col-md-12 text-center'><img src='<?php echo base_url() ?>assets/dist/img/loading.gif'><div>");
        $.post("<?php echo base_url() ?>campaign/get_leads",function(data){
          $("#results").html(data);
        },"html"); 

        /*
          Event handler for selecting an item from leads table
        */  
        $(document).on("change",".invites-select",function(){
          if(this.checked){
            selectedInvites++;
            selectedInvites_id.push($(this).attr("role"));
          }else{
            selectedInvites--;
            selectedInvites_id.splice( $.inArray($(this).attr("role"), selectedInvites_id), 1 );
          }
          $("#selected-invites").text(selectedInvites);
          console.log(selectedInvites_id);
        });
        
        $(document).on("click","#clearlist",function(){
          $(".invites-select").prop("checked", false);
          selectedInvites = 0;
          selectedInvites_id = []; 
          $("#selected-invites").text(selectedInvites);
        })

        /*
          Save list of selected invites
        */
        $(document).on("click","#savelist",function(){
          var campaignid = "<?php echo $this->session->userdata('campaignid') ?>";
          var modulename = $("#module").val();
          $.post("<?php echo base_url('campaign/save_prospects')?>",{campaignid:campaignid, crmid:selectedInvites_id, modulename:modulename},function(data){
            alert("List saved successfully!");
          });

          /*
            Run on each selected invite id then delete its entire row
          */
          $.each(selectedInvites_id, function( index, value){
            $("[role='" + value + "']").parent().parent().remove();
          });
          selectedInvites = 0;
          selectedInvites_id = []; 
          $("#selected-invites").text(selectedInvites);
        });

        $("a[href=#p_leads]").on("click",function(){
          alert("It's working");
        })
    </script>
  </body>
</html>