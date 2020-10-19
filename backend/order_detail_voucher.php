<?php 
	session_start();
  	if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role_name']=="admin") {
	include 'include/header.php';
	include 'dbconnect.php';
	$id=$_GET['id'];

	$sql="SELECT item_order.*,items.*,users.name as user_name,orders.* FROM item_order INNER JOIN items ON items.id=item_order.item_id INNER JOIN orders ON orders.id=item_order.order_id INNER JOIN users ON users.id=orders.user_id WHERE item_order.order_id=:item_order_id";

	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(":item_order_id",$id);
	$stmt->execute();

	$item_orders=$stmt->fetchAll();
	//var_dump($item_orders);

?>
<!-- Page Heading -->
	 <div class="d-sm-flex align-items-center justify-content-between mb-4">
	 	<h1 class="h3 mb-0 text-gray-800">Order Detail Voucher</h1>
	 	<a href="order_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backward fa-sm text-white-50"></i>Go Back</a>
	 </div>
	 <div class="container py-5">
	 	<div class="row">
	 		<div class="offset-2 col-md-8">
	 			<table class="table table-bordered">
	 				<thead>

	 					<tr>
	 						<td colspan="10" rowspan="4" style="border-width: 4px">
	 							<h3 class="text-center"><i class="fab fa-shopify"></i>Online Store</h3>
	 							<h6 class="text-center"><i class="fas fa-home mr-1"></i>No(5) Hlaing Township, Yangon</h6>
	 							<h6 class="text-center"><i class="fas fa-phone mr-1"></i>Tel:09785520579,0985632145</h6>
	 							
	 						</td>

	 					</tr>
	 				</thead>
	 				<tbody>
	 					<tr>
	 						<td colspan="3" class="border-0">
	 							<h6>User Name</h6>
	 						</td>
	 						<td colspan="2" class="border-0"><h6>: <?php echo $item_orders[0]['user_name'] ?></td></h6>
	 						<td colspan="1" class="border-0"><h6>Date</td></h6>
	 						<td colspan="1" class="border-0"><h6  class="text-center">:</td></h6>
	 						<td colspan="3" class="border-0" ><h6 class="text-left"><?php echo $item_orders[0]['orderdate'] ?></td></h6>
	 					</tr>
	 					<tr>
	 						<td colspan="3" class="border-0"><h6>Voucher</h6></td>
	 						<td colspan="7" class="border-0"><h6>: <?php echo $item_orders[0]['voucherno'] ?></h6></td>
	 					</tr>
	 					<tr>
	 						<td colspan="5" class=""><h6>Item Name</h6></td>
	 						<td colspan="2" class=""><h6>Price</h6></td>
	 						<td colspan="1" class=""><h6>Qty</h6></td>
	 						<td colspan="2" class=""><h6>Amount</h6></td>
	 					</tr>
	 					<?php 

	 					foreach ($item_orders as $item_order) {
	 						$qty=$item_order['qty'];
	 						$price=$item_order['price'];
	 						$subtotal=$qty*$price;

	 						$serviceAmt=1000;
	 						$taxAmt=1100;
	 						$discountAmt=0;
	 						$netAmt=0;

	 						$total=$item_orders[0]['total'];

	 						$finalResult=$total+($serviceAmt+$taxAmt+$discountAmt+$netAmt);


	 						?>

	 						<tr>
	 							<td colspan="5"><?php echo $item_order['name'] ?></td>
	 							<td colspan="2"><?php echo $item_order['price'] ?></td>
	 							<td colspan="1" class="text-center"><?php echo $qty ?></td>
	 							<td colspan="2" class="text-right"><?php echo $subtotal ?></td>
	 						</tr>
	 					<?php } ?>
	 					<tr>
	 						<td colspan="8" class="">Total Amount</td>
	 						<td colspan="2" class="text-right " ><?php echo $item_orders[0]['total'] ?></td>
	 					</tr>
	 					<tr>
	 						<td colspan="8" class="">Service Amount</td>
	 						<td colspan="2" class="text-right" ><?php echo $serviceAmt ?></td>
	 					</tr>
	 					<tr>
	 						<td colspan="8" class="">Discount Amount</td>
	 						<td colspan="2" class="text-right" ><?php echo $discountAmt ?></td>
	 					</tr>
	 					<tr>
	 						<td colspan="8" class="">Tax Amount</td>
	 						<td colspan="2" class="text-right" ><?php echo $taxAmt ?></td>
	 					</tr>
	 					<tr>
	 						<td colspan="8" class="">Net Amount</td>
	 						<td colspan="2" class="text-right" ><?php echo $finalResult ?></td>
	 					</tr>

	 				</tbody>
	 			</table>
	 		</div>
	 	</div>
	 </div>
 

 <?php 
 	include 'include/footer.php';
 	}else{
  header("location:../index.php");
}
  ?>