<?php  

session_start();
if (isset($_SESSION['loginuser']) && $_SESSION['loginuser']['role_name']=="admin") {

	include 'dbconnect.php';
	 include 'include/header.php';

	$id=$_GET['id'];



?>


<!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order Details</h1>
    <a href="order_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backward fa-sm text-white-50"></i> Go Back</a>
    
 </div>


  <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        
                        <thead>
                        	
                        	<tr >
                        		<h4 class="text-center"><i class="fab fa-shopify"></i>Online Store</h4>
                        		<h6 class="text-center"><i class="fas fa-home mr-1"></i>Hlaing,Yangon</h6>
                        		<p class="text-center"><i class="fas fa-phone mr-1"></i>Tel: 09 785520545</p>

                        	</tr>
              

                              	   <?php  


                        	   $sql="SELECT orders.*,users.name as user_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE orders.id=:id";
                        	   $stmt=$pdo->prepare($sql);
                        	   $stmt->bindParam(':id',$id);
                        	   $stmt->execute();
                        	   $orders=$stmt->fetchAll();
                        	 
                        	   $j=1;
                        	   foreach ($orders as $order) {

                        	   	?>

        						<tr>
        							
                                    <td colspan="2"><b>Customer Name</b></td>                             
                                    <td><?=$order['user_name']?></td>

	                                <td colspan="1"><b>Date </b></td>
	                                <td><?=$order['orderdate']?></td>

                                </tr>
                                <tr>
                                	<td colspan="2"><b>Voucher No</b> </td>                             
                                    <td><?=$order['voucherno']?></td>

                                    <td colspan="1"><b>Order Time </b></td>
	                                <td><?=$order['orderdate']?></td>

                                </tr>

                                <?php  
                            }   
                            ?>

                 
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                               
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            


                              	   <?php  


                        	   $sql="SELECT orders.*,users.name as user_name FROM orders INNER JOIN users ON orders.user_id=users.id WHERE orders.id=:id";
                        	   $stmt=$pdo->prepare($sql);
                        	   $stmt->bindParam(':id',$id);
                        	   $stmt->execute();
                        	   $orders=$stmt->fetchAll();
                        	 
                        	   $j=1;
                        	   foreach ($orders as $order) {

                        	   	?>

        						<tr>
        							
                                  
                                      <td colspan="4">Toal Amount</td>                           
                                    <td><?=$order['total']?></td>


                                </tr>
                               
                                <?php  
                            }   
                            ?>
                                                  
                            </tr>
                        </tfoot>
                        <tbody>


                      <?php  

                            $num=1;
                            $sql="SELECT item_order.*, items.name as item_name,items.discount as price  FROM item_order INNER JOIN items ON item_order.item_id=items.id WHERE item_order.order_id=:id";
                                $stmt=$pdo->prepare($sql);
                                $stmt->bindParam(':id',$id);
                                $stmt->execute();
                                $orderdetails= $stmt->fetchAll();

    

                            $j=1;
                            foreach ($orderdetails as $orderdetail) {
                            	$price=$orderdetail['price'];
                            	$qty=$orderdetail['qty'];
                            	$amount=$price*$qty;
                                ?>

                                <tr>
                                    <td><?php echo $j++; ?></td>
                                    <td><?=$orderdetail['item_name']?></td>
                                    <td><?=$orderdetail['price']?></td>
                                    <td><?=$orderdetail['qty']?></td>
                                    <td>  <?=$amount?>     </td>                           	
                                    

                                    
                                   


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