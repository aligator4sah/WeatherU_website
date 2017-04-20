
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
					echo "<a href=\"index.html\" class=\"branding\">";
						echo "<img src=\"images/logo.png\" alt=\"\" class=\"logo\">";
						echo "<div class=\"logo-type\">";
							echo "<h1 class=\"site-title\">WeatherU</h1>";
							echo "<small class=\"site-description\">Your weather companion</small>";
						echo "</div>";
					echo "</a>";


					echo "<div class=\"main-navigation\">";
						echo "<button type=\"button\" class=\"menu-toggle\"><i class=\"fa fa-bars\"></i></button>";
						echo "<ul class=\"menu\">";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"index.php\">Home</a></li>";
							echo "<li class=\"menu-item\"><a href=\"news.html\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live_comments.php\">Live comments</a></li>";
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
							echo "<li class=\"menu-item\"><a href=\"employee.php\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";

			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.html\">Home</a>";
						echo "<span>Home-query</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
								
																
									if(isset($_POST["querySubmit"])){ //User sends the input
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
													$getwxdata = "SELECT w.date AS date,c.cityName AS city,w.precipitation AS precp,w.snowDepth AS snowd,w.snowAmount AS snowa,w.tMax AS tmax, w.tMin AS tmin,wt.wtType AS wtype,e.exwtType AS ewtype
                                                                    FROM db_project.weather w, db_project.city c, db_project.wt, db_project.exwt e
                                                                    WHERE w.cityID = c.cityID AND w.wtID = wt.wtID AND w.exwtID = e.exwtID AND cityName = \"$wcity\" AND w.date BETWEEN \"$wdate\" AND \"$wdateto\";";
													$resdata = $conn->query($getwxdata);
												
												     echo "<table style= \"width:100%\">";
		                                                echo "<tr>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">CITY</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">DATE</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">PRECP</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">SNOWD</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">SNOWA</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">TMAX</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">TMIN</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">WTYPE</th>";
			                                                echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">EWTYPE</th>";
			                                           echo "</tr>";
													   
													while($rowdata = $resdata->fetch_assoc()){
													$date = $rowdata["date"];
													$city = $rowdata["city"];
													$precp = $rowdata["precp"];
													$snowd = $rowdata["snowd"];
													$snowa = $rowdata["snowa"];
													$tmax = $rowdata["tmax"];
													$tmin = $rowdata["tmin"];
													$wtype = $rowdata["wtype"];
													$ewtype = $rowdata["ewtype"];
													echo "<tr>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$city</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$date</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$precp</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$snowd</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$snowa</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$tmax</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$tmin</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$wtype</td>";
			                                        echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$ewtype</td>";
													echo "</tr>";
													
													}
													echo "</table>";
													//echo "<form action=\"modify.php\" class=\"contact-form\" method=\"POST\">";
													//echo "<div class=\"text-right\">";
														//echo "<input type = \"hidden\" name = \"uname\" value = \"$uname\">";
														//echo "<input type=\"submit\" name = \"modifySubmit\" value=\"Modify\">";
													//echo "</div>";
													//echo "</form>";
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

			echo "<div class=\"contact-details\">";
				echo "<div class=\"container\">";
					echo "<div class=\"row\">";
					        echo "<div class=\"col-md-8 col-md-offset-1\">";
							   echo "<form action=\"user_comment.php\" class=\"subscribe-form\" method = \"POST\">";
							        echo "<div class=\"row\">";
							        //echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"uname\", placeholder=\"username...\"></div>";
									echo "<div class=\"col-sm-3\" ><input type=\"text\" name = \"cityid\", placeholder=\"cityid...\"></div>";
									echo "<div class=\"col-sm-3\" ><input type=\"text\" name = \"date\", placeholder=\"date, YYYY-MM-DD...\"></div>";
							        
								    echo "<div class=\"col-sm-3\" ><input type=\"text\" name = \"rate\", placeholder=\"rate...\"></div>";
								    echo "<div class=\"col-sm-3\" ><input type=\"text\" name = \"comment\", placeholder=\"Comment here...\"></div>";
									
								    echo "<div class=\"col-sm-3\" ><input type=\"submit\" name = \"commentSubmit\" value=\"Comment\"></div>";
								echo "</form>";
						    echo "</div>";
						
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