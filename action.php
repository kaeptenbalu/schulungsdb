<?php session_start(); ?>
<?php
/**
* Login-Stuff
* To logout -> unset($_SESSION['user_id']);
**/
if (isset($_POST["signin"])) {	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$query = "SELECT username, password FROM User WHERE username = '".$username."' AND password = '".$password."'";

	$results = runSQLquery($query);
	
	//echo '<pre>'; print_r($results); echo '</pre>';
	if ($username === $results[0]['username'] && $results[0]['password']) {
	    //Sessioncookie
    	$_SESSION['user'] = $username;
    		/*array(
        	'name' => $username,
        	'login' => 'login',
        	'some_info' => 'some info'
    	);*/
    	echo 'sessioncookie gesetzt. </br> <script type="text/javascript"> window.open("index.html","_self");</script>';
	}

	else{
		echo "something went wrong x(";
	}

}


/**
* Debugging Helper
**/
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}


/**
* SQL-Helper function
**/

class MyDB extends SQLite3 {
    function __construct()
    {
    	//connect to db
		$this->open('./SchulungsDB.db');
    }
}


function checkResult($result){
	if (!$result) {
    	throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
    	debug_to_console( "db error 2" );
    	die("SQL-Query Error.");
	}
}

function runSQLquery($query, $type){	
	
	$db = new MyDB();
	debug_to_console( "bla" );
    if(!$db){
		echo $db->lastErrorMsg();
		debug_to_console( "db error" );
		die("SQL-Query Error.");
    } 
    else {
    	/**
    	* query-function bug executes each query twice if insert with query is used
    	* as workarround, each insert call needs to use exec function which not return any datasets
    	* but true or false.
    	**/
    	if ($type === 'insert') {
	    	debug_to_console( "insert" );
			$result = $db->exec($query);
			checkresult($result);
			return $result;
		}
		else {
			$results = array();
			$result = $db->query($query);
			checkresult($result);
			//debug_to_console( $results );
			while($row=$result->fetchArray(SQLITE3_ASSOC)){
	   			$rows = array($row);
	   			$results = array_merge($results,$rows);
	   			//debug_to_console( $rows );
			}
		}
	}
	
	$db->close();
	return $results;
}


/**
* Schulungsfoo
**/
if(isset($_SESSION['user'])){
//logged In

	if (isset($_POST["createTeilnehmer"])) {	
		$vorname = $_POST["vorname"];
		$nachname = $_POST["nachname"];
		$email = $_POST["email"];
		$firma = $_POST["firma"];
		$betrieb = $_POST["betrieb"];	

		//prepare query
		$query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('".$vorname."', '".$nachname."', '".$email."', '".$firma."', '".$betrieb."');";

		//execute query
		$result = runSQLquery($query, 'insert');
		
		//get List of participants
		$results = runSQLquery("SELECT * FROM Teilnehmer;", 'select');
		echo '<pre>'; print_r($results); echo '</pre>';
		//echo '<pre>'; print_r(var_dump($results)); echo '</pre>';		
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
		
		//$id = $_POST["id"];

		//prepare query
		//$query = "INSERT INTO Bildungsbeauftragter (name, vorname, email, telefonnummer, id) VALUES //('".$name."', '".$vorname."', '".$email."', '".$telefonnumer."','".$id."');";
		$query = "INSERT INTO Bildungsbeauftrager (name, vorname, email, telefonnumer, id) VALUES ('".$name."', '".$vorname."', '".$email."', '".$telefonnummer."', 1);";

		$result = runSQLquery($query);
		echo $result;
	}

}else{
// Not logged in :(
	echo "you are not logged in. please login...";
}


?>