<?php
	echo "module:" . $module ;
	echo "<hr>";
	echo "industry:" . $industry;
	echo "<hr>";
	echo "location:";
	foreach($location as $row){
		echo $row . "; ";
	};
	echo "<hr>";
	echo "fieldnames:";
	foreach($fieldnames as $row){
		echo $row . "; ";
	};
	echo "<hr>";
	echo "conditions:";
	foreach($conditions as $row){
		echo $row . "; ";
	};
	echo "<hr>";
	echo "values:";
	foreach($values as $row){
		echo $row . "; ";
	};

?>