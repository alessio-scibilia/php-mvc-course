<?php

/*
$host = 'localhost';
$user = 'root';
$password = "secret1234";
$dbname = "wellcoxwellcome";
*/


$host = 'wellcoxwellcome.mysql.db';
$user = 'wellcoxwellcome';
$password = "SignorFauncewater0";
$dbname = "wellcoxwellcome";
$dbport = 3306;


global $dbh;

$dbh = null;
try {
	$dbh = new PDO ("mysql:host=" . $host . ";dbname=" . $dbname, $user, $password);
} catch (PDOException $ex) {
	echo $ex->getMessage();
}


//HOTEL
$query = "SELECT immagini_secondarie,id FROM hotel";
$stmt = $dbh->query($query);
if($stmt->rowCount() > 0) {
	echo 'Analizzo Hotel<br>';
	while($immagini = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$immagini_hotel = explode("|",$immagini['immagini_secondarie']);

		for($i=0;$i<sizeof($immagini_hotel);$i++) {
			if($immagini_hotel[$i][0] != '/' && !empty($immagini_hotel[$i]))
			{
				$immagini_hotel[$i] = '/'.$immagini_hotel[$i];
			}
		}

		$immagini_hotel = join("|",$immagini_hotel);

		$update = "UPDATE hotel SET immagini_secondarie = ? WHERE id = ?";
		$stmt_update = $dbh->prepare($update);
		$stmt_update->bindParam(1,$immagini_hotel,PDO::PARAM_STR);
		$stmt_update->bindParam(2,$immagini['id'],PDO::PARAM_INT);
		$stmt_update->execute();
	}
}


//SERVIZI
$query = "SELECT immagine,id FROM servizi";
$stmt = $dbh->query($query);
if($stmt->rowCount() > 0) {
	echo 'Analizzo Servizi<br>';
	while($immagini = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$immagini_servizi = explode("|",$immagini['immagine']);

		for($i=0;$i<sizeof($immagini_servizi);$i++) {
			if($immagini_servizi[$i][0] != '/' && !empty($immagini_servizi[$i]))
			{
				$immagini_servizi[$i] = '/'.$immagini_servizi[$i];
			}
		}

		$immagini_servizi = join("|",$immagini_servizi);

		$update = "UPDATE servizi SET immagine = ? WHERE id = ?";
		$stmt_update = $dbh->prepare($update);
		$stmt_update->bindParam(1,$immagini_servizi,PDO::PARAM_STR);
		$stmt_update->bindParam(2,$immagini['id'],PDO::PARAM_INT);
		$stmt_update->execute();
	}
}



//ECCELLENZE
$query = "SELECT immagine,id FROM eccellenze";
$stmt = $dbh->query($query);
if($stmt->rowCount() > 0) {
	echo 'Analizzo Eccellenze<br>';
	while($immagini = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$immagini_eccellenze = explode("|",$immagini['immagine']);

		for($i=0;$i<sizeof($immagini_eccellenze);$i++) {
			if($immagini_eccellenze[$i][0] != '/' && !empty($immagini_eccellenze[$i]))
			{
				$immagini_eccellenze[$i] = '/'.$immagini_eccellenze[$i];
			}
		}

		$immagini_eccellenze = join("|",$immagini_eccellenze);

		$update = "UPDATE eccellenze SET immagine = ? WHERE id = ?";
		$stmt_update = $dbh->prepare($update);
		$stmt_update->bindParam(1,$immagini_eccellenze,PDO::PARAM_STR);
		$stmt_update->bindParam(2,$immagini['id'],PDO::PARAM_INT);
		$stmt_update->execute();
	}
}


//STRUTTURE
$query = "SELECT immagine_didascalia,real_immagini_didascalia,id FROM strutture";
$stmt = $dbh->query($query);
if($stmt->rowCount() > 0) {
		echo 'Analizzo Strutture<br>';
	while($immagini = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$immagini_struttura = explode("|",$immagini['immagine_didascalia']);
		$immagini_didascalia = explode("|",$immagini['real_immagini_didascalia']);

		for($i=0;$i<sizeof($immagini_struttura);$i++) {
			if($immagini_struttura[$i][0] != '/' && !empty($immagini_struttura[$i])) //per non mettere uno / finale
			{
				$immagini_struttura[$i] = '/'.$immagini_struttura[$i];
			}
		}

		$immagini_struttura = join("|",$immagini_struttura);


		for($i=0;$i<sizeof($immagini_didascalia);$i++) {
			if($immagini_didascalia[$i][0] != '/' && !empty($immagini_didascalia[$i]))
			{
				$immagini_didascalia[$i] = '/'.$immagini_didascalia[$i];
			}
		}
		$immagini_didascalia = join("|",$immagini_didascalia);

		$update = "UPDATE strutture SET immagine_didascalia = ?, real_immagini_didascalia = ? WHERE id = ?";
		$stmt_update = $dbh->prepare($update);
		$stmt_update->bindParam(1,$immagini_struttura,PDO::PARAM_STR);
		$stmt_update->bindParam(2,$immagini_didascalia,PDO::PARAM_STR);
		$stmt_update->bindParam(3,$immagini['id'],PDO::PARAM_INT);
		$stmt_update->execute();
	}
}


?>