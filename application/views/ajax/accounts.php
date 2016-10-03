<html>
<head>
	<title></title>
</head>
<body>
	<small>
	<table class="table table-striped table-bordered text-justify">
		<tr>
			<th style="width:23%">Account Name</th>
			<th style="width:23%">Address</th>
			<th style="width:15%">Industry</th>
			<th style="width:23%">Assigned To</th>
		</tr>
		<?php foreach($accounts as $row){ ?>
			<tr>
				<td style="width:23%"><?php echo $row->accountname ?></td>
				<td style="width:23%"><?php echo $row->bill_street ?></td>
				<td style="width:15%"><?php echo $row->industry ?></td>
				<td style="width:23%"><?php echo $row->name ?></td>
			</tr>
		<?php } ?>
	</table>
	</small>
</body>
</html>