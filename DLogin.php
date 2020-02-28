<!DOCTYPE html>
<html>
	<head>
	
        <link rel="stylesheet" href="Dierentuin.css">
		<title> Login </title>
		
			
	</head>
	<body>
        <iframe id="audio" src="https://www.youtube.com/embed/OdIJ2x3nxzQ?autoplay=1&amp;playlist=yB1rg7cAI1M&loop=1" width="0" height="0" allowtransparency="true" frameborder="0"></iframe><form method="POST" action="">
		<form method="POST">
		<h1>Login</h1><br/>
		<h3>Naam:<input name="name" type="name"><br/>
		Wachtwoord:<input name="wachtwoord" type="password"></h3>
		
		<h3><input type = "submit" name = "btnOpslaan" value = "inlogen" /></h3>
		</form>
		
		<?php
		session_start();
		$host = "localhost";
        $dbname = "dierentuin";
        $username = "root";
        $password = "";

        $con = new PDO ("mysql:host=".$host.";dbname=".$dbname.";"
			,$username, $password);
			
		if(isset($_POST{'btnOpslaan'})){	
			$name = $_POST["name"];
			$wachtwoord = $_POST["wachtwoord"];
		}
		
			$query = "SELECT *FROM werknemers WHERE name = '$name' AND password = '$wachtwoord'";
			$stm = $con->prepare($query);
			$stm->execute();
			$login = $stm->fetch(PDO::FETCH_OBJ);
			
			if($login != false){$_SESSION['login'] = $login;

				Header("location: Dhome.php");
				
			}else echo "Naam en/of Wachtwoord is fout";
			
		?>
	</body>

</html>