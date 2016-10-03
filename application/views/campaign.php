<!--load head codes -->
<?php $this->load->view('layout/header.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Campaigns
            <small>Where leads are gathered</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success"><!-- box -->
                <div clas="box-header">
                </div>
                <div class="box-body text-center">
                  <h3 class="box-title" style="float:left">Upcoming Campaigns</h3>
                    <?php if($campaigns['upcoming']->num_rows() == 0){ ?>
                      <h3 class="text-muted">No upcoming Campaigns. Boooooriiiiiiiing... <i class="fa fa-frown-o text-muted"></i></h3> 
                    <?php }else{ ?>
                    <table class="table table-bordered table-striped text-green">
                      <tr>
                        <th class="text-center">Campaign Name</th>
                        <th class="text-center">Assigned To</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">Expected End Date</th>
                        <th class="text-center">Campaign Type</th>
                        <th class="text-center">Status</th>
                      </tr>
                    <?php foreach($campaigns['upcoming']->result() as $campaign){ ?>
                      <tr>
                        <td class="text-left"><a href="<?php echo base_url(); ?>campaign/campaign_detail/<?php echo $campaign->campaignid ?>" class="<?php echo $campaign->campaignid ?>"><?php echo $campaign->campaignname ?></a></td>
                        <td class="text-left"><?php echo $campaign->assigned_to ?></td>
                        <td><?php echo $campaign->startdate ?></td>
                        <td><?php echo $campaign->closingdate ?></td>
                        <td><?php echo $campaign->campaigntype ?></td>
                        <td><?php echo $campaign->campaignstatus ?></td>
                      </tr> 
                    <?php } }?>
                  </table>
                  <hr>
                  <h3 class="box-title" style="float:left">Behind Schedule</h3>
                    <?php if($campaigns['overdue']->num_rows() == 0){ ?>
                      <h3 class="text-muted">Everything is on Schedule. Good job! <i class="fa fa-smile-o text-yellow"></i></h3> 
                    <?php }else{ ?>
                    <table class="table table-bordered table-striped text-red">
                      <tr>
                        <th class="text-center">Campaign Name</th>
                        <th class="text-center">Assigned To</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">Expected End Date</th>
                        <th class="text-center">Campaign Type</th>
                        <th class="text-center">Status</th>
                      </tr>
                    <?php foreach($campaigns['overdue']->result() as $campaign){ ?>
                      <tr>
                        <td class="text-left"><a href="<?php echo base_url(); ?>campaign/campaign_detail/<?php echo $campaign->campaignid ?>" class="<?php echo $campaign->campaignid ?>"><?php echo $campaign->campaignname ?></a></td>
                        <td class="text-left"><?php echo $campaign->assigned_to ?></td>
                        <td><?php echo $campaign->startdate ?></td>
                        <td><?php echo $campaign->closingdate ?></td>
                        <td><?php echo $campaign->campaigntype ?></td>
                        <td><?php echo $campaign->campaignstatus ?></td>
                      </tr> 
                    <?php } }?>
                  </table>
                  <hr>
                  <h3 class="box-title" style="float:left">Completed Campaigns</h3>
                    <?php if($campaigns['held']->num_rows() == 0){ ?>
                      <h3 class="text-muted">Now this is surprising. There's completed campaign found. <i class="fa fa-smile-o text-yellow"></i></h3> 
                    <?php }else{ ?>
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th class="text-center">Campaign Name</th>
                        <th class="text-center">Assigned To</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">End Date</th>
                        <th class="text-center">Campaign Type</th>
                        <th class="text-center">Status</th>
                      </tr>
                    <?php foreach($campaigns['held']->result() as $campaign){ ?>
                      <tr>
                        <td class="text-left"><a href="<?php echo base_url(); ?>campaign/campaign_detail/<?php echo $campaign->campaignid ?>"><?php echo $campaign->campaignname ?></a></td>
                        <td class="text-left"><?php echo $campaign->assigned_to ?></td>
                        <td><?php echo $campaign->startdate ?></td>
                        <td><?php echo $campaign->closingdate ?></td>
                        <td><?php echo $campaign->campaigntype ?></td>
                        <td><?php echo $campaign->campaignstatus ?></td>
                      </tr> 
                    <?php } }?>
                  </table>
                </div>
              </div><!-- /. box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- load footer code -->
<?php $this->load->view('layout/footer'); ?>