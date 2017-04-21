
<html>
    <head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>WeatherU Database Project</title>

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
							<li class="menu-item"><a href="live-comments.php">Live comments</a></li>
							<li class="menu-item"><a href="profile.html">Profile</a></li>
							<li class="menu-item"><a href="register5.php">Register/Sign in</a></li>
							<li class="menu-item current-menu-item"><a href="employee.html">Employee</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->

			<main class="main-content">
				<div class="container">
					<div class="breadcrumb">
						<a href="index.php">Home</a>
						<span>Employee</span>
					</div>
				</div>

			    <div class="fullwidth-block">
					<div class="container">
						<div class="col-md-6 col-xs-offset-1">
							<h2 class="section-title">Employee Login</h2>
							<p>Hellooo Weatherian, We've got our Weatherminators deployed to get rid of those pestering (B)lizzards! All you gotta do is fill out this form to save on those menacy rain buckets!!</p>
							<table style = \"width:100%\">
							<tr>
							<td>
							<form action="addweather.php" class="contact-form" method="POST">
								<table>
								<tr>
									<td><input type="text" name = "obvlogin" placeholder="Employee ID..."></td>
								</tr>
								<tr>
									<td><input type="Password" name = "pwd" placeholder="Password..."></td>
								</tr>
								<tr>
									<td><input type="submit" name = "observerloginSubmit" value="Observer Login"></td>
								</tr>
								</table>
							</form>
							</td>
							<td>
							<form action="manager_profile.php" class="contact-form" method="POST">
								<table>
								<tr>
									<td><input type="text" name = "mgrlogin" placeholder="Employee ID..."></td>
								</tr>
								<tr>
									<td><input type="Password" name = "pwd" placeholder="Password..."></td>
								</tr>
								<tr>
									<td><input type="submit" name = "managerloginSubmit" value="Manager Login"></td>
								</tr>
								</table>
							</form>
							</td>
							<td>
							<form action="analyst_profile" class="contact-form" method="POST">
								<table>
								<tr>
									<td><input type="text" name = "aytlogin" placeholder="Employee ID..."></td>
								</tr>
								<tr>
									<td><input type="Password" name = "pwd" placeholder="Password..."></td>
								</tr>
								<tr>
									<td><input type="submit" name = "analystloginSubmit" value="Analyst Login"></td>
								</tr>
								</table>
							</form>
							<td>
							</tr>
							</table>
						</div>
					</div>
				</div>
		</body>
</html> 