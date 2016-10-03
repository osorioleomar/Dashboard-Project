
	<small>
	<div class="row text-center">
		<div class="btn-group">
			<label class="btn btn-sm btn-primary"><?php echo $accounts->num_rows() ?> records</label>
			<label class="btn btn-sm btn-warning"><span id="selected-invites">0</span> leads selected</label>
			<button class="btn btn-sm btn-success" id="savelist"><i class="fa fa-check-circle"></i> Save list</button>
			<button class="btn btn-sm btn-danger" id="clearlist"><i class="fa fa-times-circle"></i> Clear list</button>
		</div>
	</div>
	<table class="table table-bordered table-hover text-justify" id="accounts-table">
		<thead>
			<tr>
				<th><input type="checkbox" id="select-all"></th>
				<th>Account Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Billing Address</th>
				<th>Billing City</th>
				<th>Market Segment</th>
				<th>Subsegment</th>
			</tr>
		</thead>
		<?php foreach($accounts->result() as $row){ ?>
			<tr>
				<td><input type="checkbox" class="invites-select" role="<?php echo $row->accountid ?>"></td>
				<td><?php echo $row->accountname ?></td>
				<td><?php echo $row->phone ?></td>
				<td><?php echo $row->email1 ?></td>
				<td><?php echo $row->bill_street ?></td>
				<td><?php echo $row->bill_city ?></td>
				<td><?php echo $row->cf_754 ?></td>
				<td><?php echo $row->cf_756 ?></td>
			</tr>
		<?php } ?>
	</table>
	</small>
    <!-- DATA TABES SCRIPT -->
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