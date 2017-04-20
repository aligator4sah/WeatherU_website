<?php
session_start();
if(isset($_SESSION['user']) || isset($_SESSION['employee'])){
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Weather Database Project</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body>
		
		<div class="site-content">
			<div class="site-header">
				<div class="container">
					<a href="index.html" class="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-type">
							<h1 class="site-title">WeatherU</h1>
							<small class="site-description">tagline goes here</small>
						</div>
					</a>

					<!-- Default snippet for navigation -->
					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="weather_summary.php">Weather Summary</a></li>
							<li class="menu-item current-menu-item"><a href="live_comments.php">Live comments</a></li>
							<li class="menu-item"><a href="profile.php">Profile</a></li>
							<li class="menu-item"><a href="register5.php">Register/Sign in</a></li>
							<li class="menu-item"><a href="employee.php">Employee</a></li>
						</ul> <!-- .menu -->
					</div> <!-- .main-navigation -->

					<div class="mobile-navigation"></div>

				</div>
			</div> <!-- .site-header -->

			<main class="main-content">
				<div class="container">
					<div class="breadcrumb">
						<a href="index.php">Home</a>
						<span>Live comments</span>
					</div>
				</div>

				<div class="fullwidth-block">
					<div class="container">
						<div class="filter">
							<label for="">Enter choice for City:</label>
								<?php
									//connect to database
									//create connection 
									$server = "localhost";
									$usr = "root";
									$pw = "123";
									$conn = new mysqli($server, $usr, $pw);
									if($conn->connect_error){
										die("Connection error - ".$conn->connect_error);
									}
									else
										//echo "Connection successful!!";
									echo "<table>";
									//search by city ids
									echo "<tr><td>";
									echo "<form action = \"live_comments.php\" method = \"POST\">";
									echo "<select name=\"cityarr[]\" >";
										echo "<option value=\"ALL\">ALL</option>";
										$getcities = "select cityID, cityName from db_project.city";
										$rescities = $conn->query($getcities);
										while($rowcities = $rescities->fetch_assoc()){
											$id = $rowcities["cityID"];
											$name = $rowcities["cityName"];
											echo "<option value=\"$id\">$name</option>";
										}
										echo "<input type = \"submit\" name = \"citySubmit\" value = \"submit\">";
									echo "</form>";
									echo "</td></tr>";
									//search by weather type
									echo "<tr><td>";
									echo "<form action = \"live_comments.php\" method = \"POST\">";
									echo "<select name=\"wtarr[]\" >";
										echo "<option value=\"ALL\">ALL</option>";
										$getwtype = "select wtID,wtType from db_project.wt";
										$reswttype = $conn->query($getwtype);
										while($rowwttype= $reswttype->fetch_assoc()){
											$id = $rowwttype["wtID"];
											$name = $rowwttype["wtType"];
											echo "<option value=\"$id\">$name</option>";
										}
										echo "<input type = \"submit\" name = \"wtSubmit\" value = \"submit\">";
									echo "</form>";
									echo "</td></tr>";
									echo "</table>";
									
									
									//RE-RANKING------------------------------------------------------------------------------------------
									echo "<label>Enter choice for Re-Ranking:</label>";
									echo "<form name = \"ReRank\" action = \"live_comments.php\" method = \"POST\">";
										echo "<select name = \"choice[]\">";
										echo "<option value = \"RatingUp\">Rating low to High</option>";
										echo "<option value = \"RatingDown\">Rating High to Low</option>";
										echo "<option value = \"DateUp\">Date earliest first</option>";
										echo "<option value = \"DateDown\">Date earliest last</option>";
										echo "</select>";
										echo "<input type = \"submit\" name = \"choiceSubmit\" value = \"submit\">";
									echo "</form>";
								?>
						</div>
<?php
			if(isset($_POST["citySubmit"])) {
				//echo "HERE!! for city :)<br>";
				if(isset($_SESSION['wt']))
					unset($_SESSION['wt']);
				$acity = $_POST["cityarr"];
				$n = count($acity);
				//echo $n."<br>";
				if($n== 0 ){
					echo "Please select a city!!!!<br>";
				}
				else if($n>1){
					echo "Cannot select more than one city!!!";
				}
				else{
				//echo $acity[0]."<br>";
				if($acity[0] == "ALL"){ //echo "Connection successful!!";
				$_SESSION['city'] = "ALL";
				//$getcommentdata = "select * from db_project.comment;";
				$getcommentdata = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                   FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                   WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID;";
				$resdata = $conn->query($getcommentdata);
				$rowdata = $resdata->fetch_assoc();
				echo "<table border='1' cellpadding='10'>";
				echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
				while($rowdata = $resdata->fetch_assoc()){
					// echo out the contents of each row into a table
					echo "<tr>";
					echo '<td>' . $rowdata['userName'] . '</td>';
					echo '<td>' . $rowdata['cityID'] . '</td>';
					echo '<td>' . $rowdata['dateID'] . '</td>';
					echo '<td>' . $rowdata['rate'] . '</td>';
					echo '<td>' . $rowdata['comment'] . '</td>';
					echo '<td>' . $rowdata['tmax'] . '</td>';
					echo '<td>' . $rowdata['tmin'] . '</td>';
					echo '<td>' . $rowdata['wtype'] . '</td>';
					echo '<td>' . $rowdata['ewtype'] . '</td>';
					echo "</tr>";
				}
				// close table>
				echo "</table>";
				}
				else{
				$city_identification = $acity[0];
				$_SESSION['city'] = $acity[0];
				//$getcommentdata = "select * from db_project.comment where cityID = \"$city_identification\";";
				$getcommentdata = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                   FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                   WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND c.cityID = \"$city_identification\";";
				$resdata = $conn->query($getcommentdata);
				//$rowdata = $resdata->fetch_assoc();
				echo "<table border='1' cellpadding='10'>";
				echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
				while($rowdata = $resdata->fetch_assoc()){
					// echo out the contents of each row into a table
					echo "<tr>";
					echo '<td>' . $rowdata['userName'] . '</td>';
					echo '<td>' . $rowdata['cityID'] . '</td>';
					echo '<td>' . $rowdata['dateID'] . '</td>';
					echo '<td>' . $rowdata['rate'] . '</td>';
					echo '<td>' . $rowdata['comment'] . '</td>';
					echo '<td>' . $rowdata['tmax'] . '</td>';
					echo '<td>' . $rowdata['tmin'] . '</td>';
					echo '<td>' . $rowdata['wtype'] . '</td>';
					echo '<td>' . $rowdata['ewtype'] . '</td>';
					echo "</tr>";
				}
				// close table>
				echo "</table>";}
				//echo "Connection successful!!";
				/*
				
				*/
				
				}
			}
			
			//Weather type submit here--------------------------------------------------------------------------------------------
			if(isset($_POST['wtSubmit'])){
				if(isset($_SESSION['city']))
					unset($_SESSION['city']);
				//echo "HERE!! for city :)<br>";
				$awt = $_POST["wtarr"];
				$n = count($awt);
				//echo $n."<br>";
				if($n== 0 ){
					echo "Please select a city!!!!<br>";
				}
				else if($n>1){
					echo "Cannot select more than one city!!!";
				}
				else{
				//echo $acity[0]."<br>";
				if($awt[0] == "ALL"){ //echo "Connection successful!!";
				$_SESSION['wt'] = "ALL";
				//$getcommentdata = "select * from db_project.comment;";
				$getcommentdata = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                   FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                   WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID;";
				$resdata = $conn->query($getcommentdata);
				$rowdata = $resdata->fetch_assoc();
				echo "<table border='1' cellpadding='10'>";
				echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
				while($rowdata = $resdata->fetch_assoc()){
					// echo out the contents of each row into a table
					echo "<tr>";
					echo '<td>' . $rowdata['userName'] . '</td>';
					echo '<td>' . $rowdata['cityID'] . '</td>';
					echo '<td>' . $rowdata['dateID'] . '</td>';
					echo '<td>' . $rowdata['rate'] . '</td>';
					echo '<td>' . $rowdata['comment'] . '</td>';
					echo '<td>' . $rowdata['tmax'] . '</td>';
					echo '<td>' . $rowdata['tmin'] . '</td>';
					echo '<td>' . $rowdata['wtype'] . '</td>';
					echo '<td>' . $rowdata['ewtype'] . '</td>';
					echo "</tr>";
				}
				// close table>
				echo "</table>";
				}
				else{
				$wt_identification = $awt[0];
				$_SESSION['wt'] = $awt[0];
				//$getcommentdata = "select * from db_project.comment where cityID = \"$city_identification\";";
				$getcommentdata = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                   FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                   WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND wt.wtID = \"$wt_identification\";";
				$resdata = $conn->query($getcommentdata);
				//$rowdata = $resdata->fetch_assoc();
				echo "<table border='1' cellpadding='10'>";
				echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
				while($rowdata = $resdata->fetch_assoc()){
					// echo out the contents of each row into a table
					echo "<tr>";
					echo '<td>' . $rowdata['userName'] . '</td>';
					echo '<td>' . $rowdata['cityID'] . '</td>';
					echo '<td>' . $rowdata['dateID'] . '</td>';
					echo '<td>' . $rowdata['rate'] . '</td>';
					echo '<td>' . $rowdata['comment'] . '</td>';
					echo '<td>' . $rowdata['tmax'] . '</td>';
					echo '<td>' . $rowdata['tmin'] . '</td>';
					echo '<td>' . $rowdata['wtype'] . '</td>';
					echo '<td>' . $rowdata['ewtype'] . '</td>';
					echo "</tr>";
				}
				// close table>
				echo "</table>";}
				//echo "Connection successful!!";
				/*
				
				*/
				
				}
			}
			
			//CITY RE-RANKING------------------------------------------------------------------------------------------
			if(isset($_POST["choiceSubmit"])){
			$tuple = $_POST['choice'];
            if(!isset($tuple)){
                echo("<p>You did not select any row!</p>");
            }
            else{
                $n = count($tuple);
                if($n > 1){
                    echo("<p>You cannot select more than one row to remove!</p>");
                }
                else if($n==1 && isset($_SESSION['city'])){//one of the choices selected
                    if($_SESSION['city'] == "ALL"){
					if($tuple[0] == "RatingUp"){
                       // $selectchoice = "select * from db_project.comment order by rate";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "RatingDown"){
                        //$selectchoice = "select * from db_project.comment order by rate desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate desc";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";
                    }
                    else if($tuple[0] == "DateUp"){
                        //$selectchoice = "select * from db_project.comment order by dateID";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "DateDown"){
                        //$selectchoice = "select * from db_project.comment order by dateID desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
					}//if city session var == ALL
					else{
						if($tuple[0] == "RatingUp"){
						$cityid_in_submit = $_SESSION['city'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by rate";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND c.cityID = \"$cityid_in_submit\"
                                         ORDER BY c.rate";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "RatingDown"){
						$cityid_in_submit = $_SESSION['city'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by rate desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND c.cityID = \"$cityid_in_submit\"
                                         ORDER BY c.rate desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";
                    }
                    else if($tuple[0] == "DateUp"){
						$cityid_in_submit = $_SESSION['city'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by dateID";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND c.cityID = \"$cityid_in_submit\"
                                         ORDER BY c.dateID";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "DateDown"){
						$cityid_in_submit = $_SESSION['city'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by dateID desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND c.cityID = \"$cityid_in_submit\"
                                         ORDER BY c.dateID desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
						
					}
					}
					else if($n==1 && isset($_SESSION['wt'])){
						if($_SESSION['wt'] == "ALL"){
						if($tuple[0] == "RatingUp"){
                       // $selectchoice = "select * from db_project.comment order by rate";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "RatingDown"){
                        //$selectchoice = "select * from db_project.comment order by rate desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate desc";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";
                    }
                    else if($tuple[0] == "DateUp"){
                        //$selectchoice = "select * from db_project.comment order by dateID";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "DateDown"){
                        //$selectchoice = "select * from db_project.comment order by dateID desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
					}//if wt session var == ALL
					else{
						if($tuple[0] == "RatingUp"){
						$wtid_in_submit = $_SESSION['wt'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by rate";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND wt.wtID = \"$wtid_in_submit\"
                                         ORDER BY c.rate";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "RatingDown"){
						$wtid_in_submit = $_SESSION['wt'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by rate desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND wt.wtID = \"$wtid_in_submit\"
                                         ORDER BY c.rate desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";
                    }
                    else if($tuple[0] == "DateUp"){
						$wtid_in_submit = $_SESSION['wt'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by dateID";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND wt.wtID = \"$wtid_in_submit\"
                                         ORDER BY c.dateID";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "DateDown"){
						$wtid_in_submit = $_SESSION['wt'];
                        //$selectchoice = "select * from db_project.comment where cityID = \"$cityid_in_submit\" order by dateID desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID AND wt.wtID = \"$wtid_in_submit\"
                                         ORDER BY c.dateID desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
					}
					}
					else if($n==1 && isset($_SESSION['city'])&& !isset($_SESSION['wt'])){
						if($tuple[0] == "RatingUp"){
                       // $selectchoice = "select * from db_project.comment order by rate";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "RatingDown"){
                        //$selectchoice = "select * from db_project.comment order by rate desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.rate desc";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";
                    }
                    else if($tuple[0] == "DateUp"){
                        //$selectchoice = "select * from db_project.comment order by dateID";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID";
						
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                        echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
                    else if($tuple[0] == "DateDown"){
                        //$selectchoice = "select * from db_project.comment order by dateID desc";#HOME
						$selectchoice = "SELECT c.userName AS userName, c.cityID AS cityID, c.dateID AS dateID, c.rate AS rate, c.comment AS comment, w.tMax AS tmax, w.tMin AS tmin, wt.wtType AS wtype, exwt.exwtType AS ewtype
                                         FROM db_project.weather w, db_project.comment c, db_project.wt, db_project.exwt
                                         WHERE exwt.exwtID = w.exwtID AND wt.wtID = w.wtID AND w.cityID = c.cityID AND w.date = dateID
                                         ORDER BY c.dateID desc";
                        $choiceres = $conn->query($selectchoice);
                        echo "<table border='1' cellpadding='10'>";
                       echo "<tr> <th>UserName</th> <th>City</th> <th>Date</th>  <th>Rating</th> <th>Comment</th> <th>Max Tempe</th> <th>Min Temp</th> <th>Weather Type</th> <th>Extreme weather</th></tr>";
				
                        while($row = $choiceres->fetch_assoc()) {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['cityID'] . '</td>';
                            echo '<td>' . $row['dateID'] . '</td>';
                            echo '<td>' . $row['rate'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
							echo '<td>' . $row['tmax'] . '</td>';
					        echo '<td>' . $row['tmin'] . '</td>';
					        echo '<td>' . $row['wtype'] . '</td>';
					        echo '<td>' . $row['ewtype'] . '</td>';
                            echo "</tr>";
                        }
                        // close table>
                        echo "</table>";

                    }
					}
				}
			}
			
            
        ?>
						
						
					</div>
				</div>
				
			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<form action="#" class="subscribe-form">
								<input type="text" placeholder="Enter your email to subscribe...">
								<input type="submit" value="Subscribe">
							</form>
						</div>
						<div class="col-md-3 col-md-offset-1">
							<div class="social-links">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>

					<p class="colophon">INFSCI 2710: Database Management</p>
				</div>
			</footer> <!-- .site-footer -->
		</div>
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>
<?php

}
else{
	header("location: register5.php");
}
?>