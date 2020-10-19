<?php  

	include 'dbconnect.php';

	$id=$_GET['id'];


	$sql="DELETE FROM orders WHERE id=:id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	if ($stmt->rowCount()) {
		header("location:order_list.php");
	}else{
		echo "Error";
	}



?>