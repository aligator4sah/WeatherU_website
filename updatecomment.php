
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
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
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
						echo "<span>Update comments</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
                            echo "<div class=\"row\">";
                                $uname = $_SESSION['user'];
								$cityid = "";
								$date = "";
                                if(isset($_POST["updatecommentSubmit"])){
                                    $cityid = $_POST["cityid"];
									$date = $_POST["date"];
									echo "<div class=\"row\">";
                                    echo "<p align =\"center\" style = \"padding:10px 0px 10px 0px\">Enter comment for city: $cityid, date: $date</p>";
									echo "</div>";
                                }
							echo "</div>";
							echo "<form action=\"updatecomment.php\" class=\"contact-form\" method=\"POST\">";
                            echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"rate\" placeholder=\"Rate...\"></div>";
								//echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"last\" placeholder=\"Lastname...\"></div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"comment\" placeholder=\"comment...\"></div>";
							    //echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"cit\" placeholder=\"City...\"></div>";
							echo "</div>";
							
								echo "<div class=\"text-right\">";
                                    echo "<input type = \"hidden\" name = \"cityid\" value = \"$cityid\">";
									echo "<input type = \"hidden\" name = \"date\" value = \"$date\">";
						    		echo "<input type=\"submit\" name = \"ModifycommentSubmit\" value=\"Update information\">";
								echo "</div>";
							echo "</form>";

            if(isset($_POST["ModifycommentSubmit"])){ //User sends the input
                //echo "submit encountered!";
                if(!isset($_POST["rate"]) || !isset($_POST["comment"])){
                    echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
                }
                else{
					$uname = $_SESSION['user'];
					$rate = $_POST['rate'];
					$comment = $_POST['comment'];
					$cityid = $_POST['cityid'];
					$date = $_POST['date'];
					$updatequery = "update db_project.comment set rate = $rate, comment = \"$comment\" where userName = \"$uname\" and cityID = \"$cityid\" and dateID = \"$date\" ";
					
					
					if($conn->query($updatequery) === TRUE){
                        echo "Update Success!";
                    }
                    else
                        echo "error: ".$conn->error();
                }
            }

            echo "</body>";
			echo "</html>";
            }
			else{
				header("localhost: register5.php");
			}
        ?>
