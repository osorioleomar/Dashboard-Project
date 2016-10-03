
	<small>
	<table class="table table-bordered table-hover text-justify" id="p_leads-table">
		<thead>
			<tr>
                <th>Company</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Phone</th>
                <th style="width: 50px">Email</th>
                <th>Address</th>
                <th>Market Segment</th>
                <th>Subsegment</th>
                <th>Status</th>
			</tr>
		</thead>
 		<?php foreach($p_leads as $row){ ?>
			<tr>
				<td><?php echo $row->company ?></td>
				<td><?php echo $row->name ?></td>
				<td><?php echo $row->designation ?></td>
				<td>phone</td>
				<td><?php echo $row->email ?></td>
				<td>address</td>
				<td>market segment</td>
				<td>subsegment</td>
				<td>status</td>
			</tr>
		<?php } ?>
	</table>

	</small>
    <!-- DATA TABLES SCRIPT -->
	<script type="text/javascript">
        $('#accounts-table').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
	</script>