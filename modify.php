
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
							echo "<li class=\"menu-item\"><a href=\"employee.html\">Employee</a></li>";
						echo "</ul> ";
					echo "</div>";

					echo "<div class=\"mobile-navigation\"></div>";

				echo "</div>";
			echo "</div>";

			echo "<main class=\"main-content\">";
				echo "<div class=\"container\">";
					echo "<div class=\"breadcrumb\">";
						echo "<a href=\"index.php\">Home</a>";
						echo "<span>Modify Profile</span>";
					echo "</div>";
				echo "</div>";

				echo "<div class=\"fullwidth-block\">";
					echo "<div class=\"container\">";
						
							echo "<div class=\"contact-details\">";
                            echo "<div class=\"row\">";
                            $uname = "";
                                if(isset($_POST["modifySubmit"])){
                                    $uname = $_POST["uname"];
									echo "<div class=\"row\">";
                                    echo "<p align =\"center\" style = \"padding:10px 0px 10px 0px\">Enter details for user: $uname</p>";
									echo "</div>";
                                }
							echo "</div>";
							echo "<form action=\"modify.php\" class=\"contact-form\" method=\"POST\">";
                            echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"first\" placeholder=\"Firstname...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"last\" placeholder=\"Lastname...\"></div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"add\" placeholder=\"Address...\"></div>";
							    echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"cit\" placeholder=\"City...\"></div>";
							echo "</div>";
							echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"Z\" placeholder=\"Zip...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"email\" placeholder=\"Email...\"></div>";
							echo "</div>";
                            echo "<div class=\"row\">";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"gen\" placeholder=\"Gender...\"></div>";
								echo "<div class=\"col-md-6\" ><input type=\"text\" name = \"pass\" placeholder=\"Password...\"></div>";
							echo "</div>";
							
								echo "<div class=\"text-right\">";
                                    echo "<input type = \"hidden\" name = \"user\" value = \"$uname\">";
						    		echo "<input type=\"submit\" name = \"ModifyDataSubmit\" value=\"Update information\">";
								echo "</div>";
							echo "</form>";

            if(isset($_POST["ModifyDataSubmit"])){ //User sends the input
                //echo "submit encountered!";
                if(!isset($_POST["first"]) || !isset($_POST["last"]) || !isset($_POST["add"]) || !isset($_POST["cit"]) || !isset($_POST["email"]) || !isset($_POST["Z"]) || !isset($_POST["gen"]) || !isset($_POST["pass"])){
                    echo "<p> one or more of the fields left unfilled!!. Please re-enter!";
                }
                else{
					$uname = $_SESSION['user'];
					$fname = $_POST["first"];
                    $lname = $_POST["last"];
                    $address = $_POST["add"];
                    $city = $_POST["cit"];
                    $zip = (int)$_POST["Z"];
                    $email = $_POST["email"];
                    $gender = $_POST["gen"];
                    $password = $_POST["pass"];
					$deletequery = "delete from db_project.user where userName = \"$uname\";";
					
					if($conn->query($deletequery) === TRUE){
                        echo "Insert Success!";
                    }
                    else
                        echo "error: ".$conn->error();
					
                    //$updatequery = "UPDATE `db_project`.`user` SET `firstName` = \"$fname\", `lastName` = \"$lname\", `address` = \"$address\", `city` = \"$city\",`zip` = $zip, `email` = \"$email\",`gender` = \"$gender\",`password` = \"$password\" WHERE `userName` = \"uname\";";
                    $insertquery = "insert into db_project.user values(\"$uname\",\"$fname\",\"$lname\",\"$address\",\"$city\",$zip,\"$email\",\"$gender\",\"$password\");";
					if($conn->query($insertquery) === TRUE){
                        echo "Insert Success!";
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
