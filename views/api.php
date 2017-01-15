<?php include (APPPATH . 'views/partials/_header.php');?>
 
<?php 
	for($i = 0; $i < sizeof($data); $i++){
		print_r($data[$i]['id']);
		echo '<br>';
	}
?>

<?php include (APPPATH . 'views/partials/_footer.php');?>