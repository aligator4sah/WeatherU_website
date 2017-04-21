
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
						echo "<span>Emplee -- update weather</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
                            echo "<div class=\"row\">";
                            $eid = $_SESSION['employee'];
                                if(isset($_POST["updatewxSubmit"])){
                                    $cid = $_POST["cid"];
									$dt = $_POST["dt"];
									echo "<div class=\"row\">";
                                    echo "<p align =\"center\" style = \"padding:10px 0px 10px 0px\">Enter details for city: $cid, date: $dt</p>";
									echo "</div>";
                                
							echo "</div>";
							echo "<form action=\"updatewx.php\" class=\"contact-form\" method=\"POST\">";
                            echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"precp\" placeholder=\"Precpitation...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowd\" placeholder=\"Snow Depth...\"></div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"snowa\" placeholder=\"Snow Amount...\"></div>";
							    echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmax\" placeholder=\"Max Temperature...\"></div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"tmin\" placeholder=\"Min Temperature...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"winds\" placeholder=\"Wind Speed...\"></div>";
							echo "</div>";
                            echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"windd\" placeholder=\"Wind direction...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"wtype\" placeholder=\"Weather ID...\"></div>";
							echo "</div>";
							 echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"ewtype\" placeholder=\"Extreme Weather ID...\"></div>";
							echo "</div>";
							
								echo "<div class=\"text-right\">";
                                    echo "<input type = \"hidden\" name = \"cid\" value = \"$cid\">";
									echo "<input type = \"hidden\" name = \"date\" value = \"$dt\">";
						    		echo "<input type=\"submit\" name = \"ModifywxSubmit\" value=\"Update weather\">";
								echo "</div>";
							echo "</form>";
								}
				  
            if(isset($_POST["ModifywxSubmit"])){ //User sends the input
                //echo "submit encountered!";
                if(!isset($_POST["precp"]) || !isset($_POST["snowd"]) || !isset($_POST["snowa"]) || !isset($_POST["tmax"]) || !isset($_POST["tmin"]) || !isset($_POST["winds"]) || !isset($_POST["windd"]) || !isset($_POST["wtype"]) || !isset($_POST["ewtype"])){
                    echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
                }
                else{
					
					$cid = $_POST["cid"];
					//echo $cid."<br>";
					$date = $_POST["date"];
					//echo $date."<br>";
					//echo "<br>Employee ID: $eid<br>";
					$precp = (float)$_POST["precp"];
                    $snowd = (float)$_POST["snowd"];
                    $snowa = (float)$_POST["snowa"];
                    $tmax = (int)$_POST["tmax"];
                    $tmin = (int)$_POST["tmin"];
                    $winds = (float)$_POST["winds"];
					$windd = (int)$_POST["windd"];
					$wtid = (int)$_POST["wtype"];
                    $exwtid = $_POST["ewtype"];
					//$deletequery = "delete from db_project.employee where eID = $eid;";
					
					//if($conn->query($deletequery) === TRUE){
                        //echo "Insert Success!";
                   // }
                    //else
                       // echo "error: ".$conn->error();
				   
                    $updatequery = "update db_project.weather set precipitation = $precp, snowDepth = $snowd, snowAmount = $snowa, tMax= $tmax,tMin = $tmin, windSpeed = $winds,windDirection = $windd,wtID = $wtid,exwtID = $exwtid  where cityID = \"$cid\" and date = \"$date\";";
					
                   // $insertquery = "insert into db_project.employee values($eid,\"$fname\",\"$lname\",\"$title\",\"$cityid\",\"$email\",\"$gender\",$salary,\"$address\",$zip,\"$password\");";
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
            
        ?>
