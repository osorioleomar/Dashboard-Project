
	<small>
	<div class="row text-center">
		<label class="badge bg-green"><?php echo $contacts->num_rows() ?> records found!</label>
		<label class="badge bg-yellow"><span id="selected-contacts">0</span> contacts selected</label>

	</div>
	<table class="table table-bordered table-hover text-justify" id="contacts-table">
		<thead>
			<tr>
				<th><input type="checkbox" id="select-all"></th>
				<th>Name</th>
				<th>Company</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Mobile</th>
				<th>Market Segment</th>
				<th>Subsegment</th>
				<th>Address</th>
			</tr>
		</thead>
		<?php foreach($contacts->result() as $row){ ?>
			<tr>
				<td><input type="checkbox" class="select" role="<?php echo $row->contactid ?>"></td>
				<td><?php echo $row->name ?></td>
				<td><?php echo $row->company ?></td>
				<td><?php echo $row->email ?></td>
				<td><?php echo $row->phone ?></td>
				<td><?php echo $row->mobile ?></td>
				<td><?php echo $row->cf_762 ?></td>
				<td><?php echo $row->cf_764 ?></td>
				<td><?php echo $row->mailingstreet . ", " . $row->mailingcity ?></td>
			</tr>
		<?php } ?>
	</table>
	</small>
	<script type="text/javascript">
        $('#contacts-table').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
        var selected = 0;
        $(document).on("change",".select",function(){
        	if(this.checked){
        		selected++;
        	}else{
        		selected--;
        	}
        	$("#selected-contacts").text(selected);
        })
	</script>