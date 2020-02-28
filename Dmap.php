<!DOCTYPE html>
<html>
	<head>
	
        <link rel="stylesheet" href="map.css">
		<title> Dierentuin </title>
		
			<nav>
				<ul>
					<li><a href="http://localhost/BP/Dhome.php" style="color: #fcfaff; text-decoration: none;"> HOME <a/></li>
					<li><a href="http://localhost/BP/Dmap.php" style="color: #fcfaff; text-decoration: none;"> MAP <a/></li>
					<li><a href="http://localhost/BP/Ddieren.php" style="color: #fcfaff; text-decoration: none;"> Dieren toevoegen <a/></li>
					<li><a href="http://localhost/BP/Dlijsten.php" style="color: #fcfaff; text-decoration: none;"> Lijsten <a/></li>
					<li><a href="http://localhost/BP/Dzoeken.php" style="color: #fcfaff; text-decoration: none;"> Zoeken <a/></li>
				</ul>
			</nav>
					
	</head>
	<body>
		<form method="POST" action="">
		</form>
		
		<?php
		session_start();

		if(isset($_SESSION['login'])) {
			$name = $_SESSION['login'];
		}else {header('Location: DLogin.php');}
		
		?>
	</body>

</html>