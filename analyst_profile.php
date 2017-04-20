
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
							echo "<li class=\"menu-item\"><a href=\"weather_summary.php\">Weather Summary</a></li>";
							echo "<li class=\"menu-item\"><a href=\"live_comments.php\">Live comments</a></li>";
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
						echo "<a href=\"index.php\">Home</a>";
						echo "<span>Analyst</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
								
																
									if(isset($_POST["analystloginSubmit"])){ //Employee sends the input
										//echo "submit encountered!";
										if(!isset($_POST["aytlogin"]) || !isset($_POST["pwd"])){
											echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
										}
										else{
											$eid = $_POST["aytlogin"];
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
													//send header to social page
													$getuserdata = "SELECT e.eID as eID, e.firstName as firstname, e.lastName as lastname, e.title as title, c.cityName as city, e.email as email, e.gender as gender, e.salary as salary, e.address as address, e.zip as zip, e.password as pws, a.duty as duty
                                                                    FROM db_project.employee e, db_project.city c, db_project.analyst a
                                                                    WHERE e.eID = a.aID AND e.cityID = c.CityID AND eID = \"$eid\" AND password = \"$pwd\";";
													$resdata = $conn->query($getuserdata);
													$rowdata = $resdata->fetch_assoc();
													$eid = $rowdata["eID"];
													$fname = $rowdata["firstname"];
													$lname = $rowdata["lastname"];
													$title = $rowdata["title"];
													$city = $rowdata["city"];
													$email = $rowdata["email"];
													$gender = $rowdata["gender"];
													$salary = $rowdata["salary"];
													$add = $rowdata["address"];
													$zip = $rowdata["zip"];
													$duty = $rowdata["duty"];
													echo "<div class=\"row\">";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">FIRSTNAME : $fname</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">LASTNAME: $lname</p></div>";
													echo "</div>";
													echo "<div class=\"row\">";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">TITLE : $title</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">CITY : $city</p></div>";
													echo "</div>";
													echo "<div class=\"row\">";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">EMAIL : $email</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">GENDER : $gender</p></div>";
													echo "<div class=\"row\">";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">SALARY : $salary</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">ADDRESS : $add</p></div>";
													echo "<div class=\"row\">";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">ZIPCODE : $zip</p></div>";
													echo "<div class=\"col-md-6\" ><p align =\"center\" style = \"padding:10px 0px 10px 0px\">DUTY : $duty</p></div>";
													echo "</div>";
													echo "<form action=\"emp_modify.php\" class=\"contact-form\" method=\"POST\">";
													echo "<div class=\"text-right\" align = \"center\">";
														echo "<input type = \"hidden\" name = \"eid\" value = \"$eid\">";
														echo "<div class=\"col-sm-6\" ><input type=\"submit\" name = \"modifySubmit\" value=\"Modify\"></div>";
													echo "</div>";
													echo "</form>";
													echo "<form action=\"sub_review.php\" class=\"contact-form\" method=\"POST\">";
													echo "<div class=\"text-right\" align = \"center\">";
														//echo "<input type = \"hidden\" name = \"eid\" value = \"$eid\">";
														echo "<div class=\"col-sm-6\" ><input type=\"submit\" name = \"subreviewSubmit\" value=\"Subscription Review\"></div>";
													echo "</div>";
													echo "</form>";
												}
												else{
													echo "Wrong Password!!!! Try again<br>";
												}
											}
											else{
												echo "EmployeeID $eid does not exist!!. Enter a valid EID!<br>";
											}
										}
									}
										
								
									echo "<div class=\"contact-info\">";
									echo "<address>";
										echo "<img src=\"images/icon-marker.png\" alt=\"\">";
										echo "<p>WeatherU INC. <br>";
										echo "School of Information Sciences, University of Pittsburgh</p>";
									echo "</address>";
									
									//echo "<a href=\"#\"><img src=\"images/icon-phone.png\" alt=\"\">+1 800 100 101</a>";
									//echo "<a href=\"#\"><img src=\"images/icon-envelope.png\" alt=\"\">sabrina@weatheru.com</a>";
								echo "</div>";
							echo "</div>";
					
						
					echo "</div>";
				echo "</div>";
				
			echo "</main>";

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