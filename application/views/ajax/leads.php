<html>
<head>
	<title></title>
</head>
<body>
	<small>
	<table class="table table-striped table-bordered text-justify">
		<tr>
			<th style="width:23%">Company</th>
			<th style="width:23%">Name</th>
			<th style="width:15%">Phone</th>
			<th style="width:23%">Email</th>
			<th style="width:16%">Assigned To</th>
		</tr>
		<?php foreach($leads as $row){ ?>
			<tr>
				<td style="width:23%"><?php echo $row->company ?></td>
				<td style="width:23%"><?php echo $row->name ?></td>
				<td style="width:15%"><?php echo $row->phone ?></td>
				<td style="width:23%"><?php echo $row->email ?></td>
				<td style="width:16%"><?php echo $row->assigned_to ?></td>
			</tr>
		<?php } ?>
	</table>
	</small>
</body>
</html>