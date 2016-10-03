<!--load head codes -->
<?php $this->load->view('layout/header.php') ?>

      <!-- Content Wrapper. Contains page content -->
<?php 

/* Array Assignments for Chart call later */
 foreach($by_rating->result() as $row){ 
    $rating[] = '"' . $row->rating . '"';
    $ratingvalues[] = $row->count;
  }

 foreach($opportunities_by_stage as $row){
    $stage[] = '"' . $row->sales_stage . '"';
    $amount[] = $row->amount;
 }
?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>See it all</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-3">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $likes; ?></h3>
                  <p>Likes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-o-up"></i>
                </div>
                <a href="#" class="small-box-footer">Other Pages <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-xs-3">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $tweets; ?></h3>
                  <p>Tweets</p>
                </div>
                <div class="icon">
                  <i class="fa fa-twitter-square"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-xs-3">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>63</h3>
                  <p>Followers</p>
                </div>
                <div class="icon">
                  <i class="fa fa-linkedin-square"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-xs-3">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $subs ?></h3>
                  <p>Subscribers</p>
                </div>
                <div class="icon">
                  <i class="fa fa-youtube"></i>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <div class="row">
            <div class='col-md-4'>

              <!-- Chart for Lead Status -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Overall Leads Status</h3>
                  <div id="chart-setting" width="100%" class="text-center" hidden>
                    <label>Inactive for: </label>
                    <select id="inactive-param">
                      <option value="1W">a week</option>
                      <option value="2W" selected>two weeks</option>
                      <option value="M">a month</option>
                      <option value="Y">a year</option>
                    </select>
                  </div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" id="show-setting"><i class="fa fa-gear"></i></button>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="chart-responsive" id="chart-overall-leads">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Top Users -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Weekly Top Users by Activity</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-muted">
                  <?php 
                    $rank = 1;
                    if(empty($top_active)){
                      echo "No activities so far.";
                    }else{ ?>
                  <ul class="clearfix" style="list-style: none">
                    <?php foreach($top_active as $row){ ?>
                      <li><?php echo "- <strong>" . $row->name . "</strong> - " . $row->activity . " points"  ?></li>
                    <?php $rank++; } } ?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Upcoming Events -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Upcoming Events</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-muted">
                  <ul>
                    <?php foreach($upcoming_events as $event){ ?>
                    <li><a href="#"><?php echo $event->campaignname ?></a> - <em><?php echo $event->cf_669 ?></em></li>
                    <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- New Leads this Week -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">New Leads This Week</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body text-muted">
                  <ul>
                    <?php foreach($leads_this_week as $row){ ?>

                    <li><?php echo $row->company ?> - <em><?php echo $row->name ?></em></li>

                    <?php } ?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-8">

              <!-- Graphical Representation -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Campaign Trails</h3>                    
                  <ul class="nav nav-tabs pull-right">
                      <li class="active"><a href="#leads" data-toggle="tab" role="tab" arai-expanded="false"><i class="fa fa-users"></i> Leads</a></li>
                      <li><a href="#accounts" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-building"></i> Accounts & Contacts</a></li>
                  </ul>
                </div><!-- /. box-header -->
                <div class="box-body">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="leads">
                      <div class="row text-muted">
                        <div class="col-sm-3 text-center">
                          <h1 class="text-yellow"><i class="fa fa-users"><br><small>Leads</small></i><br> <?php echo $campaign_leads; ?></h1>
                        </div>
                        <div class="col-sm-4">
                          <br>
                          <strong>Ownership</strong>
                          <table class="table table-striped">
                            <tr>
                              <td><a href="#" data-toggle="modal" data-target="#moreDetails" id="l_unassigned">Unassigned</a></td>
                              <td><strong><?php echo $unassigned ?></strong></td>
                            </tr>
                            <tr>
                              <td><a href="#" data-toggle="modal" data-target="#moreDetails" id="l_assigned">Assigned</a></td>
                              <td><strong><?php echo $assigned ?></strong></td>
                            </tr>
                          </table>                        
                        </div>
                        <div class="col-sm-5">
                          <br>
                          <strong>Lead Status</strong>
                          <table class="table table-striped">
                            <tr>
                              <td><a href="#" data-toggle="modal" data-target="#moreDetails" id="l_hot">Active for two weeks</a></td>
                              <td><strong><?php echo $c_active ?></strong></td>
                            </tr>
                            <tr>
                              <td><a href="#" data-toggle="modal" data-target="#moreDetails" id="l_cold">Inactive for two weeks now</a></td>
                              <td><strong><?php echo $c_inactive ?></strong></td>
                            </tr>
                            <tr>
                              <td><a href="#" data-toggle="modal" data-target="#moreDetails" id="l_never">Never Updated</a</td>
                              <td><strong><?php echo $c_never_updated ?></strong></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="well" style="background-color:white">
                          <div id="leads-rating" style="height: 100%; width: 100%"></div>
                      </div>
                      <div clas="well" style="background-color:white">
                          <div id="leads-industry" style="height: 100%; width: 100%"></div>
                      </div>
                    </div><!-- /. Leads tab pane -->
                    <div role="tabpanel" class="tab-pane fade" id="accounts">
                      <div class="row text-muted">
                        <div class="col-sm-6">
                          <div class="col-md-6 well text-center text-green">
                            <h1 class="text-green"><i class="fa fa-building"> <small>Accounts</small></i><br> <?php echo $campaign_accounts; ?></h1>
                          </div>
                          <div class="col-md-6">
                            <ul class="chart-legend clearfix">
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="a_this_year">New this year</a> - <strong><?php echo $new_this_year ?></strong></li> 
                            </ul><br>
                            <strong>Status</strong>
                            <ul class="chart-legend clearfix">
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="a_warm">Warm</a> - <?php echo $warm_accounts ?></strong></li>
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="a_cold">Cold</a> - <?php echo $cold_accounts ?></strong></li>
                            </ul>
                            <br>
                            <strong>Ownership</strong>
                            <ul class="chart-legend clearfix">
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="a_unassigned">Unassigned</a> - <?php echo $unassigned_accounts ?></strong></li>
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="a_assigned">Assigned</a> - <?php echo $assigned_accounts ?></strong></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="col-md-6 well text-center text-green">
                            <h1 class="text-green"><i class="fa fa-phone"><small><br>Contacts</small></i><br> <?php echo $campaign_contacts; ?></h1>
                          </div>
                          <div class="col-md-6">
                            <ul class="chart-legend clearfix">
                              <li><i class="fa fa-circle-o"></i> <a href="#" data-toggle="modal" data-target="#moreDetails" id="c_this_year">New this year</a> - <strong><?php echo $contact_this_year ?></strong></li> 
                            </ul><br>
                          </div>
                        </div>
                      </div>
                    </div><!-- /. Accounts tab pane -->
                  </div>
                </div><!-- /. box-body -->
              </div><!-- /. box -->

              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> Campaign Generated Opportunities </h3>
                </div><!-- /. box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-4 text-green text-center">
                            <h1 class="text-green"><i class="fa fa-money"><small><br>Opportunities</small></i><br> <?php echo $campaign_opportunities; ?></h1>
                    </div>
                    <div class="col-sm-8">
                          <table class="table table-bordered table-striped">
                            <tr>
                              <th>Label</th>
                              <th>Count</th>
                              <th>Amount</th>
                            </tr>
                            <?php 

                            foreach($opportunities_by_stage as $row){ ?>
                              <tr>
                                <td><?php echo $row->sales_stage; ?></td>
                                <td><?php echo $row->count; ?></td>
                                <td class="text-right"><?php echo number_format($row->amount, 2, '.' , ','); ?></td>
                              </tr>
                              <?php } ?>
                          </table>                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div id="opportunities-stage" style="height: 100%; width: 100%"></div>
                    </div>
                    <div class="col-md-6">
                      <div id="opportunities-amount" style="height: 100%; width: 100%"></div>
                    </div>
                  </div>
                </div><!-- /. box-body -->
              </div><!-- /. box -->
            </div><!-- /.col-md-8 -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- Modal for more details -->
<div class="modal fade" id="moreDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">List View</h4>
      </div>
      <div class="modal-body text-center" id="detailsContainer">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- load footer code -->

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

    <script src="<?php echo base_url(); ?>assets/dist/js/dashboard.js" type="text/javascript"></script>
    <!-- Jasny Plugin -->
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jasny/jasny-bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/shieldui/js/shieldui-all.min.js') ?>"></script>

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
              var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
              $("#feedbackContainer").html(loading);
              $.post("<?php echo base_url('dashboard/get_feedbacks') ?>",function(data){
                $("#feedbackContainer").html(data);
              },"html");
            })

            $(document).on('click','#minimize',function(){
                $(".feedback-form").animate({width: '230px'},"slow");
            });

            $(document).on('click','#maximize',function(){
                $(".feedback-form").animate({width: '100%'}, "slow");
            });

    </script>
    <script type="text/javascript">
      var getLeads = function(){
            var duration = $("#inactive-param").val();
            $.post("<?php echo base_url() ?>dashboard/load_ajax_chart",{duration: duration}, function(data){
              $("#chart-overall-leads").html(data);
            },"html")
          };

      $("#inactive-param").change(getLeads);

      $(document).ready(getLeads);

      $("#l_unassigned").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_unassigned_leads",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#l_assigned").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_assigned_leads",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#l_hot").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_hot_leads",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#l_cold").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_cold_leads",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#l_never").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_never_updated_leads",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#a_this_year").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_this_year_accounts",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#a_warm").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_warm_accounts",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#a_cold").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_cold_accounts",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#a_unassigned").click(function(){
        var loading = "<img src='<?php echo base_url(); ?>assets/dist/img/loading.gif' >"
        $("#detailsContainer").html(loading);
        $.post("<?php echo base_url() ?>dashboard/load_unassigned_accounts",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

      $("#a_assigned").click(function(){
        $.post("<?php echo base_url() ?>dashboard/load_assigned_accounts",function(data){
          $("#detailsContainer").html(data);
        },"html")
      });

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

      $("#leads-industry").shieldChart({
                theme: "light",
                seriesSettings: {
                    donut: {
                        activeSettings: {
                            pointSelectedState: {
                                enabled: true
                            }
                        },
                        enablePointSelection: true,
                        slicedOffset: 20,
                        addToLegend: true,
                        dataPointText: {
                            enabled: true,
                            borderRadius: 4,
                            borderWidth: 2,
                        }
                    }
                },                
                tooltipSettings: {
                    customPointText: "{point.collectionAlias}: {point.y}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                primaryHeader: {
                    text: "Leads by Industry"
                },
                dataSeries: [{
                    seriesType: "donut",
                    collectionAlias: "Industry",
                    data: [
                    <?php foreach($by_industry->result() as $row){ ?>
                            ["<?php echo $row->cf_758 ?>", <?php echo $row->count ?>],
                    <?php } ?>
                    ]
                }]
            });

            $("#leads-rating").shieldChart({
                theme: "light",
                primaryHeader: {
                    text: "Leads by Rating"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: [<?php echo implode(',',$rating) ?>]
                },
                dataSeries: [{
                    seriesType: "bar",
                    collectionAlias: "Rating",
                    data: [<?php echo implode(',',$ratingvalues) ?>]
                }]
            });

            $("#opportunities-stage").shieldChart({
                theme: "light",
                seriesSettings: {
                    pie: {
                        activeSettings: {
                            pointSelectedState: {
                                enabled: true
                            }
                        },
                        enablePointSelection: true,
                        slicedOffset: 20,
                        addToLegend: true,
                        dataPointText: {
                            enabled: true,
                            borderRadius: 4,
                            borderWidth: 2,
                        }
                    }
                },                
                tooltipSettings: {
                    customPointText: "{point.collectionAlias}: {point.y}"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                primaryHeader: {
                    text: "Opportunites bt Sales Stage"
                },
                dataSeries: [{
                    seriesType: "pie",
                    collectionAlias: "Sales Stage",
                    data: [
                    <?php foreach($opportunities_by_stage as $row){ ?>
                            ["<?php echo $row->sales_stage ?>", <?php echo $row->count ?>],
                    <?php } ?>
                    ]
                }]
            });

            $("#opportunities-amount").shieldChart({
                theme: "light",
                primaryHeader: {
                    text: "Opportunities by Amount"
                },
                exportOptions: {
                    image: false,
                    print: false
                },
                axisX: {
                    categoricalValues: [<?php echo implode(',',$stage) ?>]
                },
                dataSeries: [{
                    seriesType: "line",
                    collectionAlias: "Rating",
                    data: [<?php echo implode(',',$amount) ?>]
                }]
            });

/* TODO Replace Demo Version String with blank*/
$('tspan').each(function(){
    var demoString = $(this).html();
    if(demoString == "Demo Version" || demoString == "Demo"){
     $(this).html(""); 
    }
    
});
    </script>
  </body>
</html>