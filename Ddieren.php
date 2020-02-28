<!DOCTYPE html>
<html>
	<head>
	
        <link rel="stylesheet" href="Dierentuin.css">
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
		
		<h1>Dieren toevoegen</h1><br/>
		<h3>Naam:<input name="dname" type="name"><br/>	
			Soort:<input name="soort" type="text" /><br/>
			Regio:<select name="regio">
						<option value="Europa">Europa</option>
						<option value="Noord Amerika">Noord Amerika</option>
						<option value="Zuid Amerika">Zuid Amerika</option>
						<option value="Azie">Azië</option>
						<option value="Oceanie">Oceanië</option>
						<option value="Afrika">Afrika</option>
						<option value="Afrika">Antarctica</option>
						<option value="Noord Pool">Noord Pool</option>
					</select><br/>
			Leeftijd:<input name="leeftijd" type="text" /><br/>
			Gedrag:<input name="gedrag" type="text"/><br/>
			Verblijf:<select name="verblijf">
						<option value="verblijf 1">verblijf 1</option>
						<option value="verblijf 2">verblijf 2</option>
						<option value="verblijf 3">verblijf 3</option>
						<option value="verblijf 4">verblijf 4</option>
						<option value="verblijf 5">verblijf 5</option>
						<option value="verblijf 6">verblijf 6</option>
						<option value="verblijf 7">verblijf 7</option>
						<option value="verblijf 8">verblijf 8</option>	
					</select><br/>	
			Eten:</h3>
			<h4><input type="radio" name="eten" value="carnivoor"/> carnivoor
				<input type="radio" name="eten" value="herbivoor"/> herbivoor
				<input type="radio" name="eten" value="omnivoor"/> omnivoor</h4>
		
		<h3><input type = "submit" name = "btnOpslaan" value = "Toevoegen" /></h3>
		
		</form>
		
	<?php
		session_start();

			if(isset($_SESSION['login'])) {
				$name = $_SESSION['login'];
			}else {header('Location: DLogin.php');}
	
		$host = "localhost";
        $dbname = "dierentuin";
        $username = "root";
        $password = "";

        try{
            $con = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
		
        catch(PDOException $ex)
        {
            echo "Connection failed: " . $ex->getMessage();
        }
		
		$dname = $_POST["dname"];
		$soort = $_POST["soort"];
		$eten = $_POST["eten"];
		$regio = $_POST["regio"];
		$leeftijd = $_POST["leeftijd"];
		$verblijf = $_POST["verblijf"];
		$gedrag = $_POST["gedrag"];
		$did = 0;
		
		if (isset($_POST["btnOpslaan"])){
			$query = "SELECT max(did) as maxid FROM dieren";
			$stm = $con->prepare($query);
			if ($stm->execute()) {
				$dieren = $stm->fetch(PDO::FETCH_OBJ);
				$did = $dieren->maxid + 1;
			}
					
			$query = "INSERT INTO dieren(dname, soort, eten, regio, leeftijd) VALUES".
						"('$dname', '$soort', '$eten', '$regio', '$leeftijd')";
			$stm = $con->prepare($query);
			if($stm->execute()){
				echo "Statment correct uitvoerd";
				
			}else echo "Query mislukt!";
				
			$query = "SELECT * FROM verblijven WHERE vname = '$verblijf'";
			$stm = $con->prepare($query);
			if ($stm->execute()) {
				$verblijft = $stm->fetch(PDO::FETCH_OBJ);
				$query = "INSERT INTO combi (did, vid, gedrag) VALUES" . "($did, $verblijft->vid, '$gedrag')";
				$stm = $con->prepare($query);
				if ($stm->execute()) {
					echo "Statment verblijf correct uitvoerd";
				}else echo "Query mislukt!";
			}
		}
		
	?>
	</body>

</html>