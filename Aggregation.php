        <?php
		session_start();
		if(isset($_SESSION['user'])){
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
            
            

	echo "<html lang=\"en\">";
	echo "<head>";
		echo "<meta charset=\"UTF-8\">";
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0,maximum-scale=1\">";
		
		echo "<title>Weather Database Project</title>";

		
		echo "<link href=\"http://fonts.googleapis.com/css?family=Roboto:300,400,700|\" rel=\"stylesheet\" type=\"text/css\">";
		echo "<link href=\"fonts/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">";

		
		echo "<link rel=\"stylesheet\" href=\"style.css\">";
		
	echo "</head>";


	echo "<body>";
		
		echo "<div class=\"site-content\">";
			echo "<div class=\"site-header\">";
				echo "<div class=\"container\">";
					echo "<a href=\"Weather_Summary.php\" class=\"branding\">";
						echo "<img src=\"images/logo.png\" alt=\"\" class=\"logo\">";
						echo "<div class=\"logo-type\">";
							echo "<h1 class=\"site-title\">WeatherU</h1>";
							echo "<small class=\"site-description\">Your weather companion</small>";
						echo "</div>";
					echo "</a>";

					echo "<div class=\"main-navigation\">";
						echo "<button type=\"button\" class=\"menu-toggle\"><i class=\"fa fa-bars\"></i></button>";
						echo "<ul class=\"menu\">";
							echo "<li class=\"menu-item\"><a href=\"index.php\">Home</a></li>";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"weather_summary.php\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live_comments.php\">Live comments</a></li>";
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
							echo "<li class=\"menu-item\"><a href=\"employee.php\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";


//don't know what this part is
			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.php\">Home</a>";
						echo "<span>Summary review</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
																
									if(isset($_POST["agSubmit"])){ //User sends the input
										//echo "submit encountered!";
										if(!isset($_POST["city"]) || !isset($_POST["datefrom"]) || !isset($_POST["dateto"])){
											echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
										}
										else{
											
											$wcity = $_POST["city"];
											$wdate = $_POST["datefrom"];
											$wdateto = $_POST["dateto"];
											//check if city exists
											$citycheck = "select count(*) from db_project.city where cityName = \"$wcity\";";
											$rescheck = $conn->query($citycheck);
											$rowcheck = $rescheck->fetch_assoc();
											$ctr = (int)$rowcheck["count(*)"];
											if($ctr>0){// meaning city id exists, now check for date
												echo "Weather Summary for city: $wcity";
												$checkdate = "select date from db_project.weather where date = \"$wdate\";";
												$resdatecheck = $conn->query($checkdate);
												$rowdatecheck = $resdatecheck->fetch_assoc();
												$date = $rowdatecheck["date"];
												
												$checkdateto = "select date from db_project.weather where date = \"$wdateto\";";
												$resdatecheckto = $conn->query($checkdateto);
												$rowdatecheckto = $resdatecheckto->fetch_assoc();
												$dateto = $rowdatecheckto["date"];
												if($date == $wdate && $dateto == $wdateto){
													//send header to social page
													$getsunny  = "SELECT c.cityName as city, count(wt.wtType) as Days, wt.wtType as wtype
                                                                  FROM db_project.weather w, db_project.city c, db_project.wt, db_project.exwt e
                                                                  WHERE w.cityID = c.cityID AND w.wtID = wt.wtID AND w.exwtID = e.exwtID AND cityName = \"$wcity\" AND w.date BETWEEN \"$wdate\" AND \"$wdateto\"
                                                                  Group by c.cityName, wt.wtType;";
																  
													$resdata = $conn->query($getsunny);
													while($rowdata = $resdata->fetch_assoc()){
													$city = $rowdata["city"];
													$Days = $rowdata["Days"];
													$Type = $rowdata["wtype"];
													
													echo "<div class=\"row\">";
													//echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">CITY: $city</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">Weather Type : $Type</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">DAYS : $Days</p></div>";
													
													echo "</div>";
												
													}
					
												}
												else{
													echo "Invalid date!!!! Try again<br>";
												}
											}
											else{
												echo "City $wcity does not exist!!. Enter another city!<br>";
											}
										}
									}
				echo "</div>";
					
						
					echo "</div>";
				echo "</div>";
				
			echo "</main>";

						
						echo "<div class=\"col-md-3 col-md-offset-1\">";
							echo "<div class=\"social-links\">";
								echo "<a href=\"#\"><i class=\"fa fa-facebook\"></i></a>";
								echo "<a href=\"#\"><i class=\"fa fa-twitter\"></i></a>";
								echo "<a href=\"#\"><i class=\"fa fa-google-plus\"></i></a>";
								echo "<a href=\"#\"><i class=\"fa fa-pinterest\"></i></a>";
							echo "</div>";
						echo "</div>";
					echo "</div>";

					echo "<p class=\"colophon\"></p>";
				echo "</div>";
			echo "</footer>";
		echo "</div>";
		
		echo "<script src=\"js/jquery-1.11.1.min.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false&amp;language=en\"></script>";
		echo "<script src=\"js/plugins.js\"></script>";
		echo "<script src=\"js/app.js\"></script>";

		
	echo "</body>";

echo "</html>";
}
else{
	header("location: register5.php");
}
?>