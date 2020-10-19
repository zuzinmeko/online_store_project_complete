<?php  

	include 'dbconnect.php';

	$id=$_GET['id'];
	$num=1;

	$sql="UPDATE orders SET status=:num WHERE id=:id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':num',$num);
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	if ($stmt->rowCount()) {
		header("location:order_list.php");
	}else{
		echo "Error";
	}



?>