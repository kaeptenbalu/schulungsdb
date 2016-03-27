<?php

function runSQLquery($query){
	//connect to db
	class MyDB extends SQLite3
	{
	    function __construct()
	    {
		$this->open('./SchulungsDB.db');
	    }
	}

	$db = new MyDB();

	//execute query
	$result = $db->exec($query);
	return var_dump($result->fetchArray());
}


if (isset($_POST["createTeilnehmer"])) {	
	$vorname = $_POST["vorname"];
	$nachname = $_POST["nachname"];
	$email = $_POST["email"];
	$firma = $_POST["firma"];
	$betrieb = $_POST["betrieb"];	

	//prepare query
	$query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('".$vorname."', '".$nachname."', '".$email."', '".$firma."', '".$betrieb."');";

	//execute query
	$result = runSQLquery($query);
	//query db
	//$result = $db->query("SELECT * FROM Teilnehmer;");
	echo $result;	
}


if (isset($_POST["createBetrieb"])){
	$firma = $_POST["firma"];
	$strasse = $_POST["strasse"];
	$plz = $_POST["plz"];
	$ort = $_POST["ort"];
	$bildungskoordinator = $_POST["bildungskoordinator"];

	//prepare query
	$query = "INSERT INTO Betriebe (firma, strasse, plz, ort, bildungskoordinator) VALUES ('".$firma."', '".$strasse."', '".$plz."', '".$ort."', '".$bildungskoordinator."');";

	$result = runSQLquery($query);
	//query db
	//$result = $db->query("SELECT * FROM Teilnehmer;");
	echo $result;
}


if (isset($_POST["createSchulung"])){
	$name = $_POST["name"];
	$bezeichnung = $_POST["bezeichnung"];
	$datum = $_POST["datum"];
	$schulungsort = $_POST["schulungsort"];

	//prepare query
	$query = "INSERT INTO Schulungen (name, bezeichnung, datum, schulungsort) VALUES ('".$name."', '".$bezeichnung."', '".$datum."', '".$schulungsort."');";

	$result = runSQLquery($query);
	//query db
	//$result = $db->query("SELECT * FROM Teilnehmer;");
	echo $result;
}


if (isset($_POST["createBildungsbeauftragter"])){
	$name = $_POST["name"];
	$vorname = $_POST["vorname"];
	$email = $_POST["email"];
	$telefonnummer = $_POST["telefonnummer"];

	//prepare query
	$query = "INSERT INTO Schulungen (name, vorname, email, telefonnumer) VALUES ('".$name."', '".$vorname."', '".$email."', '".$telefonnumer."');";

	$result = runSQLquery($query);
	//query db
	//$result = $db->query("SELECT * FROM Teilnehmer;");
	echo $result;
}

?>