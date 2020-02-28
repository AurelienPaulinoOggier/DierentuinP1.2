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

		
		</form>
		
		<?php
		session_start();

		if(isset($_SESSION['login'])) {
			$name = $_SESSION['login'];
			echo "<h1>"."Welkom, ". $name->name."<h1/>";
		}else {header('Location: DLogin.php');}
		
		
		
		#$host = "localhost";
        #$dbnaam = "workshop_database";
        #$username = "root";
        #$password = "";

        #$con = new PDO ("mysql:host=$host;dbnaam=workshop",
            #"username","password")or die ("Geen verbinding");
			
		
		#if (isset($_POST["btnOpslaan"])){
		     
			#$lijst = array();
			#array_push($lijst, $_POST["name"]); 
			#array_push($lijst, $_POST["soort"]);
			#array_push($lijst, $_POST["eten"]);
			#array_push($lijst, $_POST["regio"]);
			#array_push($lijst, $_POST["leeftijd"]);
			
			#foreach ($lijst as $key => $value)
			#if(empty($value)){
				#echo $key . "is niet ingevuld.";
			#}else{
				#echo $key . ":" . $value . "<br/>"; 
			#}
		#}

		#$query = "INSERT INTO  () * ";
		#$stm = $pdo->prepare($query);
		#if($stm->execute ());
			#
		#$result = $stm->fetchAll(PDO::FETCH_OBJ);
		#foreach($result as $lijst)
			#echo $lijst->soort. "" .$lijst->smaak."<br/>"
			
		#if(isset($_POST['btnVerblijf'])){
				
				#$Naam = $_POST['verblijf'];

				#$query = "SELECT * FROM dieren WHERE dieren.dname = '$Naam'";

                #$Result = $con->prepare($query);

                #$Execute = $Result->execute(array($Naam));
				#OF
                #$query = "SELECT * FROM dieren WHERE dieren.dname = :Naam";

                #$Result = $con->prepare($query);

                #$Execute = $Result->execute(array(":Naam"=>$Naam));

                #if($Execute){
                    #if($Result->rowCount()>0){
                        #$Result = $Result->fetchAll(PDO::FETCH_OBJ);
                        #foreach($Result as $dier)
                            #{echo $dier->dname."<br/>" .$dier->soort. "<br/>";
                            #} 
                        #}
                    #}
            #}
		
		?>
		
	</body>

</html>