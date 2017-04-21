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
							echo "<li class=\"menu-item\"><a href=\"index.php\">Home</a></li>";
							echo "<li class=\"menu-item\"><a href=\"weather_summary\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live_comments.php\">Live comments</a></li>";
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
							echo "<li class=\"menu-item  current-menu-item\"><a href=\"employee.php\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";

			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.php\">Home</a>";
						echo "<span>Review Subscription</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
			
            //$eid = $_SESSION['employee'];			
			if(isset($_POST["subreviewSubmit"])){ //Observer sends the input

                        
								
		
			$getcommentdata = "SELECT w.userName AS cityid,w.cityName AS date, p.price AS price
                               FROM db_project.subscription w, db_project.price p
                               WHERE w.cityName = p.cityName";
		   $resdata = $conn->query($getcommentdata);
		   echo "<table style= \"width:100%\">";
		    echo "<tr>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">USERNAME</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">CITY</th>";
                  echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">PRICE</th>";
			echo "</tr>";
			
		   while($rowdata = $resdata->fetch_assoc()){
			   $cityid = $rowdata["cityid"];
			   $date = $rowdata["date"];
			   $price = $rowdata["price"];

				echo "<tr>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$cityid</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$date</td>";
				  echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$price</td>";
				  //echo "<form action=\"updatewx.php\" class=\"contact-form\" method=\"POST\">";
					 // echo "<input type = \"hidden\" name = \"cid\" value = \"$cityid\">";
					  //echo "<input type = \"hidden\" name = \"dt\" value = \"$date\">";
					  //echo "<td><input type=\"submit\" name = \"updatewxSubmit\" value=\"Update\"></td>";
				//echo "</form>";
				//echo "<form action=\"review_wx.php\" class=\"contact-form\" method=\"POST\">";
					 // echo "<input type = \"hidden\" name = \"cid\" value = \"$cityid\">";
					  //echo "<input type = \"hidden\" name = \"dt\" value = \"$date\">";
					  //echo "<td><input type=\"submit\" name = \"deletewxSubmit\" value=\"Delete\"></td>";
					    
				//echo "</form>";
				echo "</tr>";
			}
			echo "</table>";
            
				
            
			echo "</div>";
							echo "</div>";
					
						
					echo "</div>";
				echo "</div>";
				
			echo "</main>";
			}

			echo "<footer class=\"site-footer\">";
				echo "<div class=\"container\">";
					echo "<div class=\"row\">";
						
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

            
        ?>
		