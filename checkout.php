<?php  
include 'include/header.php';
?>

	<div class="container my-5">
		<div class="row">
			<div class="offset-2 col-md-8">
				<h3>Checkout list</h3>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Item Name</th>
							<th scope="col">Price</th>
							<th scope="col">Qty</th>
							<th scope="col">Subtotal</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
				<div class="form-group">
					<label>Notes</label>
					<textarea class="form-control notes"></textarea>
					<input type="hidden" name="" class="total">
				</div>
				<a href="products.php" class="btn btn-success float-left">Continue Shoppint</a>

				<?php  
					if (isset($_SESSION['loginuser'])) {
					
				?>

				<button class="btn btn-warning float-right buy_now">Buy Now</button>
				<?php  }else{
				 echo '<a href="backend/login.php"  class="btn btn-warning float-right">Login to Buy</a>';
				}



				?>


			</div>
		</div>
	</div>

	


<?php  

	include 'include/footer.php';

?>