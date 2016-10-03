<?php if($this->session->userdata('logged_in')){
          
        }else{
          redirect(base_url('login'));
        } 
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Marketing CRM</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />    
    <!-- Morris chart -->
    <link href="<?php echo base_url(); ?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/feedback.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/shieldui/css/shieldui-all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/chosen/chosen.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      #success-alert , #nomatch-alert{
        display:none;
      }
    </style>
  </head>
  <body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <a href="<?php echo base_url(); ?>" class="logo"><b><span class="fa fa-home"> </span></b> HOME<sup>[beta]</sup></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-danger"><?php
                  if($this->session->userdata('user_type')=='Admin'){
                    $newfeedbacks = $new_feedbacks->num_rows();
                  }else{
                    $newfeedbacks = 0;
                  }

                  $newnotifs = $notifs['leads_today']->num_rows() + $notifs['outdated_month']->num_rows() + $notifs['never_updated']->num_rows + $newfeedbacks;
                  if ($newnotifs!=0){
                    echo $newnotifs;
                  }
                    ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $newnotifs ?> notification(s)</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php if($notifs['leads_today']->num_rows() != 0){ ?>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#notifModal" id="show_leads_today">
                          <i class="fa fa-users text-aqua"></i> <?php echo $notifs['leads_today']->num_rows() ?> new lead(s) added today
                        </a>
                      </li>
                      <?php } ?>
                      <?php if($notifs['outdated_month']->num_rows() != 0){ ?>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#notifModal" id="show_inactive_month">
                          <i class="fa fa-users text-aqua"></i> <?php echo $notifs['outdated_month']->num_rows(); ?> lead(s) inactive for a month now
                        </a>
                      </li>
                      <?php } ?>
                      <?php if($notifs['never_updated']->num_rows() != 0){ ?>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#notifModal" id="show_never_month">
                          <i class="fa fa-users text-aqua"></i> <?php echo $notifs['never_updated']->num_rows() ?> lead(s) untouched for a month now
                        </a>
                      </li>
                      <?php } ?>
                      <?php if($new_feedbacks->num_rows() != 0){ 
                        if($this->session->userdata('user_type')=='Admin'){
                        ?>
                      <li>
                        <a href="#" data-toggle="modal" data-target="#feedbackModal" id="get_feedback">
                          <i class="fa fa-exchange text-red"></i> <?php echo $new_feedbacks->num_rows(); ?> feedback(s) not seen yet
                        </a>
                      </li>
                      <?php } } ?>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url('assets/dist/img') . '/' . $this->session->userdata('photo'); ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $this->session->userdata('name') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url('assets/dist/img') . '/' . $this->session->userdata('photo'); ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $this->session->userdata('name') . ' - ' . $this->session->userdata('user_type') ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php if($this->session->userdata('user_type')=='Admin'){ ?>
                      <a href="<?php echo base_url('user/') ?>" class="btn btn-default btn-flat">Manage Users</a>
                      <?php } ?>
                      <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('assets/dist/img') . '/' . $this->session->userdata('photo'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('name') ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Activity Updates</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url() ?>updates"><i class="fa fa-circle-o"></i> Track logs <span class="label label-success pull-right"><?php echo $tracks_today ?></span>
              </a></a></li>
                <li><a href="<?php echo base_url() ?>comments"><i class="fa fa-circle-o"></i> Comments <span class="label label-danger pull-right"><?php echo $comments_today ?></span></a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url() ?>campaign"><i class="fa fa-calendar"></i><span>Campaigns</span></a></li>    
             <li class="treeview">
              <a href="<?php echo base_url() ?>invite">
                <i class="fa fa-search"></i>
                <span>Search for Invites</span>
              </a>
            </li>            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<!-- Update User Info Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update My Info</h4>
      </div>
      <div class="modal-body text-center">
                      <h3 id="success-alert" class="text-green">Update Successful!</h3>
                      <input id="u_name" type="text" placeholder="name" class="form-control" value="<?php echo $this->session->userdata('name') ?>"><br>
                      <input id="u_email" type="email" placeholder="email" class="form-control" value="<?php echo $this->session->userdata('email') ?>"><br>
                      <input id="u_password" type="password" placeholder="new password" class="form-control"><br>
                      <input id="u_cpassword" type="password" placeholder="confirm password" class="form-control"><br>
                      <h4 id="nomatch-alert" class="text-red">Passwords must match.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default btn-flat" id="update">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Feedbacks Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Feedbacks</h4>
      </div>
      <div class="modal-body text-left" id="feedbackContainer">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Notifications Modal -->
<div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Updates</h4>
      </div>
      <div class="modal-body text-left" id="notifContainer">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- ./ update user -->