<!-- delete-chair.php -->
<?php
	if (isset($_GET['chair_no'])) {
		$id =$_GET['id'];
		$table_name = $_GET['table_name'];
		$sql ="DELETE FROM `restaurant_tables` WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>'; ?>
		<script type="text/javascript">
			var dist = <?php echo $table_name; ?>;
		</script>
<?php		
		echo '<script>window.location.href ="delete-table.php?table_id=" + dist;</script>';
		//header("Location: view-chair-list.php?table_id=".$tbl_id."");
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
?>

