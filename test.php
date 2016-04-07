<?php
$vorname = "vorname";
$nachname = "nachname";
$email = "email";
$firma = "firma";
$betrieb = "betrieb";

//connect to db
class MyDB extends SQLite3
{
    function __construct()
    {
	$this->open('./SchulungsDB.db');
    }
}

$db = new MyDB();

$query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('".$vorname."', '".$nachname."', '".$email."', '".$firma."', '".$betrieb."');";
print $query.'\n';
//$query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('bla', 'hau', 'email','firma','betrieb');";

//insert into db
$result = $db->exec($query);
//$result = $db->exec("INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('bla', 'hau', 'email','firma','betrieb');");

//query db
$result = $db->query("SELECT * FROM Teilnehmer;");
echo var_dump($result->fetchArray());

?>