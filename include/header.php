<?php 
    session_start();

    include 'backend/dbconnect.php';
    $sql="SELECT * FROM categories";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $categories=$stmt->fetchAll();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>zuonline store</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/hero-slider.css">
        <link rel="stylesheet" href="css/owl-carousel.css">
        <link rel="stylesheet" href="css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

<body>
 
   <div class="wrap" class="fixed-top menu">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <button id="primary-nav-button" type="button">Menu</button>
                        <a href="index.html">
                        <div class="logo">
                            <img src="img/logo.png" alt="Venue Logo">
                        </div></a>
                        <nav id="primary-nav" class="dropdown cf">
                            <ul class="dropdown menu">
                               <li class='active'>
                                <a href="index.php">Home
                               </a>
                                </li>

                               <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Categories
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <?php 

                                foreach ($categories as $category) {

                                    ?>
                                    <a class="dropdown-item" href="categories.php?id=<?=$category['id']?>"><?=$category['name']?></a>
                                <?php } ?>

                            </li>

                            <?php 
                            if (isset($_SESSION['loginuser'])) {

                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?= $_SESSION['loginuser']['name']; ?>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="#">Profile</a>
                                      <a class="dropdown-item" href="backend/logout.php">Logout</a>

                                  </div>
                              </li>
                              <?php 
                          }else{
                              ?>
                              <li class="nav-item"><a href="backend/login.php" class="nav-link">Login</a></li>
                              <li class="nav-item"><a href="backend/register.php" class="nav-link">Register</a></li>
                          <?php } ?>

                                <li class='active'>
                                <a href="#">A&C</a>
                                <ul class="sub-menu">
                                   <li><a href="about-us.php">About Us</a>
                                   </li>
                                   <li><a href="contact.php">Contact Us</a></li>
                               </ul>
                                </li>
                                <li class='active'>
                                  <a href="checkout.php" title="fa-shopping-cart" id="count" >
                                    <i class="fa fa-shopping-cart" style="font-size:24px; color:  #blue;"></i>

                                    <span id="item_count" style="color: #blue;">0</span>
                                  </a>


                                </li>
                            </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
</div>