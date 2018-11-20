<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="An example demonstrating HTML5 document structure.">
    <meta name="keywords" content="HTML5">
    <meta name="author" content="George Filippakis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hotel Profile</title>

    <link rel="stylesheet" type="text/css" href="CSS/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/myCss.css">
    <link rel="stylesheet" type="text/css" href="CSS/animate/animate.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    
    
    
    <!-- Script For Add Review Section -->
    <script>
        
    function getID(id){    
        var num = id[id.length -1];
        
        for (var i=1; i<6; i++){
            
            if(i<=num){
                document.getElementById("star-" + i).classList.remove("far");
                document.getElementById("star-" + i).classList.add("fas");
            }
            else{
                document.getElementById("star-" + i).classList.remove("fas");
                document.getElementById("star-" + i).classList.add("far");
            }
        }
        
        document.cookie="rate=" + num;
    }
    
    
    
    
    
    </script>


</head>

<body>
   
    <?php 
                                                
        $con = mysqli_connect("localhost","wda2018","12345","hotelbook");
        $id = $_GET['ID'];
        $checkInDate = $_GET["checkIn"];
        $checkOutDate = $_GET["checkOut"];
    
    
    
    
        if(isset($_GET["favoriteIcon"])){
        
            if($_GET["status"]==0){
            $favorite_sql = " UPDATE favorites
                            SET status = 1 
                            WHERE user_id=1 && room_id='$id'";
            }
            else{
                $favorite_sql = " UPDATE favorites
                            SET status = 0 
                            WHERE user_id=1 && room_id='$id'";
            }
            $set_fav = $con->query($favorite_sql);
        
    }   
    
        $sql = "SELECT * FROM room INNER JOIN favorites ON room.room_id = favorites.room_id where room.room_id='$id'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
    
        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    
        if(isset($_GET["Book"])){
            $booking_sql = " INSERT INTO bookings (check_in_date, check_out_date, room_id, user_id) 
                    VALUES ('$checkInDate', '$checkOutDate', '$id', 1)";
            
            $set_booking = $con->query($booking_sql);
            
            alert("Booking Succesful!");
            echo "<script> location.href='http://localhost/seminar/search.php?checkIn=&checkOut='; </script>";
            exit;
        }
    
    
    
    if(isset($_GET["review"])){
        
            $rate = $_COOKIE["rate"];
            $text = $_GET["comment"];
            $review_sql = " INSERT INTO reviews (rate, text, room_id, user_id) 
                    VALUES ('$rate', '$text', '$id', 1)";
        
            $set_review = $con->query($review_sql);
            alert("Review Added!");
        
    }
    
    

    

    ?>
       
       
       
           <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WDA18</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="userProfile.php">Profile</a>
            </div>
        </div>
    </nav>
    </header>
        
    <!-- Hotel Profile -->
    <section id="hotelProfile">
    
        <div class="content-box text-center">
            
            <div class="container container-margin">
               
                <div class="row">
                    
                    <div class="col-md-12">
                    
                        <div id="hotel-headline">
                            
                            
                           <p> <?php echo $row["name"] ?> - <?php echo $row["area"].", ".$row["city"] ?> </p>
                            <form action="">
                                <button type="submit" name="favoriteIcon"><i id="fvr" class="fas fa-heart fa-2x <?php if( $row["status"]==1){?> fav-act <?php } ?>"></i></button>
                                <input name="ID" type="hidden" value="<?php echo $row["room_id"] ?>"> 
                                <input name="status" type="hidden" value="<?php echo $row["status"] ?>">                                       
                                <input id="dateIn" type="hidden" name="checkIn" value="<?php echo $_GET["checkIn"] ?>" placeholder="Check In">
                                <input type="hidden" name="checkOut" value="<?php echo $_GET["checkOut"] ?>" placeholder="Check Out">
                            </form> 
                             
                                <p><?php echo $row["price"]?> &euro; </p>
                            
                        </div>
                    </div >
                    
                    <div class="col-md-6">

                        <div id="hotel-image">   
                           
                            <img src="Pictures/rooms/<?php echo $row["photo"] ?>">
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">

                         <div id="hotel-descr">   
                          
                            <h4>Description</h4>
                           
                            <p><?php echo $row["long_description"] ?>
                            </p>
                            <br><br>
                            
                            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                <input type="submit" name="Book" value="Book">
                                <input name="ID" type="hidden" value="<?php echo $id; ?>">
                                <input id="dateIn" type="hidden" name="checkIn" value="<?php echo $_GET["checkIn"] ?>" placeholder="Check In">
                                <input type="hidden" name="checkOut" value="<?php echo $_GET["checkOut"] ?>" placeholder="Check Out">
                            </form>                            
                        </div>                             
                    </div>
                    
                    <div class="col-md-12">
                        <hr id="profile-line">
                    </div>
                    
                    <div class="col-md-3 col-sm-6">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                           
                            <div class="hotel-service-guests">    
                               
                                <i class="fas fa-users fa-4x"></i>
                            
                            </div>

                            <div>
                                <p> Guests: <?php echo $row["count_of_guests"] ?></p>
                                
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="col-md-3 col-sm-6">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="<?php if($row["wifi"]==1){echo "hotel-service-item-active-1";}else{echo "hotel-service-item-active-0";} ?>">
                               
                                <i class="fas fa-wifi fa-4x"></i>     
                                
                            </div>

                            <div class="service-item-desc">

                                <p>Wifi <?php if($row["wifi"]==0){echo " Not ";} ?> Provided</p>

                            </div>
                        </div>                        
                    </div>
                    
                    <div class="col-md-3 col-sm-6">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="<?php if($row["parking"]==1){echo "hotel-service-item-active-1";} else{echo "hotel-service-item-active-0";}?>">
                               
                                <i class="fas fa-parking fa-4x"></i>     
                                
                            </div>

                            <div class="service-item-desc">

                                <p>Parking<?php if($row["parking"]==0){echo " Not ";} ?> Provided</p>

                            </div>
                        </div>                        
                    </div>
                    
                    <div class="col-md-3 col-sm-6">

                        <div class="service-item wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">

                            <div class="<?php if($row["pet_friendly"]==1){echo "hotel-service-item-active-1";} else{echo "hotel-service-item-active-0";} ?>">
                               
                                <i class="fas fa-paw fa-4x"></i>     
                                
                            </div>

                            <div class="service-item-desc">

                                <p><?php if($row["pet_friendly"]==0){echo "Not ";} ?>Pet Friendly</p>

                            </div>
                        </div>                        
                    </div>
                    
                    <div class="col-md-12">
                        <hr id="profile-line">
                    </div>
                    
                    <div class="col-md-12 col-sm-6">

                        <div class="map">

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3145.4573788719945!2d23.747208915689498!3d37.96645407972505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bd68f4a782c7%3A0xd98a343c6f78950e!2sXenakis%2C+J.%2C+%26+Co.+O.E.+%22Baroni%22!5e0!3m2!1sen!2sgr!4v1541551029469" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>                        
                    </div>
                       
                    <div class="col-md-12">
                        <hr id="profile-line">
                    </div>
                </div>
                    
                <?php 
                
                    $reviewSql="SELECT * FROM reviews inner join user WHERE room_id='$id' ";
                    $resultReview = $con->query($reviewSql);
                    
                ?>
                    
                <div class="row">
                  
                   <div class="col-md-12 reviews-head">
                      
                       <h2><u>Reviews</u></h2>
                       
                   </div>
                   
                    <?php while($row = $resultReview->fetch_assoc()) { 
                    
                        $stars=$row["rate"]
                    ?>
                    
                   <div id="review-row" class="col-md-7 review-stars">
                      <p>Posted: <?php echo $row["date_created"] ?></p>
                      
                      <?php 
                            for ($i=1; $i<=5; $i++){
                            
                                if($i<=$stars){
                                    ?>
                                <i class="fas fa-star"></i>
                                <?php
                                } else { ?>

                                <i class="far fa-star"></i>
                                   <?php

                                }
                            
                            } 
                       ?>
                        
                       <p>By: <?php echo $row["username"] ?> </p>
                       
                   </div>
                   
                   <div class="col-md-5 review-text">
                       
                       <p><?php echo $row["text"] ?>
                    </p>
                   </div>
                   
                    <?php } ?>                    
                </div>
                
                
                <div class="row">
                  
                   <div class="col-md-12 reviews-head">
                      
                       <h2><u>Add Review</u></h2>
                       
                   </div>
                    
                   <div id="review-row" class="col-md-12 review-stars">
                       <i id="star-1" class="far fa-star s1" onclick="getID(this.id)"></i>
                       <i id="star-2" class="far fa-star s2" onclick="getID(this.id)"></i>
                       <i id="star-3" class="far fa-star s3" onclick="getID(this.id)"></i>
                       <i id="star-4" class="far fa-star s4" onclick="getID(this.id)"></i>
                       <i id="star-5" class="far fa-star s5" onclick="getID(this.id)"></i>

                       
                   </div>
                  
                       
                   <div class="col-md-12 review-row">
                    
                     <form method="get" action="hotelProf.php" class="margin-for-fixed text-center">
                       
                           <input type="text" name="comment" placeholder="Add Comment">
                     
                        
                            <input type="submit" name="review" value="Submit">
                            <input name="ID" type="hidden" value="<?php echo $id ?>">                                        
                            <input id="dateIn" type="hidden" name="checkIn" value="<?php echo $_GET["checkIn"] ?>" placeholder="Check In">
                            <input type="hidden" name="checkOut" value="<?php echo $_GET["checkOut"] ?>" placeholder="Check Out">
                    </form>
                       
                       
                   </div>
                   
                   
                </div>
            </div>
        </div>
    </section>
    <?php
    
        $con->close(); 
    ?>
    
<footer>
       
        <p>Copyrights: &copy; Savvas Kontos</p>
        <p id="#foot-par">CollegeLink Web Development Academy 2018</p>
        
    </footer>

    
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>