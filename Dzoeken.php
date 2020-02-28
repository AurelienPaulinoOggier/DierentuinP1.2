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
		
		<h3><input name="name" type="text" />
		<button type = "submit" name = "btnZoeken" value = "zoeken" >zoeken</button>
		<select name="verblijf">
						<option value="verblijf 1">verblijf 1</option>
						<option value="verblijf 2">verblijf 2</option>
						<option value="verblijf 3">verblijf 3</option>
						<option value="verblijf 4">verblijf 4</option>
						<option value="verblijf 5">verblijf 5</option>
						<option value="verblijf 6">verblijf 6</option>
						<option value="verblijf 7">verblijf 7</option>
						<option value="verblijf 8">verblijf 8</option>	
					</select>
		<button type = "submit" name = "btnVerblijf" value = "zoeken" >zoeken op verblijf</button></h3><br/>
		
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

			$con = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);
			
			if(isset($_POST['btnZoeken'])){
				$Naam = $_POST['name'];
				echo "<h2><table style='border: solid 3px yellow; background-color:green;'></h2>";
				echo "<tr><th>Naam Dier</th><th>Soort</th><th>Eten</th><th>Leeftijd</th><th>Verblijf</th><th>Regio</th></tr>";

				class TableRows extends RecursiveIteratorIterator {
					function __construct($it) {
						parent::__construct($it, self::LEAVES_ONLY);
					}

					function current() {
						return "<td style='width: 165px; border: 2px solid yellow; background-color: purple'>" . parent::current(). "</td>";
					}

					function beginChildren() {
						echo "<tr>";
					}

					function endChildren() {
						echo "</tr>" . "\n";
					}
				}
				
				$query = "SELECT dieren.dname, dieren.soort, dieren.eten, dieren.leeftijd, verblijven.vname, dieren.regio
							FROM combi,dieren,verblijven WHERE combi.vid = verblijven.vid AND combi.did = dieren.did AND dieren.dname = '$Naam'";
				$stm = $con->prepare($query);
				
				if ($stm->execute(array($Naam))){
					$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
				
				$query = "SELECT dieren.dname, dieren.soort, dieren.eten, dieren.leeftijd, verblijven.vname, dieren.regio
							FROM combi,dieren,verblijven WHERE combi.vid = verblijven.vid AND combi.did = dieren.did AND dieren.soort = '$Naam' ORDER BY dieren.dname";
				$stm = $con->prepare($query);
				
				if ($stm->execute(array($Naam))){
					$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
			}
			
			if(isset($_POST['btnVerblijf'])){
				$Naam = $_POST['verblijf'];
				echo "<h2><table style='border: solid 3px yellow; background-color:green;'></h2>";
				echo "<tr><th>Naam Dier</th><th>Soort</th><th>Eten</th><th>Leeftijd</th><th>Verblijf</th><th>Regio</th><th>capaciteit</th></tr>";

				class TableRows extends RecursiveIteratorIterator {
					function __construct($it) {
						parent::__construct($it, self::LEAVES_ONLY);
					}

					function current() {
						return "<td style='width: 165px; border: 2px solid yellow; background-color: purple'>" . parent::current(). "</td>";
					}

					function beginChildren() {
						echo "<tr>";
					}

					function endChildren() {
						echo "</tr>" . "\n";
					}
				}
				$query = "SELECT dieren.dname, dieren.soort, dieren.eten, dieren.leeftijd, verblijven.vname, dieren.regio, verblijven.capaciteit
							FROM combi,dieren,verblijven WHERE combi.vid = verblijven.vid AND combi.did = dieren.did AND verblijven.vname = '$Naam' ORDER BY dieren.dname";
					$stm = $con->prepare($query);
				
				if ($stm->execute(array($Naam))){
					$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
			}
			#else echo "<h2>Dit soort is er niet</h2>";
			
		?>
		
	</body>

</html>