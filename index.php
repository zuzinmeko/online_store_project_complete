<?php 


include 'backend/dbconnect.php';
include 'include/header.php';


$sql="SELECT items.*,brands.name as brand_name,subcategories.name as sub_name,categories.name as c_name FROM items INNER JOIN brands ON items.brand_id=brands.id INNER JOIN subcategories ON items.subcategory_id=subcategories.id INNER JOIN categories ON subcategories.category_id=categories.id ORDER BY items.id DESC LIMIT 9";

$stmt=$pdo->prepare($sql);
$stmt->execute();
$items=$stmt->fetchAll();

?>


      
    <section class="banner" id="top" style="background-image: url(img/homepage-banner-image-1920x700.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Dear customers,
                        Welcome My shop.You can see it anything buy now.</h2>
                        <div class="blue-button">
                            <a href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="our-services">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-content">
                            <br>
                            <h4>About us</h4>
                            <p>Aenean hendrerit metus leo, quis viverra purus condimentum nec. Pellentesque a sem semper, lobortis mauris non, varius urna. Quisque sodales purus eu tellus fringilla.<br><br>Mauris sit amet quam congue, pulvinar urna et, congue diam. Suspendisse eu lorem massa. Integer sit amet posuere tellus, id efficitur leo. In hac habitasse platea dictumst. Vel sequi odit similique repudiandae ipsum iste, quidem tenetur id impedit, eaque et, aliquam quod.</p>
                            <div class="blue-button">
                                <a href="about-us.php">Discover More</a>
                            </div>

                            <br>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="img/abc.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- -------------------- -->


     <section class="featured-places">
            <div class="container">
                <div class="row">
                   <div class="col-md-12">
                        <div class="section-heading">
                            
                            <h2 class="text-center">New Arrivals</h2>
                        </div>
                    </div> 
                </div> 
                <div class="row">
                    <?php 
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

                        <?php } ?>

                </div>
            </div>
        </section>
        <div class="text-center my-5" style="color: black"><a href="products.php" class="btn btn-outline-secondary btn-lg">View More Products</a></div><hr class="py-3">

        
<!-- -------------------------------------------------- -->
        <section id="video-container">
            <div class="video-overlay"></div>
            <div class="video-content">
                <div class="inner">
                      <div class="section-heading">
                          
                          <h2 class="text-center">Contact Us</h2>
                      </div>
                      <!-- Modal button -->

                      <div class="blue-button">
                        <a href="contact.php">Talk to us</a>
                      </div>
                </div>
            </div>
        </section>

   </main>

    <?php 

include 'include/footer.php';
     ?>