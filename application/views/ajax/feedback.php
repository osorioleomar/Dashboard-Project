<!DOCTYPE html>
<html>
<head>
	<title>Feedbacks</title>
</head>
<body>
        <?php foreach($feedbacks as $feedback){ ?>
        <blockquote>
        <?php echo $feedback->feedback;
        	if($feedback->seen){

        	}else{
        		echo "<sup class='text-red'><em>NEW</em></sup>";
        	}
         ?>
        	<footer><?php echo $feedback->name . " on " . $feedback->created_time ?></footer>
        </blockquote>
        <?php } ?>
</body>
</html>