<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="An example demonstrating HTML5 document structure.">
    <meta name="keywords" content="HTML5">
    <meta name="author" content="George Filippakis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile</title>

    <link rel="stylesheet" type="text/css" href="CSS/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/myCss.css">
    <link rel="stylesheet" type="text/css" href="CSS/animate/animate.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    
    <?php    
    
        $con = mysqli_connect("localhost","wda2018","12345","hotelbook");    
        $sql="SELECT * FROM bookings inner join room ON bookings.room_id=room.room_id";        
        $result = $con->query($sql);
    ?>
    
    <head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WDA18</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link" href="index.php">Home </a>
              <a class="nav-item nav-link active" href="userProfile.php">Profile</a><span class="sr-only">(current)</span>
            </div>
        </div>
    </nav>
</head>

    
    <!-- searchResults -->
    <section id="searchResults">

        <!-- About right side with diagonal BG parallax -->
        <div id="searchResults-gb-diagonal" class="bg-parallax search-row margin-for-footer">

            <div class="container">

                <div class="row search-row">
                    
                    <p id="bookings-header">My Bookings</p>
                
                    <?php
                    
                        if (!empty($row)) { 
                    ?>
                    <p id="no-result-text">No Bookings Found!</p>

                    <?php 

                        }
                        else{

                            while($row = $result->fetch_assoc()) {
                    ?>
        
                    <div class="col-md-12 search-result">
                        
                        <div class="container">

                            <div class="row">

                                <div class="col-md-3 ">
                                   
                                    <img src="Pictures/rooms/<?php echo $row["photo"]?>" class="hotel-image">

                                </div>
                                
                                <div class="col-md-9">
                                
                                        <h3><?php echo $row["name"]?></h3>
                                        <h5><?php echo ($row["city"]. ", " .$row["area"] )?></h5>
                                        <p><?php echo $row["short_description"] ?>.</p>

                                </div>
                            </div>
                        </div>
                        
                        <hr>   
                        <div class="row">

                            <div class="col-md-12 ">
                               
                                <form method="post" action="hotelprof.php">
                                   
                                    <ul>
                                        <li class="price-label">From <?php echo $row["check_in_date"]; ?> to <?php echo $row["check_out_date"]; ?></li>
                                    </ul>
                                    
                                <input name="ID" type="hidden" value="" >
                                                                    
                                </form>
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


        <!-- About Left side with content -->
        <div class="container container-overides">

            <div class="row filter-row">

                <div class="col-md-12">

                    <div id="searchResults-content-box">

                        <div id="searchResults-content-box-outer">

                            <div id="searchResults-content-box-inner">

                                <div id="favorites" class="content-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">

                                    <h3> Favorites: </h3>
                                    
                                    <?php 
                                    
                                        $favorites_sql = "SELECT * FROM room INNER JOIN favorites on room.room_id=favorites.room_id
                                                            where favorites.status=1";
                                        $result_favorites = $con->query($favorites_sql);
                                        
                                        while($rows_fav = $result_favorites->fetch_assoc()){
                                    
                                    ?>
                                    
                                    <h4><?php echo $rows_fav["name"]; ?></h4>
                                    
                                    <?php } ?>

                                    <div class="content-title-underline"></div>

                                </div>                                

                                <div id="searchResults-desc" class="wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">

                                    <h3> My Reviews: </h3>
                                        
                                    <?php 
                                    
                                        $reviewsSql="SELECT * FROM reviews inner join room on reviews.room_id=room.room_id";
                                        $resultReviews = $con->query($reviewsSql);
                                        
                                        while($rows = $resultReviews->fetch_assoc()) { 
                                    ?>
                                        
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            
                                            <?php 
                                            
                                                for ($i=1; $i<=5; $i++){
                            
                                                    if($i<=$rows["rate"]){
                                            ?>
                                            <i class="fas fa-star"></i>
                                            <?php
                                                    } else { 
                                            ?>    
                                            <i class="far fa-star"></i>
                                            
                                            <?php
                                                    }

                                                } 
                                            ?>
                                                
                                        </div>
                                           
                                        <div class="form-group col-md-12">
                                            
                                            <?php echo $rows["name"] ?>
                                        </div>
                                            
                                    </div>
                                        
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
                                       
                                
    <footer>
       
        <p>Copyrights: &copy; Savvas Kontos</p>
        <p id="#foot-par">CollegeLink Web Development Academy 2018</p>
        
    </footer>
            
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/myJs.js"></script>
</body>

</html>