<?php  
session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role_name']=="admin") {

include 'include/header.php';
include 'dbconnect.php';

?>


<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Order List</h1>
	</div>


	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Order List</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>User Name</th>
							<th>Voucherno</th>
							<th>Order Date</th>
							<th>Total</th>
							
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>User Name</th>
							<th>Voucherno</th>
							<th>Order Date</th>
							<th>Total</th>
							
						</tr>
					</tfoot>
					<tbody>

						<?php  

							$num=1;

							$sql="SELECT orders.*,users.name as user_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE orders.status=:num";
							$stmt=$pdo->prepare($sql);
							$stmt->bindParam(':num',$num);
							$stmt->execute();
							$orders=$stmt->fetchAll();

							foreach ($orders as $order) {

						?>

						<tr>
							<td><?=$order['id'];?></td>
							<td><?=$order['user_name']?></td>
							<td><?=$order['voucherno']?></td>
							<td><?=$order['orderdate']?></td>
							<td><?=$order['total']?></td>
							



						</tr>

						<?php  
							}	
						?>

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