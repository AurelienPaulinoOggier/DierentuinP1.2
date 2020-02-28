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
		
		<h3><button type = "submit" name = "btnlijst" value = "Lijst Dieren" >Lijst Dieren</button>
		<button type = "submit" name = "btnleeg" value = "Lijst lege verblijven" >Lijst lege verblijven</button></h3>
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
	
			if(isset($_POST['btnlijst'])){
				echo "<h2><table style='border: solid 3px yellow; background-color:green; '></h2>";
				echo "<tr><th>Naam Dier</th><th>Soort</th><th>Eten</th><th>Leeftijd</th><th>Verblijf</th><th>Regio</th></tr>";

				class TableRows extends RecursiveIteratorIterator {
					function __construct($it) {
						parent::__construct($it, self::LEAVES_ONLY);
					}

					function current() {
						return "<td style='width: 165px; background-color: purple; border: 2px solid yellow;'>" . parent::current(). "</td>";
					}	

					function beginChildren() {
						echo "<tr>";
					}

					function endChildren() {
						echo "</tr>" . "\n";
					}
				}
				
				$query = "SELECT dieren.dname, dieren.soort, dieren.eten, dieren.leeftijd, verblijven.vname, dieren.regio 
							FROM combi, dieren, verblijven WHERE combi.vid = verblijven.vid AND combi.did = dieren.did";
				$stm = $con->prepare($query);
				if($stm->execute()){
					$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
			}
			
			if(isset($_POST['btnleeg'])){
				echo "<h2><table style='border: solid 3px yellow; background-color:green; '></h2>";
				echo "<tr><th>Verblijf</th><th>Zones</th><th>Capaciteit</th></tr>";

				class TableRows extends RecursiveIteratorIterator {
					function __construct($it) {
						parent::__construct($it, self::LEAVES_ONLY);
					}

					function current() {
						return "<td style='width: 165px; background-color: purple; border: 2px solid yellow;'>" . parent::current(). "</td>";
					}	

					function beginChildren() {
						echo "<tr>";
					}

					function endChildren() {
						echo "</tr>" . "\n";
					}
				}
				
				$query = "SELECT vname, zones, capaciteit FROM verblijven WHERE vid NOT IN (SELECT vid FROM combi)";
				$stm = $con->prepare($query);
				if($stm->execute()){
					$result = $stm->setFetchMode(PDO::FETCH_ASSOC);
					foreach(new TableRows(new RecursiveArrayIterator($stm->fetchAll())) as $k=>$v) {
						echo $v;
					}
				}
				
			}
	
		?>
		
	</body>

</html>