<?php
	session_start();
	if(isset($_SESSION['user'])){
				echo $_SESSION['user'];
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
							<small class="site-description">tagline goes here</small>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item current-menu-item"><a href="weather_summary.php">Weather Summary</a></li>
							<li class="menu-item"><a href="live_comments.php">Live comments</a></li>
							<li class="menu-item"><a href="profile.php">Profile</a></li>
							<li class="menu-item"><a href="register5.php">Register/Sign in</a></li>
							<li class="menu-item"><a href="employee.php">Employee</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->
            
			<div class="hero" data-bg-image="images/banner.png">
			
			<!-- going to aggregation.php file to perform agSubmit query -->
				<div class="container">
					<form action="Aggregation.php" class = "container" method="POST">
						<input type="text" name = "city" placeholder="Find your location...">
						<input type="text" name = "datefrom" placeholder="From Date, YYYY-MM-DD...">
						<input type="text" name = "dateto" placeholder="To Date, YYYY-MM-DD...">
						<input type="submit" name="agSubmit" value="Summary">
					</form>
					
					<form action="index.php" class = "container" method="POST">
						<input type="submit" name="logoutSubmit" value="logout">
					</form>

				</div>
			</div>

			

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
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>
<?php
	if(isset($_POST['logoutSubmit'])){
		session_destroy();
		header("location: register5.php");
	}
	}
	else{
		header("location: register5.php");
	}
	?>