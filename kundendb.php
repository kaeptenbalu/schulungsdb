<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<title>Schulungsdb</title>
</head>
<body>

<div class="container col-md4">
	<div class='jumbotron'>
	  <h2>Dies ist meine hammer geilo SchulungsDB yeah!</h2>		
		<form action="" method="POST">
			<div class="form-group">
				Vorname: <input type="text" class="form-control" name="vorname" value="Vorname"></br>
				Nachname: <input type="text" class="form-control" name="nachname" value="Nachname"></br>
				eMail: <input type="text" class="form-control" name="email" value="eMail"></br>
				Firma: <input type="text" class="form-control" name="firma" value="Firma"></br>
				Betrieb: <input type="text" class="form-control" name="betrieb" value="Betrieb"></br>
				<input type="submit" value="Abschicken" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>

</body>
</html>



<?php

if (isset($_POST["vorname"])) {
	
	$vorname = $_POST["vorname"];
	$nachname = $_POST["nachname"];
	$email = $_POST["email"];
	$firma = $_POST["firma"];
	$betrieb = $_POST["betrieb"];
	
	//connect to db
	class MyDB extends SQLite3
	{
	    function __construct()
	    {
		$this->open('./SchulungsDB.db');
	    }
	}

	$db = new MyDB();

	//prepare query
	$query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('".$vorname."', '".$nachname."', '".$email."', '".$firma."', '".$betrieb."');";
	echo $query;

	//execute query
	$result = $db->exec($query);
	//query db
	$result = $db->query("SELECT * FROM Teilnehmer;");
	echo var_dump($result->fetchArray());	
}

?>