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
							echo "<li class=\"menu-item\"><a href=\"index.php\">Home</a></li>";
							echo "<li class=\"menu-item\"><a href=\"weather_summary.php\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live_comments.php\">Live comments</a></li>";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"profile.php\">Profile</a></li>";
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
						echo "<a href=\"index.php\">Home</a>";
						echo "<span>User Comments</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
							
			$uname = $_SESSION['user'];				
			if(isset($_POST["rvcommentSubmit"])){ 	
		
			$getcommentdata = "select * from db_project.comment where userName = \"$uname\";";
		    $resdata = $conn->query($getcommentdata);
		    while($rowdata = $resdata->fetch_assoc()){
			   
			   $cityid = $rowdata["cityID"];
			   $date = $rowdata["dateID"];
			   $rate = $rowdata["rate"];
			   $comment = $rowdata["comment"];
			   echo "<div class=\"row\">";
			      echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">User name : $uname</p></div>";
				  echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">CityID: $cityid</p></div>";
				  echo "</div>";
				  echo "<div class=\"row\">";
				  echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">Date : $date</p></div>";
				  echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">Rate : $rate</p></div>";
				  echo "</div>";
			      echo "<div class=\"row\">";
				  echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">Comment : $comment</p></div>";
				  echo "</div>";
				  echo "<div class=\"row\">";
				  echo "<form action=\"updatecomment.php\" class=\"contact-form\" method=\"POST\">";
					echo "<div class=\"text-right\">";
					  //echo "<input type = \"hidden\" name = \"uname\" value = \"$uname\">";
					  echo "<input type = \"hidden\" name = \"cityid\" value = \"$cityid\">";
					  echo "<input type = \"hidden\" name = \"date\" value = \"$date\">";
					  echo "<div class=\"col-sm-6\" ><input type=\"submit\" name = \"updatecommentSubmit\" value=\"Update\"></div>";
					echo "</div>";
				echo "</form>";
				echo "<form action=\"puser_comment.php\" class=\"contact-form\" method=\"POST\">";
				      
					  echo "<input type = \"hidden\" name = \"cid\" value = \"$cityid\">";
					  echo "<input type = \"hidden\" name = \"dt\" value = \"$date\">";
					  echo "<div class=\"col-sm-6\" ><input type=\"submit\" name = \"deletecommentSubmit\" value=\"Delete\"></div>";				    
				echo "</form>";
				echo "</div>";
			}

            
				
            
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
		if(isset($_POST["deletecommentSubmit"])){
			
			$cid = $_POST["cid"];
			echo $cid."<br>";
			$dt = $_POST["dt"];
			echo $dt."<br>";
			echo $uname."<br>";
            $deletequery = "delete from db_project.comment where userName = \"$uname\" and cityID = \"$cid\" and dateID = \"$dt\";";
			if($conn->query($deletequery) === TRUE){
				echo "Delete Success!";
			}
			else
				echo "error: ".$conn->error();
		}

		
	echo "</body>";

echo "</html>";
}
else
{
	header("localhost: register5.php");
}
            
        ?>
		