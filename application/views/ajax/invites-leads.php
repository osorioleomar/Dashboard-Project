
	<small>
	<div class="row text-center">
		<div class="btn-group">
			<label class="btn btn-sm btn-primary"><?php echo $leads->num_rows() ?> records</label>
			<label class="btn btn-sm btn-warning"><span id="selected-invites">0</span> leads selected</label>
			<button class="btn btn-sm btn-success" id="savelist"><i class="fa fa-check-circle"></i> Save list</button>
			<button class="btn btn-sm btn-danger" id="clearlist"><i class="fa fa-times-circle"></i> Clear list</button>
		</div>
	</div>
	<table class="table table-bordered table-hover text-justify" id="leads-table">
		<thead>
			<tr>
				<th><input type="checkbox" id="select-all"></th>
				<th>Company</th>
				<th>Name</th>
				<th>Designation</th>
				<th>Phone</th>
				<th style="width: 50px">Email</th>
				<th>Address</th>
				<th>Market Segment</th>
				<th>Subsegment</th>
			</tr>
		</thead>
		<?php foreach($leads->result() as $row){ ?>
			<tr>
				<td><input type="checkbox" class="invites-select" role="<?php echo $row->leadid ?>"></td>
				<td><?php echo $row->company ?></td>
				<td><?php echo $row->name ?></td>
				<td><?php echo $row->designation ?></td>
				<td><?php echo $row->phone ?></td>
				<td style="width: 50px"><?php echo $row->email ?></td>
				<td><?php echo $row->address ?></td>
				<td><?php echo $row->industry ?></td>
				<td><?php echo $row->segment ?></td>
			</tr>
		<?php } ?>
	</table>
	</small>
    <!-- DATA TABES SCRIPT -->
	<script type="text/javascript">

        $('#leads-table').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
	</script>
