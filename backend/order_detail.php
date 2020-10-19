<?php  

	include 'dbconnect.php';

	$id=$_GET['id'];


	$sql="SELECT item_order.*, items.name as item_name FROM item_order INNER JOIN items ON item_order.item_id=items.id WHERE item_order.order_id=:id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	$orderdetails= $stmt->fetchAll();

	var_dump($orderdetails);



?>