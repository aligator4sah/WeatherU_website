
        <?php
		
		session_start();
		if(isset($_SESSION['employee'])){
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
							echo "<li class=\"menu-item\"><a href=\"news.html\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live-cameras.html\">Live comments</a></li>";
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"employee.php\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";

			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.html\">Home</a>";
						echo "<span>Observer Entrance</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
                            echo "<div class=\"row\">";
							$eid = $_SESSION['employee'];
							$getobserver = "select * from db_project.observer where oID = $eid;";
													$resobv = $conn->query($getobserver);
													$rowobv = $resobv->fetch_assoc();
													echo "<div class=\"row\">";
													echo "-----------------Welcome ".$rowobv["nickName"]." :)";
													echo "</div>";	
				                 	               echo "<form action=\"review_wx.php\" class=\"contact-form\" method=\"POST\">";
                                                      echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"cityID\" placeholder=\"CityID...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"date\" placeholder=\"Date...\"></div>";
												      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"precp\" placeholder=\"Precipitation...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowd\" placeholder=\"SnowDepth...\"></div>";
							                          echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowa\" placeholder=\"SnowAmount...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmax\" placeholder=\"Max Temperature...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmin\" placeholder=\"Min Temperature...\"></div>";
							                          echo "</div>";
                                                      echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"winds\" placeholder=\"Wind Speed...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"windd\" placeholder=\"Wind Direction...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"wtype\" placeholder=\"Weather Type...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"ewtype\" placeholder=\"Extreme Weather Type...\"></div>";
							                          echo "</div>";		
								                      echo "<div class=\"text-center\">";
						    		                  echo "<input type=\"submit\" name = \"addweatherSubmit\" value=\"Insert Weather information\">";
								                      echo "</div>";
							                       echo "</form>";
												  
							

            echo "</body>";
			echo "</html>";
		}
		else{
			
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
							echo "<li class=\"menu-item\"><a href=\"news.html\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live-cameras.html\">Live comments</a></li>";
							echo "<li class=\"menu-item\"><a href=\"profile.php\">Profile</a></li>";
							echo "<li class=\"menu-item\"><a href=\"register5.php\">Register/Sign in</a></li>";
							echo "<li class=\"menu-item current-menu-item\"><a href=\"employee.php\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";

			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.html\">Home</a>";
						echo "<span>Observer Entrance</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
                            echo "<div class=\"row\">";
                            $eid = "";
                                if(isset($_POST["observerloginSubmit"])){
									
                                   if(!isset($_POST["obvlogin"]) || !isset($_POST["pwd"])){
											echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
										}
										else{
											
											$eid = $_POST["obvlogin"];
											$pwd = $_POST["pwd"];
											//check if user id exists
											$usercheck = "select count(*) from db_project.employee where eID = \"$eid\";";
											$rescheck = $conn->query($usercheck);
											$rowcheck = $rescheck->fetch_assoc();
											$ctr = (int)$rowcheck["count(*)"];
											if($ctr>0){// meaning user id exists, now check for password
												$checkpass = "select password from db_project.employee where eID = \"$eid\";";
												$respasscheck = $conn->query($checkpass);
												$rowpasscheck = $respasscheck->fetch_assoc();
												$pass = $rowpasscheck["password"];
												if($pass == $pwd){	
													$_SESSION['employee'] = $eid;
													$getobserver = "select * from db_project.observer where oID = $eid;";
													$resobv = $conn->query($getobserver);
													$rowobv = $resobv->fetch_assoc();
													echo "<div class=\"row\">";
													echo "-----------------Welcome ".$rowobv["nickName"]." :)";
													echo "</div>";	
				                 	               echo "<form action=\"review_wx.php\" class=\"contact-form\" method=\"POST\">";
                                                      echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"cityID\" placeholder=\"CityID...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"date\" placeholder=\"Date...\"></div>";
												      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"precp\" placeholder=\"Precipitation...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowd\" placeholder=\"SnowDepth...\"></div>";
							                          echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowa\" placeholder=\"SnowAmount...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmax\" placeholder=\"Max Temperature...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmin\" placeholder=\"Min Temperature...\"></div>";
							                          echo "</div>";
                                                      echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"winds\" placeholder=\"Wind Speed...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"windd\" placeholder=\"Wind Direction...\"></div>";
							                          echo "</div>";
							                          echo "<div class=\"row\">";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"wtype\" placeholder=\"Weather Type...\"></div>";
								                      echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"ewtype\" placeholder=\"Extreme Weather Type...\"></div>";
							                          echo "</div>";		
								                      echo "<div class=\"text-center\">";
						    		                  echo "<input type=\"submit\" name = \"addweatherSubmit\" value=\"Insert Weather information\">";
								                      echo "</div>";
							                       echo "</form>";
                                         												
												}
												else{
													echo "Wrong Password. Please try again!<br>";
													header("location: employee.php");
												}
											}
											else{
												echo "Observer doesn't exist. Please Enter a valid Observer ID!<br>";
												header("location: employee.php");
											}
										}
								}
												

            echo "</body>";
			echo "</html>";
			}
            
        ?>
