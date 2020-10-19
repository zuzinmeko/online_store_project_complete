<?php 
include 'include/header.php';
include 'backend/dbconnect.php';

$id=$_GET['id'];

$sql="SELECT * FROM subcategories WHERE subcategories.category_id=:c_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':c_id',$id);
$stmt->execute();
$subcategories=$stmt->fetchAll();
?>


<section class="banner banner-secondary" id="top" style="background-image: url(img/banner-image-1-1920x300.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="banner-caption">
					<div class="line-dec"></div>
					<h2>Products</h2>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="featured-places">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-heading">

					<h2 class="text-center">Products</h2>
				</div>
			</div> 
		</div> 
		<div class="container my-5">
			<div class="row">
				<div class="col-md-2 py-3">
					<div class="card">
						<ul class="list-group list-group-flush">
							<?php  
							foreach ($subcategories as $subcategory) {

								?>
								<a href="subcategories.php?id=<?=$subcategory['id']?>"><li class="list-group-item"><?=$subcategory['name']?></li></a>

							<?php } ?>

						</ul>
					</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						<?php
						foreach ($subcategories as $subcategory) {
							$sub_id=$subcategory['id'];

							$sql="SELECT items.*,brands.name as brand_name,subcategories.name as sub_name,categories.name as c_name FROM items INNER JOIN brands ON items.brand_id=brands.id INNER JOIN subcategories ON items.subcategory_id=subcategories.id INNER JOIN categories ON subcategories.category_id=categories.id WHERE items.subcategory_id=:sub_id";
							$stmt=$pdo->prepare($sql);
							$stmt->bindParam(':sub_id',$sub_id);
							$stmt->execute();
							$items=$stmt->fetchAll();

							foreach ($items as $item) {		
								?>
								<div class="col-md-4 col-sm-6 col-xs-12 py-3">
									<div class="featured-item">
										<div class="thumb">
											<img src="backend/<?= $item['photo'] ?>" alt=""> 
											<button class="btn btn-warning border-radius view_detail" data-id="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>" data-discount="<?= $item['discount'] ?>" data-brand="<?= $item['brand_name'] ?>" data-subcategory="<?= $item['sub_name'] ?>" data-description="<?= $item['description'] ?>" data-photo="<?= $item['photo'] ?>">Quick View</button>

										</div>

										<div class="down-content">
											<h4>CategoryName:<?= $item['c_name'] ?></h4>

											<dl><dt>Price:
												<?php 

												if (isset($item['discount'])) {
													echo $item['discount'];


													?>
													<sup>MMK</sup><span><del><?= $item['price']; ?></del></span>
													<?php 
												}else{
													echo $item['price']."MMK";
												}

												?></dt></dl> 

												<dl><dt>Name:<?= $item['name'] ?></dt></dl>


												<div class="text-button">
													<a href="javascript:void(0)" class="text-decoration-none text-dark item-add addtocart" data-id="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>" data-discount="<?= $item['discount'] ?>" >Add to Card</a>
												</div>
											</div>
										</div>
									</div>

									<?php
								}
							}
							?>

						</div>
					</div>
				</div>

					</section>







	<?php 
	include 'include/footer.php';
	?>