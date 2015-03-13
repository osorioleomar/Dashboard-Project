<!DOCTYPE html>
<!-- saved from url=(0043)http://getbootstrap.com/examples/jumbotron/ -->
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

    <!--Chosen Plugin-->
    <link rel="stylesheet" href="<?php echo base_url('/assets/chosen/chosen.css'); ?>">

  </head>

  <body style="background-color:white">

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
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_contacts'); ?>">Contacts</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_opportunities'); ?>">Opportunities</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/dashboard_calendar'); ?>">Calendar</a></li>
              </ul>

              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">New Chart <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_leads'); ?>">Leads</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_accounts'); ?>">Accounts</a></li>
                <li><a href="<?php echo base_url('index.php/dashboard/new_chart_contacts'); ?>">Contacts</a></li>
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
        <div class="panel-body">
            <form name="contact" method="post" action="<?php echo $form_action; ?>" id="parameters">
                <div class="form-group">
                    <div class="col-md-6 btn-group">

                        <a class="btn btn-primary" href="#" required> Select Data Series</a>
                        <select class="btn" id="select-data1"  name="data1" placeholder="Select field" data-toggle="tooltip" title="Specify your main data series.">
                            <option value="" selected>No field selected...</option>
                            <?php foreach($fields['input'] as $field){ 
                                echo "<option value='". $field->columnname ."'>" . $field->fieldlabel . "</option>";
                                $posttext[$field->columnname] = $field->fieldlabel;
                                }; ?>
                        </select>
                    </div>
                    <div class="col-md-6 btn-group">

                        <a class="btn btn-primary" href="#"> [Optional] Select Data Label</a>
                        <select class="btn" id="select-data2" name="data2">
                            <option value="">No field selected...</option>
                            <?php foreach($fields['input'] as $field){ 
                                echo "<option value='". $field->columnname ."'>" . $field->fieldlabel . "</option>";
                                $posttext1[$field->columnname] = $field->fieldlabel;
                                }; ?>
                        </select>
                    </div>

                        <div class="col-md-12 btn-group">
                        <br>
                            <a href="#" class="btn btn-success "><i class="fa fa-plus-circle fa-fw"></i>Add Condition</a>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                           </button>
                           <ul class="dropdown-menu" role="menu">
                              <li><a href="#" class="add_input_button">For Text Fields</a></li>
                              <li><a href="#" class="add_date_button">For Date Fields</a></li>
                              <li><a href="#" class="add_amount_button">For Numeric Fields</a></li>
                           </ul>
                        </div>
                        <div class="input_fields_wrap col-md-12"></div>
                        
                </div>
                <!--Generate Button-->
                <div class="col-md-12 text-center">
                <br>
                    <button type="sumbit" class="btn btn-primary">Generate Now</button>
                </div>
                                <!--/Generate Button-->
            </form>
        </div>

    </div>

        <div class="container">
      
              <div class="row">

                <!--bar graph starts here-->
                <div class="col-md-6">
                    <div class="panel-group" id="barchart">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i>Bar Chart
                                <div class="pull-right">
                                    <div class="btn-group">
                                            <button class="btn btn-xs btn-outline btn-success" id="save-bar" data-toggle="tooltip" title="Save this bar chart." data-placement="top"><i class="fa fa-clipboard fa-fw"></i></button>
                                            <a data-toggle="collapse" data-parent="#barchart" href="#barchartbody" class="btn btn-outline btn-xs btn-danger" data-toggle="tooltip" title="Hide this chart."><i class="fa fa-eye-slash fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="barchartbody" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="bar-chart" style="width:100%; height:100%; "></div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    <!-- /.panel -->
                    </div>
                </div>
                <!--/bar chart-->

                <!--Line Graph starts here-->
                <div class="col-md-6">
                    <div class="panel-group" id="linegraph">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i>Line Graph
                                <div class="pull-right">
                                    <div class="btn-group">
                                            <button class="btn btn-xs btn-outline btn-success" id="save-line" data-toggle="tooltip" title="Save this line chart."><i class="fa fa-clipboard fa-fw"></i></button>
                                            <a data-toggle="collapse" data-parent="#linegraph" href="#linegraphbody" class="btn btn-outline btn-xs btn-danger" data-toggle="tooltip" title="Hide this chart."><i class="fa fa-eye-slash fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="linegraphbody" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="line-graph" style="width:100%; height:100%; "></div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    <!-- /.panel -->
                    </div>
                </div>
                <!--/line graph-->

                <!--Polar graph starts here-->
                <div class="col-md-6">
                    <div class="panel-group" id="splinechart">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <i class="fa fa-bar-chart-o fa-fw"></i>SpLine Chart
                                <div class="pull-right">
                                    <div class="btn-group">
                                            <button class="btn btn-xs btn-outline btn-success" id="save-polar" data-toggle="tooltip" title="Save this polararea chart."><i class="fa fa-clipboard fa-fw"></i></button>
                                            <a data-toggle="collapse" data-parent="#splinechart" href="#splinechartbody" class="btn btn-outline btn-xs btn-danger" data-toggle="tooltip" title="Hide this chart."><i class="fa fa-eye-slash fa-fw"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="splinechartbody" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="polararea-chart" style="width:100%; height:100%; "></div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    <!-- /.panel -->
                    </div>
                </div>
                <!--/Polar graph-->

                    <!--donut chart starts here-->
                    <div class="col-md-6" id="donutdiv">
                        <div class="panel-group" id="piechart">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i>Donut Chart
                                    <div class="pull-right">
                                        <div class="btn-group">
                                                <button class="btn btn-xs btn-outline btn-success" id="save-donut" data-toggle="tooltip" title="Save this donut chart."><i class="fa fa-clipboard fa-fw"></i></button>
                                                <a data-toggle="collapse" data-parent="#piechart" href="#piechartbody" class="btn btn-outline btn-xs btn-danger" data-toggle="tooltip" title="Hide this chart."><i class="fa fa-eye-slash fa-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="piechartbody" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id="donut-chart" style="width:100%; height:100%; "></div>
                                </div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                        <!-- /.panel -->
                        </div>
                    </div>
                <!--/donut chart-->

           </div>
    </div> <!-- /container -->

    <!-- jQuery -->
    <script src="<?php echo base_url('/assets/js/jquery.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('/assets/js/chart-details.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
  
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('/assets/dist/js/sb-admin-2.js'); ?>"></script>

    <!--ShieldUI-->
    <script src="<?php echo base_url('/assets/shieldui/js/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/shieldui/js/shieldui-all.min.js'); ?>" type="text/javascript"></script>


     <!-- Multiselect CSS and JS: -->
    <script type="text/javascript" src="<?php echo base_url('/assets/dist/js/bootstrap-multiselect.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('/assets/dist/css/bootstrap-multiselect.css'); ?>" type="text/css"/>

    <!--Chosen Scripts-->
  <script src="<?php echo base_url('/assets/chosen/chosen.jquery.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('/assets/chosen/docsupport/prism.js'); ?>" type="text/javascript" charset="utf-8"></script>


 <!--
 ///// This area
 ///// is for scripts.
 /////
 -->  
<?php  if(!empty($_POST['data2'])){
        ?> <script type="text/javascript">
                $("#donutdiv").remove();
            </script><?php
} ?>

<script type="text/javascript">


                            //settings for dynamic input fields
                            var max_fields      = 4; //maximum input boxes allowed
                            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                                                                                   
                            var x = 1; //initlal text box count
                            var nameid = 1;
                            $(document).on('click','.add_input_button',function(e){ //on add input button click
                                e.preventDefault();

                                console.log(x);
                                if(x < max_fields){ //max input box allowed
                                    x++; //text box increment
                                    nameid++;
                                    $(wrapper).append('\
                                        <div class="col-md-12">\
                                            <div class="col-md-4">\
                                                <br>\
                                                <select class="form-control" name="fieldname[]">\
                                                    <?php foreach($fields["input"] as $field){ echo "<option value=\'" . $field->columnname . "\'>" . $field->fieldlabel . "</option>"; }; ?>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-2">\
                                                <br>\
                                                <select class="form-control" name="condition[]">\
                                                    <option value="=">equal to</option>\
                                                    <option value="!=">no equal to</option>\
                                                    <option value="like">contains</option>\
                                                    <option value="not like">does not contain</option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <br>\
                                                <input class="form-control" placeholder="Enter a value" name="fieldvalue[]">\
                                            </div>\
                                            <br>\
                                            <select name="andor[]" class="hiddencondition btn"><option>and</option><option>or</option></select>\
                                            <a href="#" class="btn-outline remove_field btn btn-danger btn-lg fa fa-trash-o"/>\
                                        </div>'); //add input box
                                
                                }
                            });
                            $(document).on('click','.add_date_button',function(e){ //on add input button click
                                e.preventDefault();
                                if(x < max_fields){ //max input box allowed
                                    x++; //text box increment
                                    nameid++;
                                    $(wrapper).append('\
                                        <div class="col-md-12">\
                                            <div class="col-md-4">\
                                                <br>\
                                                <select class="form-control" name="fieldname[]">\
                                                    <?php foreach($fields["date"] as $field){ echo "<option value=\'" . $field->columnname . "\'>" . $field->fieldlabel . "</option>"; }; ?>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-2">\
                                                <br>\
                                                <select class="form-control" name="condition[]">\
                                                    <option value="=">equal to</option>\
                                                    <option value="!=">before</option>\
                                                    <option value="">after</option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <br>\
                                                <input type="date" class="form-control" placeholder="Select a date..." name="fieldvalue[]">\
                                            </div>\
                                            <br>\
                                            <select name="andor[]" class="hiddencondition btn"><option>and</option><option>or</option></select>\
                                            <a href="#" class="remove_field btn btn-danger btn-lg fa fa-trash-o"/>\
                                        </div>'); //add input box
                                
                                }
                            });
                            $(document).on('click','.add_amount_button',function(e){ //on add input button click
                                e.preventDefault();
                                if(x < max_fields){ //max input box allowed
                                    x++; //text box increment
                                    nameid++;
                                    $(wrapper).append('\
                                        <div class="col-md-12">\
                                            <div class="col-md-4">\
                                                <br>\
                                                <select class="form-control" name="fieldname[]">\
                                                    <?php foreach($fields["amount"] as $field){ echo "<option value=\'" . $field->columnname . "\'>" . $field->fieldlabel . "</option>"; }; ?>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-2">\
                                                <br>\
                                                <select class="form-control" name="condition[]">\
                                                    <option value="=">equal to</option>\
                                                    <option value="!=">greater than</option>\
                                                    <option value="">less than</option>\
                                                    <option value="">greater than or equal</option>\
                                                    <option value="">less than or equal</option>\
                                                </select>\
                                            </div>\
                                            <div class="col-md-4">\
                                                <br>\
                                                <input type="number" min="1000" class="form-control" placeholder="Enter a amount..." name="fieldvalue[]">\
                                            </div>\
                                            <br>\
                                            <select name="andor[]" class="hiddencondition btn"><option>and</option><option>or</option></select>\
                                            <a href="#" class="remove_field btn btn-danger btn-lg fa fa-trash-o"/>\
                                        </div>'); //add input box
                                
                                }
                            });
                                                                                   
                                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                                    e.preventDefault(); $(this).parent('div').remove(); x--;
                                });


</script>

                        <script type="text/javascript">
                            $(document).ready(function(){

                            /////////////////////////////////////////////////////////////////////////   

                            //Chart details
                            <?php 
                                $sessionmodule = $this->session->userdata('module');

                                if($sessionmodule=='vtiger_leaddetails'){
                                    $module='leads';
                                }elseif ($sessionmodule=='vtiger_account') {
                                    $module='accounts';
                                }elseif ($sessionmodule=='vtiger_contactdetails') {
                                    $module='contacts';
                                }elseif ($sessionmodule=='vtiger_potential') {
                                    $module='opportunities';
                                }elseif ($sessionmodule=='vtiger_activity') {
                                    $module='calendar';
                                }
                            ?>
                                $("#bar-chart").shieldChart({
                                            zoomMode: 'xy',
                                            theme: "light",
                                            axisX: {
                                                categoricalValues: [
                                               <?php
                                               if(empty($_POST['data2'])){
                                                    foreach($series as $dataseries){
                                                        if($dataseries->$_POST['data1']==''){
                                                            $barcategory[] = '"Not Specified"';
                                                        }else{
                                                            $barcategory[] = '"' . $dataseries->$_POST['data1'] . '"';
                                                        }
                                                    } 
                                                }else{
                                                    foreach($series[1] as $row){
                                                        if($row->$_POST['data2']==''){
                                                            $barcategory[] = '"Not Specified"';
                                                        }else{
                                                        $barcategory[] = '"' . $row->$_POST['data2'] . '"';
                                                        }
                                                    } 
                                                }
                                                    echo implode(',', $barcategory);
                                                    $bar['categories'] = implode(',', $barcategory)

                                                ?>
                                                ]
                                            },
                                            primaryHeader: {
                                                            <?php 
                                                                if(empty($_POST['data2'])){ 
                                                                    $bar['title'] = $this->session->userdata('mypage') . ' by ' . $posttext[$_POST['data1']] ;
                                                                }else{
                                                                    $bar['title'] = $posttext[$_POST['data1']] . ' by ' . $posttext1[$_POST['data2']] ;
                                                                }
                                                                echo 'text: "' . $bar['title'] . '"';
                                                            ?>
                                                         },
                                                        dataSeries: [
                         
                                    <?php 
                                            if(empty($_POST['data2'])){
                                                $output[] = '{ seriesType: "bar", collectionAlias: "' . $posttext[$_POST['data1']] . '",';
                                                $output[] = "data: [";
                                                foreach($series as $dataseries){
                                                    $outputseries[] = $dataseries->count_number;
                                                }
                                                $output[] = implode(',', $outputseries);
                                                $output[] = "]},"; 
                                            }else{
                                                $i=0;
                                                foreach($labels as $label){
                                                    if($label->$_POST['data1']==''){
                                                        $output[] = '{ seriesType: "bar", collectionAlias: "Not Specified",';
                                                    }else{
                                                        $output[] = '{ seriesType: "bar", collectionAlias: "' . $label->$_POST['data1'] . '",';
                                                    }
                                                    
                                                    $output[] = "data: [";
                                                    foreach($series[$i] as $dataseries){
                                                        $output[]= $dataseries->count_number . ",";
                                                    }
                                                    //$output[] = implode(',', $outputseries);
                                                    $output[] = "]},";
                                                    $i++;
                                                }
                                            }

                                        echo implode($output); 
                                        $bar['series']=implode($output);
                                        $bar['type']='bar';
                                        $bar['module']=$module;  
                                        $this->session->set_userdata('bar', $bar);
                                    ?>

                                                        ]
                                });

                            //donut chart
                                $("#donut-chart").shieldChart({
                                            theme: "light",
                                            axisX: {
                                                categoricalValues: [
                                               <?php
                                               if(empty($_POST['data2'])){
                                                    foreach($series as $dataseries){
                                                        if($dataseries->$_POST['data1']==''){
                                                            $donutcategory[] = '"Not Specified"';
                                                        }else{
                                                        $donutcategory[] = '"' . $dataseries->$_POST['data1'] . '"';
                                                        }
                                                    } 
                                                }else{
                                                    foreach($series[1] as $row){
                                                        if($row->$_POST['data2']==''){
                                                            $donutcategory[] = '"Not Specified"';
                                                        }else{
                                                        $donutcategory[] = '"' . $row->$_POST['data2'] . '"';
                                                        }
                                                    } 
                                                }
                                                    echo implode(',', $donutcategory);
                                                    $donut['categories'] = implode(',', $donutcategory)

                                                ?>
                                                ]
                                            },
                                                        primaryHeader: {
                                                            <?php 
                                                                if(empty($_POST['data2'])){ 
                                                                    $donut['title'] = $this->session->userdata('mypage') . ' by ' . $posttext[$_POST['data1']] ;
                                                                }else{
                                                                    $donut['title'] = $posttext[$_POST['data1']] . ' by ' . $posttext1[$_POST['data2']] ;
                                                                }
                                                                echo 'text: "' . $donut['title'] . '"';
                                                            ?>
                                                         },
                                                        dataSeries: [
                         
                                    <?php 
                                            if(empty($_POST['data2'])){
                                                $donutoutput[] = '{ seriesType: "donut", collectionAlias: "' . $posttext[$_POST['data1']] . '",';
                                                $donutoutput[] = "data: [";
                                                foreach($series as $dataseries){
                                                    $donutoutputseries[] = $dataseries->count_number;
                                                }
                                                $donutoutput[] = implode(',', $donutoutputseries);
                                                $donutoutput[] = "]},"; 
                                            }else{
                                                $i=0;
                                                foreach($labels as $label){

                                                    if($label->$_POST['data1']==''){
                                                        $donutoutput[] = '{ seriesType: "donut", collectionAlias: "Not Specified",';
                                                    }else{
                                                        $donutoutput[] = '{ seriesType: "donut", collectionAlias: "' . $label->$_POST['data1'] . '",';
                                                    }

                                                    $donutoutput[] = "data: [";
                                                    foreach($series[$i] as $dataseries){
                                                        $donutoutput[]= $dataseries->count_number . ",";
                                                    }
                                                    //$output[] = implode(',', $outputseries);
                                                    $donutoutput[] = "]},";
                                                    $i++;
                                                } 
                                            }

                                        echo implode($donutoutput); 
                                        $donut['series']=implode($donutoutput);
                                        $donut['type']='donut';
                                        $donut['module']=$module;  
                                        $this->session->set_userdata('donut', $donut);
                                    ?>

                                                        ]
                                });

                            //spline chart
                                $("#polararea-chart").shieldChart({
                                            zoomMode: 'xy',
                                            theme: "light",
                                            axisX: {
                                                categoricalValues: [
                                               <?php
                                               if(empty($_POST['data2'])){
                                                    foreach($series as $dataseries){
                                                        if($dataseries->$_POST['data1']==''){
                                                            $polarcategory[] = '"Not Specified"';
                                                        }else{
                                                            $polarcategory[] = '"' . $dataseries->$_POST['data1'] . '"';
                                                        }
                                                    } 
                                                }else{
                                                    foreach($series[1] as $row){
                                                        if($row->$_POST['data2']==''){
                                                            $polarcategory[] = '"Not Specified"';
                                                        }else{
                                                            $polarcategory[] = '"' . $row->$_POST['data2'] . '"';
                                                        }
                                                    } 
                                                }
                                                    echo implode(',', $polarcategory);
                                                    $polar['categories'] = implode(',', $polarcategory);

                                                ?>
                                                ]
                                            },
                                                        primaryHeader: {
                                                            <?php 
                                                                if(empty($_POST['data2'])){ 
                                                                    $polar['title'] = $this->session->userdata('mypage') . ' by ' . $posttext[$_POST['data1']] ;
                                                                }else{
                                                                    $polar['title'] = $posttext[$_POST['data1']] . ' by ' . $posttext1[$_POST['data2']] ;
                                                                }
                                                                echo 'text: "' . $polar['title'] . '"';
                                                            ?>                                                     },
                                                        dataSeries: [
                         
                                    <?php 
                                            if(empty($_POST['data2'])){
                                                $polaroutput[] = '{ seriesType: "polararea", collectionAlias: "' . $posttext[$_POST['data1']] . '",';
                                                $polaroutput[] = "data: [";
                                                foreach($series as $dataseries){
                                                    $polaroutputseries[] = $dataseries->count_number;
                                                }
                                                $polaroutput[] = implode(',', $polaroutputseries);
                                                $polaroutput[] = "]},";
                                            }else{
                                                $i=0;
                                                foreach($labels as $label){

                                                    if($label->$_POST['data1']==''){
                                                        $polaroutput[] = '{ seriesType: "polararea", collectionAlias: "Not Specified",';
                                                    }else{
                                                        $polaroutput[] = '{ seriesType: "polararea", collectionAlias: "' . $label->$_POST['data1'] . '",';
                                                    }

                                                    $polaroutput[] = "data: [";
                                                    foreach($series[$i] as $dataseries){
                                                        $polaroutput[]= $dataseries->count_number . ",";
                                                    }
                                                    //$output[] = implode(',', $outputseries);
                                                    $polaroutput[] = "]},";
                                                    $i++;
                                                }   
                                            }

                                        echo implode($polaroutput); 
                                        $polar['series']=implode($polaroutput);
                                        $polar['type']='polararea';
                                        $polar['module']=$module;  
                                        $this->session->set_userdata('polar', $polar);
                                    ?>

                                                        ]
                                });

                            //spline chart
                                $("#line-graph").shieldChart({
                                            zoomMode: 'xy',
                                            theme: "light",
                                            axisX: {
                                                categoricalValues: [
                                               <?php
                                               if(empty($_POST['data2'])){
                                                    foreach($series as $dataseries){
                                                        if($dataseries->$_POST['data1']==''){
                                                            $linecategory[] = '"Not Specified"';
                                                        }else{
                                                            $linecategory[] = '"' . $dataseries->$_POST['data1'] . '"';
                                                        }
                                                    } 
                                                }else{
                                                    foreach($series[1] as $row){
                                                        if($row->$_POST['data2']==''){
                                                            $linecategory[] = '"Not Specified"';
                                                        }else{
                                                            $linecategory[] = '"' . $row->$_POST['data2'] . '"';
                                                        }
                                                    } 
                                                }
                                                    $line['categories'] = implode(',', $linecategory);
                                                    echo $line['categories'];
                                                ?>
                                                ]
                                            },
                                            primaryHeader: {
                                                            <?php 

                                                                if(empty($_POST['data2'])){ 
                                                                    $line['title'] = $this->session->userdata('mypage') . ' by ' . $posttext[$_POST['data1']] ;
                                                                }else{
                                                                    $line['title'] = $posttext[$_POST['data1']] . ' by ' . $posttext1[$_POST['data2']] ;
                                                                }
                                                                echo 'text: "' . $line['title'] . '"';
                                                            ?>
                                                         },
                                                        dataSeries: [
                         
                                    <?php 
                                            if(empty($_POST['data2'])){
                                                $lineoutput[] = '{ seriesType: "line", collectionAlias: "' . $posttext[$_POST['data1']] . '",';
                                                $lineoutput[] = "data: [";
                                                foreach($series as $dataseries){
                                                    $lineoutputseries[] = $dataseries->count_number;
                                                }
                                                $lineoutput[] = implode(',', $lineoutputseries);
                                                $lineoutput[] = "]},"; 
                                            }else{
                                                $i=0;
                                                foreach($labels as $label){

                                                    if($label->$_POST['data1']==''){
                                                        $lineoutput[] = '{ seriesType: "line", collectionAlias: "Not Specified",';
                                                    }else{
                                                        $lineoutput[] = '{ seriesType: "line", collectionAlias: "' . $label->$_POST['data1'] . '",';
                                                    }

                                                    $lineoutput[] = "data: [";
                                                    foreach($series[$i] as $dataseries){
                                                        $lineoutput[]= $dataseries->count_number . ",";
                                                    }
                                                    //$lineoutput[] = implode(',', $lineoutputseries);
                                                    $lineoutput[] = "]},";
                                                    $i++;
                                                }
                                            }

                                        echo implode($lineoutput); 
                                        $line['series']=implode($lineoutput);
                                        $line['type']='line';
                                        $line['module']=$module;  
                                        $this->session->set_userdata('line', $line);
                                    ?>

                                                        ]
                                });
                            
                                       $("#save-donut").click(function() {
                                            var owner = '2';

                                                // Returns successful data submission message when the entered information is stored in database.
                                                $.post("<?php echo base_url('index.php/dashboard/save_chart/donut'); ?>", {chartowner: owner}, function(data) {
                                                alert("Chart saved successfully.");
                                                $("#save-donut").attr("disabled", "disabled").text("Saved!").css("color", "white");
                                                });

                                        }); 

                                       $("#save-bar").click(function() {
                                            var owner = '2';

                                                // Returns successful data submission message when the entered information is stored in database.
                                                $.post("<?php echo base_url('index.php/dashboard/save_chart/bar'); ?>", {chartowner: owner}, function(data) {
                                                alert("Chart saved successfully.");
                                                $("#save-bar").attr("disabled", "disabled").text("Saved!").css("color", "white");
                                                });

                                        }); 

                                       $("#save-line").click(function() {
                                            var owner = '2';

                                                // Returns successful data submission message when the entered information is stored in database.
                                                $.post("<?php echo base_url('index.php/dashboard/save_chart/line'); ?>", {chartowner: owner}, function(data) {
                                                alert("Chart saved successfully.");
                                                $("#save-line").attr("disabled", "disabled").text("Saved!").css("color", "white");
                                                });

                                        }); 

                                       $("#save-polar").click(function() {
                                            var owner = '2';

                                                // Returns successful data submission message when the entered information is stored in database.
                                                $.post("<?php echo base_url('index.php/dashboard/save_chart/polararea'); ?>", {chartowner: owner}, function(data) {
                                                alert("Chart saved successfully.");
                                                $("#save-polar").attr("disabled", "disabled").text("Saved!").css("color", "white");
                                                });

                                        }); 

                            })
                        </script>
                                        <!--/Dynamic Form Field-->

</body>
</html>
