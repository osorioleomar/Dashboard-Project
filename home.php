<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>VTiger Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/assets/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/shieldui/css/shieldui-all.min.css'); ?>" />

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">


  </head>

  <body  style="background-color:white">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dashboard <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_leads'); ?>">Leads</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_accounts'); ?>">Accounts</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_contacts'); ?>">Contacts</a>
                </li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_opportunities'); ?>">Opportunities</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_calendar'); ?>">Calendar</a></li>
              </ul>

              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">New Chart <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_leads'); ?>">Leads</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_accounts'); ?>">Accounts</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_contacts'); ?>">Contacts</a>
                </li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_opportunities'); ?>">Opportunities</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_calendar'); ?>">Calendar</a></li>
              </ul>

            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br><br>
    <div class="well">
      <div class="container">
          <!--Start Dashboard-->
          <br>
            <div class="row">
                <div class="col-md-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-phone-square fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $leads; ?></div>
                                    <div>Leads</div>
                                </div>
                            </div>
                        </div>
                        <div id="leadsdetail" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-md-6">
                                        <p>Active</p>
                                        <p>Cold</p>
                                        <p>Junk</p>
                                </div>
                                <div class="col-md-6">
                                        <p><i class="fa fa-user"></i><?php echo $Active; ?></p>
                                        <p><i class="fa fa-user"></i><?php echo $Cold; ?></p>
                                        <p><i class="fa fa-user"></i><?php echo $Junk; ?></p>
                                </div>
                            </div>
                        </div>
                        <a data-toggle="collapse" href="#leadsdetail">
                            <div class="panel-footer text-center leaddown">
                                <i class="fa fa-angle-down"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-credit-card fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $contacts; ?></div>
                                    <div>Contacts</div>
                                </div>
                            </div>
                        </div>
                        <div id="contactsdetail" class="panel-collapse collapse">
                            <div class="panel-body">
                               <div class="col-md-6">
                                        <p>Individual</p>
                                        <p>Company</p>
                                </div>
                                <div class="col-md-6">
                                        <p><i class="fa fa-user"></i><?php echo $Individual; ?></p>
                                        <p><i class="fa fa-group"></i><?php echo $Company; ?></p>
                                </div>
                            </div>
                        </div>
                        <a data-toggle="collapse" href="#contactsdetail">
                            <div class="panel-footer text-center contactdown">
                                <i class="fa fa-angle-down"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-building-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $accounts; ?></div>
                                    <div>Accounts</div>
                                </div>
                            </div>
                        </div>
                        <div id="accountsdetail" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-md-6">
                                        <!--Accounts details here-->
                                </div>
                            </div>
                        </div>
                        <a data-toggle="collapse" href="#accountsdetail">
                            <div class="panel-footer text-center accountdown">
                                <i class="fa fa-angle-down"></i>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $opportunities; ?></div>
                                    <div>Opportunites</div>
                                </div>
                            </div>
                        </div>
                        <div id="opportunitiesdetail" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-md-6">
                                        <p>Open</p>
                                        <p>Closed</p>
                                </div>
                                <div class="col-md-6">
                                        <p><i class="fa fa-folder-open"></i><?php echo $open ;?></p>
                                        <p><i class="fa fa-folder"></i><?php echo $closed; ?></p>
                                </div>
                            </div>
                        </div>
                        <a data-toggle="collapse" href="#opportunitiesdetail">
                            <div class="panel-footer text-center opportunitydown">
                                <span><i class="fa fa-angle-down"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!--/ Dashboard-->
      </div>
    </div>

    <div class="container"  style="background-color:white">
      
      <div class="row">



<?php foreach($result as $row){ ?>

                <div class="col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $row->chart_title; ?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('index.php/dashboard/delete_chart') . '/' . $row->chartid ; ?>" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-times fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="<?php echo 'chart-' . $row->chartid; ?>" style="width:100%; height:100%; "></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
<?php } ?>
      </div>

    </div> <!-- /container -->


    <!-- jQuery -->
    <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/assets/js/custom.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
  
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('/assets/dist/js/sb-admin-2.js'); ?>"></script>

    <!--ShieldUI-->
    <script src="<?php echo base_url('/assets/shieldui/js/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/shieldui/js/shieldui-all.min.js'); ?>" type="text/javascript"></script>

    <script type="text/javascript">
                            $(document).ready(function(){

                                <?php foreach($result as $row){ ?>
                                    $("<?php echo '#chart-' . $row->chartid; ?>").shieldChart({
                                            zoomMode: 'xy',
                                            axisX: {
                                                categoricalValues: [
                                               <?php echo $row->chart_category; ?>
                                                ]
                                            },
                                            primaryHeader: {
                                                    text: "  "
                                                },
                                            dataSeries: [
                                                <?php echo $row->chart_series; ?>
                                            ]
                                        });
                                <?php } ?>
                            })
                                
                        </script>


</body>
</html>
