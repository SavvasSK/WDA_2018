<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="An example demonstrating HTML5 document structure.">
    <meta name="keywords" content="HTML5">
    <meta name="author" content="George Filippakis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Page</title>

    <link rel="stylesheet" type="text/css" href="CSS/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/myCss.css">
    <link rel="stylesheet" type="text/css" href="CSS/animate/animate.css">
    
    <script>
    $(document).ready(function() {
        $.ajax({
            url: "js/myJs.js",
            dataType: "script",
            cache: true
        });
    });
    </script>
    
</head>

<body>


<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WDA18</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link" href="index.php">Home <span class="sr-only"></span></a>
              <a class="nav-item nav-link" href="userProfile.php">Profile</a>
            </div>
        </div>
    </nav>
</header>


    <!-- searchResults -->
    <section id="searchResults">

        <!-- About right side with diagonal BG parallax -->
        <div id="searchResults-gb-diagonal" class="bg-parallax search-row search-result-footer">

            <div class="container">

                <div class="row search-row">

                    <?php
                    
                        $dateSetIn=0;
                        $dateSetOut=0;
                        $rbCheck = "checked";
                        $room=0;
                        $town = "";
                    
                    
                        function itemSet($item, $flag) {
                            
                            if ($item===""){
                                $flag=false;
                            }
                            else {
                                $flag=true;
                            }

                            return $flag;
                        }

                        $checkInDate=$_GET["checkIn"];
                        $checkOutDate=$_GET["checkOut"];

                        $con = mysqli_connect("localhost","wda2018","12345","hotelbook"); 
                            
                        $dateSetIn = itemSet($_GET["checkIn"], $dateSetIn);
                        $dateSetOut = itemSet($_GET["checkOut"], $dateSetOut);                   
                    
                        if(isset($_GET["roomType"])) {
                            
                            switch($_GET["roomType"]) {

                                case "single": 
                                    $room=1;
                                    break;

                                case "double": 
                                    $room=2;
                                    break;
                                case "triple": 
                                    $room=3;
                                    break;
                                case "fourhold": 
                                    $room=4;
                                    break;                              
                            }
                            
                           
                        }
                    
                        if(isset($_GET["city"])){
                            
                            $town=$_GET["city"];
                            
                        }
                    
                        unset($sql);

                        if (isset($_GET["roomType"])) {
                            $sql[] = " room_type='$room' ";
                        }
                        if (isset($_GET["city"])) {
                            $sql[] = " city='$town' ";
                        }
                        if(($dateSetIn === true) && ($dateSetOut === true)){
                            $sql[] = " room_id NOT IN (
                                    select room.room_id 
                                     from room 
                                    inner join bookings
                                    on room.room_id = bookings.room_id 
                                    where bookings.check_in_date BETWEEN '$checkInDate' AND '$checkOutDate')";
                        }

                        $query = "SELECT * FROM room";

                        if (!empty($sql)) {
                            $query .= ' WHERE ' . implode(' AND ', $sql);
                        }
                        
                        

                        if(($dateSetIn === false) || ($dateSetOut === false)){
                                    
                    ?>
                    
                    <p class="notice-text">Notice! Please Select Check In/Out Date in order to book!</p>   
                    
                    <?php

                        } 
                        elseif ($checkInDate === $checkOutDate){
                                    
                    ?>
                    <p class="notice-text">Notice! Please change Check Out Date in order to book!</p>
                                    
                    <?php
                                   
                        }    
                    ?>

                    <?php                        
    
                        $result = $con->query($query);                    
                        
                        while($row = $result->fetch_assoc()) {
                    ?>
                       
                    <div class="col-md-12 search-result">

                        <div class="container">

                            <div class="row">

                                <div class="col-md-3 ">
                                   
                                    <img src="Pictures/rooms/<?php echo $row["photo"] ?>" class="hotel-image">
                                </div>
                                   
                                <div class="col-md-9">

                                    <h3>
                                        <?php echo $row["name"]?>
                                    </h3>
                                    
                                    <h5>
                                        <?php echo ($row["city"]. ", " .$row["area"] )?>
                                    </h5>
                                    
                                    <p>
                                        <?php echo $row["short_description"] ?>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-12 search-result-footer">
                                   
                                <form method="get" action="hotelprof.php">
                                    <ul>
                                        <li class="price-label">Per Night:
                                            <?php echo $row["price"] ?> &euro;
                                        </li>
                                        <li>Number Of Guests:
                                                <?php echo $row["count_of_guests"] ?>
                                        </li>
                                    </ul>
                                       
                                    <input name="ID" type="hidden" value="<?php echo $id=$row["room_id"] ?>">                                        
                                    <input id="dateIn" type="hidden" name="checkIn" value="<?php echo $_GET["checkIn"] ?>" placeholder="Check In">
                                    <input type="hidden" name="checkOut" value="<?php echo $_GET["checkOut"] ?>" placeholder="Check Out">

                                    <?php if ((($dateSetIn==true)&&($dateSetOut==true))&&($_GET["checkIn"] !== $_GET["checkOut"])){ ?>
                                        <input value="Book Now!" type="submit">
                                    <?php } ?>
                                </form>
                            </div>
                        </div>

                    </div>

                    <?php
                        }
                        $con->close();
                    ?>

                </div>
                <br><br><br><br><br><br><br><br><br>
            </div>
        </div>

        <!-- About Left side with content -->
        <div class="container container-overides">

            <div class="row filter-row">

                <div class="col-md-12">

                    <div id="searchResults-content-box">

                        <div id="searchResults-content-box-outer">

                            <div id="searchResults-content-box-inner">

                                <div class="content-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">

                                    <h3 class="text-center"> Extra Filters </h3>

                                    <div class="content-title-underline"></div>

                                </div>

                                <div id="searchResults-desc" class="wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".5s">

                                    <form method="get" action="search.php">

                                        <h4> Cities: </h4>
                                        
                                        <div class="form-row">

                                            <div class="form-group col-md-6">

                                                <label> Athens </label>
                                                <input type="radio" name="city" value="athens" <?php if($town=="athens"){ ?> checked <?php } ?> >

                                            </div>

                                            <div class="form-group col-md-6">

                                                <label> Thess/ki </label>
                                                <input type="radio" name="city" value="thessaloniki" <?php if($town=="thessaloniki"){ ?> checked <?php } ?>>

                                            </div>
                                        </div>
                                        
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                               
                                                <label> Kavala </label>
                                                <input type="radio" name="city" value="kavala" <?php if($town=="kavala"){ ?> checked <?php } ?>>

                                            </div>

                                            <div class="form-group col-md-6">

                                                <label> Santorini </label>
                                                <input type="radio" name="city" value="santorini" <?php if($town=="santorini"){ ?> checked <?php } ?>>

                                            </div>
                                        </div>


                                        <h4> Room Types: </h4>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">

                                                <label> Single </label>
                                                <input type="radio" name="roomType" value="single" <?php if($room=="1"){ ?> checked <?php } ?>>

                                            </div>

                                            <div class="form-group col-md-6">

                                                <label> Double </label>
                                                <input type="radio" name="roomType" value="double" <?php if($room=="2"){ ?> checked <?php } ?>>

                                            </div>
                                        </div>
                                        
                                        <div class="form-row">

                                            <div class="form-group col-md-6">

                                                <label> Triple </label>
                                                <input type="radio" name="roomType" value="triple" <?php if($room=="3"){ ?> checked <?php } ?> >

                                            </div>

                                            <div class="form-group col-md-6">

                                                <label> Fourhold </label>
                                                <input type="radio" name="roomType" value="fourhold" <?php if($room=="4"){ ?> checked <?php } ?>>

                                            </div>
                                        </div>
                                        
                                        <label>Price Range</label>
                                        <input type="range" list="tickmarks" class="range-input">
                                        
                                        <br>

                                        <ul>
                                            <li><label>Check In  &nbsp;  &nbsp;</label> </li>
                                            <li><input id="dateIn" type="date" name="checkIn" value="<?php echo $_GET["checkIn"] ?>"> </li>
                                            <li><label>Check Out:</label> </li>
                                            <li><input id="dateOut" type="date" name="checkOut" value="<?php echo $_GET["checkOut"] ?>"></li>
                                        </ul>

                                        <div id="searchResults-btn" class="wow animated fadeInUp text-center" data-wow-duration="1s" data-wow-delay=".5s">

                                            <input class="btn btn-lg apply-btn" type="submit" class="wow animated fadeInUp text-center" value="Submit" data-wow-duration="1s" data-wow-delay=".5s">

                                        </div>
                                    </form>
                                    <script src="js/myJs.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    
    
   
    

    <script src="js/myJs.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
     <footer>
       
        <p>Copyrights: &copy; Savvas Kontos</p>
        <p id="#foot-par">CollegeLink Web Development Academy 2018</p>
        
    </footer>
    
</body>

</html>