<!DOCTYPE html >
<html>
<head>
	<title></title>    
	<!-- Morris chart -->
</head>
<body>
	<?php $duration = $this->input->post('duration');

			$toText = array('1W' => 'a week', '2W' => 'two weeks', 'M' => 'a month' , 'Y' => 'a year');
	 ?>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" id="chart-overall-leads">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-12">
                      <ul class="chart-legend clearfix">
                        <li><button class="btn btn-xs btn-success" type="button">Active for <?php echo $toText[$duration] ?> <span class="badge"> <?php echo $active_leads ?></span></button></li>
                        <li><button class="btn btn-xs btn-warning" type="button">Inactive for <?php echo $toText[$duration] ?> now <span class="badge"> <?php echo $inactive ?></span></button></li>
                        <li><button class="btn btn-xs btn-danger" type="button">Never Updated <span class="badge"> <?php echo $never_updated ?></span></button></li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->

	<!-- JAVASCRIPT -->

    <script type="text/javascript">
    	$(document).ready(function(){
    		  //-------------
              //- PIE CHART -
              //-------------
              // Get context with jQuery - using jQuery's .get() method.
              var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
              var pieChart = new Chart(pieChartCanvas);
              var PieData = [
                {
                  value: <?php echo $active_leads ?>,
                  color: "green",
                  label: "Active Leads"
                },
                {
                  value: <?php echo $inactive ?>,
                  color: "yellow",
                  label: "Inactive Leads"
                },
                {
                  value: <?php echo $never_updated ?>,
                  color: "red",
                  label: "Never Updated"
                }
              ];
              var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: "#fff",
                //Number - The width of each segment stroke
                segmentStrokeWidth: 1,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: "easeOutBounce",
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: false,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                //String - A tooltip template
                tooltipTemplate: "<%=value %> <%=label%> users"
              };
              //Create pie or douhnut chart
              // You can switch between pie and douhnut using the method below.  
              pieChart.Doughnut(PieData, pieOptions);
              //-----------------
              //- END PIE CHART -
              //-----------------
    	})
    </script>
</body>
</html>