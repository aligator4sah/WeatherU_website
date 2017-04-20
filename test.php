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
						echo "<a href=\"index.html\">Home</a>";
						echo "<span>Review Weather</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
			
            $eid = $_SESSION['employee'];			
			if(isset($_POST["addweatherSubmit"])){ //Observer sends the input
                                                   //echo "submit encountered!";
                 if(!isset($_POST["cityID"]) || !isset($_POST["date"]) || !isset($_POST["precp"]) || !isset($_POST["snowd"]) || !isset($_POST["snowa"]) || !isset($_POST["tmax"]) || !isset($_POST["tmin"]) || !isset($_POST["winds"]) || !isset($_POST["windd"]) || !isset($_POST["wtype"]) || !isset($_POST["ewtype"])){
                     echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
                     }
                     else{
					 $cityid = $_POST["cityID"];
					 $date = $_POST["date"];
                     $precp= (float)$_POST["precp"];
                     $snowd = (float)$_POST["snowd"];
                     $snowa = (float)$_POST["snowa"];
                     $tmax = (int)$_POST["tmax"];
                     $tmin = (int)$_POST["tmin"];
					 $winds = (float)$_POST["winds"];
					 $windd = (int)$_POST["windd"];
				     $wtid = (int)$_POST["wtype"];
                     $ewtid = (int)$_POST["ewtype"];
                     $insertquery = "insert into db_project.weather values(\"$cityid\",\"$date\",$precp,$snowd,$snowa,$tmax,$tmin,$winds,$windd,$wtid,$ewtid);";
					  if($conn->query($insertquery) === TRUE){
                             echo "Insert Success!";
                           }
                         else
                             echo "error: ".$conn->error();
                             }
                        }
								
		
			$getcommentdata = "SELECT w.cityID AS cityid,w.date AS date,w.precipitation AS precp, w.snowDepth AS snowd, w.snowAmount AS snowa, w.tMax AS tmax, w.tMin AS tmin, w.windSpeed AS winds, w.windDirection AS windd, w.wtID AS wtid, w.exwtID AS ewt 
                               FROM db_project.weather w, db_project.employee e
                               WHERE w.cityID = e.cityID AND e.eID = \"$eid\";";
		   $resdata = $conn->query($getcommentdata);
		   echo "<table style= \"width:100%\">";
		    echo "<tr>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">CITY</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">DATE</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">PRECP</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">SNOWD</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">SNOWA</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">TMAX</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">TMIN</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">WINDS</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">WINDD</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">WTYPE</th>";
			      echo "<th align =\"center\" style = \"padding:10px 0px 10px 0px\">EWTYPE</th>";
			echo "</tr>";
			
		   while($rowdata = $resdata->fetch_assoc()){
			   $cityid = $rowdata["cityid"];
			   $date = $rowdata["date"];
			   $precp = $rowdata["precp"];
			   $snowd = $rowdata["snowd"];
			   $snowa = $rowdata["snowa"];
			   $tmax = $rowdata["tmax"];
			   $tmin = $rowdata["tmin"]; 
			   $winds = $rowdata["winds"];
			   $windd = $rowdata["windd"];
			   $wtype = $rowdata["wtid"];
			   $ewtype = $rowdata["ewt"];
				echo "<tr>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$cityid</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$date</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$precp</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$snowd</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$snowa</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$tmax</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$tmin</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$winds</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$windd</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$wtype</td>";
			      echo "<td align =\"center\" style = \"padding:10px 0px 10px 0px\">$ewtype</td>";
				  echo "<form action=\"updateweather.php\" class=\"contact-form\" method=\"POST\">";
					  echo "<input type = \"hidden\" name = \"eid\" value = \"$eid\">";
					  echo "<td><input type=\"submit\" name = \"updatewxSubmit\" value=\"Update\"></td>";
				echo "</form>";
				echo "</tr>";
			}
			echo "</table>";
            
				
            
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
}
else
{
	header("localhost: employee.php");
}
            
        ?>
		