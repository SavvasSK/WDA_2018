<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="An example demonstrating HTML5 document structure.">
    <meta name="keywords" content="HTML5">
    <meta name="author" content="George Filippakis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Landing Page</title>

    <link rel="stylesheet" type="text/css" href="CSS/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/myCss.css">
    <link rel="stylesheet" type="text/css" href="CSS/animate/animate.css">

</head>

<body>
    
    
    
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">WDA18</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar collapse" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="userProfile.php">Profile</a>
            </div>
        </div>
    </nav>
    </header>
    
     <!-- Home -->
    <section id="home">             

        <div id="home-cover" class="bg-parallax animated fadeIn">

            <div id="home-content-box">

                <div id="home-content-box-inner" class="text-center">

                    <div id="home-heading" class="animated zoomIn">
                      
                        <form method="get" action="search.php">
                       
                            <h2> Welcome <br> Search for available rooms</h2>
                            
                            <select name="city">  
                                                          
                                <option value="" disabled selected hidden>Choose City</option>
                                <option value="athens">Athens</option>
                                <option value="thessaloniki">Thessaloniki</option>
                                <option value="kavala">Kavala</option>
                                <option value="santorini">Santorini</option>   
                                                           
                            </select>
                            
                            <br class="responsive-break-line">

                            <select name="roomType">
                            
                                <option value="" disabled selected hidden>Room Type</option>
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="triple">Triple</option>
                                <option value="fourhold">Fourhold</option>
                              
                            </select>
                            
                            <br>
                            
                            <input id="dateIn" type="text" name="checkIn" placeholder="Check In" onfocus="(this.type='date')" onfocusout="(this.type='text')">
                            
                            <br class="responsive-break-line">
                            
                            <input id="dateOut" type="text" name="checkOut" placeholder="Check Out" onfocus="(this.type='date')" onfocusout="(this.type='text')">
                            
                            <br>    
 
                            <input type="submit" value="Search">
                            
                        </form>                        
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
