
        <?php
            //connect to database
            //create connection 
            $server = "localhost";
            $usr = "root";
            $pw = "12345";

            $conn = new mysqli($server, $usr, $pw);
            if($conn->connect_error){
                die("Connection error - ".$conn->connect_error);
            }
            else
                //echo "Connection successful!!";

            if(isset($_POST["RegisterSubmit"])){ //User sends the input
                echo "submit encountered!";
                if(!isset($_POST["uname"]) ||!isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["address"]) || !isset($_POST["city"]) || !isset($_POST["zip"])|| !isset($_POST["email"]) || !isset($_POST["gender"]) || !isset($_POST["password"])){
                    echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
                }
				else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
					$msg = "Wrong email address entered!! PLease enter a valid email!!";
					echo "<script type = 'text/javascript'>alert('$msg');</script>";
				}
                else{
					$uname = $_POST["uname"];
                    $fname = $_POST["fname"];
                    $lname = $_POST["lname"];
                    $address = $_POST["address"];
                    $city = $_POST["city"];
                    $zip = $_POST["zip"];
                    $email = $_POST["email"];
                    $gender = $_POST["gender"];
                    $password = $_POST["password"];
                    $insertquery = "insert into db_project.user values(\"$uname\",\"$fname\",\"$lname\",\"$address\",\"$city\",$zip,\"$email\",\"$gender\",\"$password\");";
                    if($conn->query($insertquery) === TRUE){
                        echo "Insert Success!";
                    }
                    else
                        echo "error: ".$conn->error();
                }
            }
            
        ?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Weather Database Project</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body>
		
		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.html" class="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-type">
							<h1 class="site-title">WeatherU</h1>
							<small class="site-description">Your weather companion</small>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="weather_summary.php">Weather Summary</a></li>
							<li class="menu-item"><a href="live_comments.php">Live comments</a></li>
							<li class="menu-item"><a href="profile.php">Profile</a></li>
							<li class="menu-item current-menu-item"><a href="register5.php">Register/Sign in</a></li>
							<li class="menu-item"><a href="employee.php">Employee</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->

			<main class="main-content">
				<div class="container">
					<div class="breadcrumb">
						<a href="index.html">Home</a>
						<span>Register/Sign in</span>
					</div>
				</div>

				<div class="fullwidth-block">
					<div class="container">
						<div class="col-md-5">
							<div class="contact-details">
							    <h2 class="section-title">Sign In</h2>
								<!--<div class="map" data-latitude="-6.897789" data-longitude="107.621735"></div>-->
								<form action="profile.php" class="contact-form" method="POST">
								<div class="row">
									<div class="col-md-6"><input type="text" name = "unamelogin" placeholder="Username..."></div>
									<div class="col-md-6"><input type="Password" name = "pwd" placeholder="Password..."></div>
								</div>
								<div class="text-right">
									<input type="submit" name = "loginSubmit" value="Login">
								</div>
								</form>
									<div class="contact-info">
									<address>
										<img src="images/icon-marker.png" alt="">
										<p>WeatherU INC. <br>
										School of Information Sciences, University of Pittsburgh</p>
									</address>
									
									<!--<a href="#"><img src="images/icon-phone.png" alt="">+1 800 100 101</a>-->
									<!--<a href="#"><img src="images/icon-envelope.png" alt="">sabrina@weatheru.com</a>-->
								</div>
							</div>
						</div>
						<div class="col-md-6 col-md-offset-1">
							<h2 class="section-title">Registration Form</h2>
							<p>Hellooo Weatherian, We've got our Weatherminators deployed to get rid of those pestering (B)lizzards! All you gotta do is fill out this form to save on those menacy rain buckets!!</p>
							<form action="register5.php" class="contact-form" method="POST">
								<div class="row">
								    <div class="col-md-6"><input type="text" name = "uname" placeholder="User name..."></div>
									<div class="col-md-6"><input type="text" name = "fname" placeholder="First name..."></div>
								</div>
								<div class="row">
									<div class="col-md-6"><input type="text" name = "lname" placeholder="Last name..."></div>
									<div class="col-md-6"><input type="text" name = "address" placeholder="Address..."></div>
								</div>
								<div class="row">
									<div class="col-md-6"><input type="text" name = "city" placeholder="City..."></div>
									<div class="col-md-6"><input type="text" name = "zip" placeholder="Zip Code..."></div>
								</div>
								<div class="row">
                                    <div class="col-md-6"><input type="text" name = "email" placeholder="E-mail..."></div>
									<div class="col-md-6"><input type="text" name = "gender" placeholder="Gender..."></div>	
                                    <div class="col-md-6"><input type="text" name = "password" placeholder="Password..."></div> 									
								</div>
								
								<div class="text-right">
									<input type="submit" name = "RegisterSubmit" placeholder="Send message">
								</div>
							</form>

						</div>
					</div>
				</div>
				
			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					<div class="row">
						
						<div class="col-md-3 col-md-offset-1">
							<div class="social-links">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>

					<p class="colophon">INFSCI 2710: Database Management</p>
				</div>
			</footer> <!-- .site-footer -->
		</div>
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>

		
	</body>

</html>